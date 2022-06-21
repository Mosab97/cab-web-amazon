<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\Order\{ChangeOrderStatusNotification};
use App\Models\{Order , User , PointOffer};
use App\Services\{WaslElmService};

class UpdateOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , WaslElmService;

    public $order;
    public $status;
    public $last_status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order , $status , $last_status = null)
    {
        $this->order = $order;
        $this->status = $status;
        $this->last_status = $last_status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         if ($this->order->order_status == 'start_trip' && $this->status == 'admin_finish') {
             $order_data = ['order_status' => $this->status , 'order_status_times' =>[$this->status => date('Y-m-d h:i A')]];
             $fcm_driver_data = [
                 'title' => trans('api.messages.admin_finish_order'),
                 'body' => "",
                 'notify_type' => 'order_finished',
                 'order_id' => $this->order->id,
                 'tip' => $this->order->tip,
                 'can_show_lucky_boxes' => $this->order->luckyBoxes()->where('gift_user.user_id',$this->order->driver_id)->doesntExist()
             ];

             $fcm_client_data = $fcm_driver_data+[
                 'can_show_lucky_boxes' => $this->order->luckyBoxes()->where('gift_user.user_id',$this->order->client_id)->doesntExist()
             ];
             pushFcmNotes($fcm_driver_data,[$this->order->driver_id]);
             pushFcmNotes($fcm_client_data,[$this->order->client_id]);

             if ($this->order->driver_id) {
                 $driver = User::where('user_type','driver')->find($this->order->driver_id);

                 if ($this->order->order_status == 'start_trip' && ! $this->order->finished_at) {
                     $app_commission = optional(optional($driver->subscribedPackage)->package)->commission;
                     $wallet_amount = 0;
                     $new_wallet = 0;
                     $free_wallet_balance = 0;
                     $driver_wallet = (float)$driver->wallet;
                     $client = $this->order->client;
                     // Point Offers
                    use_point_offer($client , $driver);

                    $wallet_amount = $this->order->total_price;
                    $wallet_client_amount = $wallet_amount;
                    $withdrawal_from_client = false;
                    if (setting('enable_make_order_and_take_order') &&
                    $client->clientOrders()->whereIn('order_status',['admin_finish','client_finish','driver_finish'])->whereDate('created_at',date('Y-m-d'))->where('payer','client')->count() > 0 &&
                    $client->clientOrders()->whereIn('order_status',['admin_finish','client_finish','driver_finish'])->whereDate('created_at',date('Y-m-d'))->where('payer','app')->count() < 1 && (float)setting('second_trip_max_price') <= $wallet_amount) {
                        $wallet_client_amount = max($wallet_amount - (float)setting('second_trip_max_price') , 0);
                        $withdrawal_from_client = true;
                        $order_data += ['payer' => 'app' , 'amount_paid_from_payer' => $wallet_client_amount];
                    }


                    if ($this->order->is_paid_by_wallet) {

                         $free_wallet_balance = max(($client->free_wallet_balance - $wallet_client_amount), 0);

                         if ($wallet_client_amount) {
                             $new_wallet = wallet_transaction($client , $wallet_client_amount , 'withdrawal' , $this->order);
                             $client->update(['wallet' => $new_wallet, 'free_wallet_balance' => $free_wallet_balance]);
                         }

                         if ($client->temporaryWallets()->live()->where('rest_amount',">",0)->exists()) {
                             $temp_wallet = $client->temporaryWallets()->live()->where('rest_amount',">",0)->first();

                             $temp_wallet->update(['rest_amount' => max(0,($temp_wallet->rest_amount - $wallet_amount))]);
                         }


                         wallet_transaction($driver , $wallet_amount , 'charge' , $this->order);

                         $driver_wallet += $wallet_amount;
                     }else{
                         $wallet_driver_amount = $wallet_amount > $wallet_client_amount ? ($wallet_amount - $wallet_client_amount ): null;
                         if ($wallet_driver_amount) {
                             wallet_transaction($driver ,$wallet_driver_amount,'charge' ,$this->order);
                             $driver_wallet += $wallet_driver_amount;
                         }
                         if ($wallet_client_amount && $withdrawal_from_client) {
                             $new_wallet = wallet_transaction($client , $wallet_client_amount , 'withdrawal' , $this->order);
                             $client->update(['wallet' => $new_wallet]);
                         }
                     }

                     $start_at = date("Y-m-d H:i:s",strtotime(optional($this->order->order_status_times)->start_trip));
                     $order_data += ['actual_time' => now()->diffInMinutes($start_at) ?? $this->order->expected_time,'wallet_amount' => $wallet_amount,'finished_at' => now(), 'app_commission' => $app_commission , 'is_deduct_commission' => true];

                     if ($driver->driver->is_on_default_package) {
                         $trip_price = 0;
                         if ((int)$driver->driver->free_order_counter < (int)setting('number_of_free_orders_on_default_package')) {
                             $driver->driver()->update(['free_order_counter' => \DB::raw('free_order_counter + 1')]);
                         }else{
                             $trip_price = (setting('price_of_default_package_order') ? (float)setting('price_of_default_package_order') : 1 );

                             wallet_transaction($driver , $trip_price , 'withdrawal', $this->order);

                             $driver_wallet -= $trip_price;
                         }
                         $order_data += ['is_driver_on_default_package' => 1 , 'default_package_price' => $trip_price];
                     }

                     wallet_transaction($driver , $app_commission , 'withdrawal' , $this->order);

                     $driver_wallet -= $app_commission;

                     $driver->update(['wallet' => $driver_wallet]);

                 }
                 $driver->driver()->update(['is_available' => 1]);
             }
             $this->order->update($order_data);
             if (isset($driver) && @$driver->driver->is_signed_to_elm) {
                 $this->finishTrip($this->order);
             }
             $admins = User::whereIn('user_type',['admin','superadmin'])->get();
             \Notification::send($admins,new ChangeOrderStatusNotification($this->order));

         }elseif (in_array($this->order->order_status, ['shipped','pre_client_accept_start']) && $this->status == 'admin_finish') {
             $this->order->update(['order_status' => 'admin_cancel' , 'order_status_times' =>['admin_cancel' => date('Y-m-d h:i A')]]);
             $fcm_data = [
                 'title' => trans('api.messages.admin_cancel_order'),
                 'body' => "",
                 'notify_type' => 'order_canceled',
                 'order_id' => $this->order->id
             ];
             pushFcmNotes($fcm_data,[$this->order->driver_id, $this->order->client_id]);
             if ($this->order->driver_id) {
                 $driver = User::where('user_type','driver')->find($this->order->driver_id);
                 $driver->driver()->update(['is_available' => 1]);
             }
             $admins = User::whereIn('user_type',['admin','superadmin'])->get();
             \Notification::send($admins,new ChangeOrderStatusNotification($this->order));

         }elseif(in_array($this->order->order_status,['pending']) && $this->status == 'admin_cancel' && ! $this->last_status){
             $this->order->update(['order_status' => $this->status , 'order_status_times' =>[$this->status => date('Y-m-d h:i A')]]);
             $admins = User::whereIn('user_type',['admin','superadmin'])->get();
             \Notification::send($admins,new ChangeOrderStatusNotification($this->order));
         }elseif(in_array($this->order->order_status,['client_recieve_offers']) && $this->status == 'admin_cancel' && $this->last_status == 'pending'){
             $this->order->update(['order_status' => $this->status , 'order_status_times' =>[$this->status => date('Y-m-d h:i A')]]);
             $admins = User::whereIn('user_type',['admin','superadmin'])->get();
             \Notification::send($admins,new ChangeOrderStatusNotification($this->order));
         }
    }
}

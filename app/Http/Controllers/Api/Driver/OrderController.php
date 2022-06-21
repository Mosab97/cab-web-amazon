<?php

namespace App\Http\Controllers\Api\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Driver\{OrderResource};
use App\Http\Requests\Api\Order\{DriverChangeOrderStatus};
use App\Notifications\General\{FCMNotification};
use App\Models\{Order , User , PointOffer , AppOffer};
use App\Notifications\Order\{ChangeOrderStatusNotification};
use App\Services\{WaslElmService};

class OrderController extends Controller
{
    use WaslElmService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::where(function ($q) {
            $q->where('driver_id',auth('api')->id())->orWhereHas('driverNotifiedOrders',function ($q) {
                $q->where('driver_order.status','notify')->where('driver_order.driver_id',auth('api')->id());
            });
        })->when($request->status,function ($q) use($request) {
            switch ($request->status) {
                case 'pending':
                    $q->whereIn('order_status',['pending','client_recieve_offers']);
                    break;
                case 'current':
                    $q->whereIn('order_status',['client_recieve_offers','shipped']);
                    break;
                case 'finished':
                    $q->whereIn('order_status',['client_finish','admin_finish','driver_finish']);
                    break;
            }
        })->latest()->distinct('orders.id')->paginate(20);
        return OrderResource::collection($orders)->additional(['status' => 'success','message'=>'' ,'has_app_offers' => AppOffer::active()->exists()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$order_id)
    {
        $order = Order::where(function ($q) {
            $q->where('driver_id',auth('api')->id())->orWhereHas('driverNotifiedOrders',function ($q) {
                $q->where('driver_order.status','notify');
            });
        })->find($order_id);
        // if (!$order) {
        //     return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.client_select_another_driver')],404);
        // }

        foreach (auth('api')->user()->unreadNotifications as $notification) {
            if (isset($notification->data['order_id']) && $notification->data['order_id'] == $order->id && is_null($notification->read_at)) {
                $notification->markAsRead();
                // notify driver
            }
        }

        return (new OrderResource($order))->additional(['status' => 'success' , 'message' => '']);
    }

    public function getCurrentOrder(Request $request)
    {
        $order = auth('api')->user()->driverOrders()->whereIn('order_status',['shipped','start_trip','pre_client_accept_start','client_reject_start'])->first();
        if (!$order) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => ''],404);
            //trans('api.messages.no_live_order')
        }

        foreach (auth('api')->user()->unreadNotifications as $notification) {
            if (isset($notification->data['order_id']) && $notification->data['order_id'] == $order->id && is_null($notification->read_at)) {
                $notification->markAsRead();
                // notify driver
            }
        }
        return (new OrderResource($order))->additional(['status' => 'success' , 'message' => '']);
    }

    public function changeOrderStatus(DriverChangeOrderStatus $request)
    {
        $order = Order::where('driver_id',auth('api')->id())->whereNotIn('order_status',['new_order','client_recieve_offers'])->findOrFail($request->order_id);
        if (in_array($order->order_status,['client_cancel','admin_cancel']) && in_array($request->order_status , ['driver_cancel' , 'pre_client_accept_start','driver_finish'])) {
            $fcm_data = [
                'title' => trans('api.messages.order_canceled'),
                'body' => "",
                'notify_type' => 'order_canceled',
                'order_id' => $order->id
            ];
            pushFcmNotes($fcm_data,[$order->driver_id,$order->client_id]);

        }elseif (in_array($order->order_status,['driver_cancel','admin_cancel','client_cancel']) && in_array($request->order_status , ['driver_finish'])) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.cant_finish_order_after_cancel')],422);
        }elseif ($order->order_status == 'client_finish' && in_array($request->order_status ,  ['driver_finish' , 'pre_client_accept_start'])) {
            $fcm_data = [
                'title' => $order->order_type == 'ride' ? trans('api.messages.client_finish_trip') : trans('api.messages.client_finish_order'),
                'body' => "",
                'notify_type' => 'order_finished',
                'order_id' => $order->id
            ];
            pushFcmNotes($fcm_data,[$order->driver_id]);

        }elseif ($order->order_status == 'admin_finish' && in_array($request->order_status ,  ['driver_finish' , 'pre_client_accept_start'])) {
            $fcm_data = [
                'title' => trans('api.messages.admin_finish_order'),
                'body' => "",
                'notify_type' => 'order_finished',
                'order_id' => $order->id
            ];
            pushFcmNotes($fcm_data,[$order->driver_id]);
        }elseif ($order->order_status == 'start_trip' && !$order->order_type == 'delivery' && !$order->client_recieved_order && $request->order_status == 'driver_finish') {
            return response()->json(['status' => 'fail','message' => trans('api.messages.cant_finish_order_before_received_from_client'),'data' => null],422);
        }
        // if (in_array($order->order_status , ['shipped' , 'pre_client_accept_start','client_reject_start']) && $request->order_status == 'driver_finish' && $order->order_type == 'delivery') {
        if (in_array($order->order_status , ['shipped' , 'pre_client_accept_start','client_reject_start']) && $request->order_status == 'driver_finish') {
            return response()->json(['status' => 'fail','message' => trans('api.messages.cant_finish_order_before_received_from_client'),'data' => null],422);
        }elseif (in_array($order->order_status , ['shipped' , 'pre_client_accept_start','client_reject_start']) && $request->order_status == 'driver_finish' && $order->order_type == 'ride') {
            return response()->json(['status' => 'fail','message' => trans('api.messages.cant_finish_order_before_start_trip'),'data' => null],422);
        }elseif ($order->order_status == 'start_trip' && $request->order_status == 'driver_cancel') {
            return response()->json(['status' => 'fail','message' => trans('api.messages.cant_cancel_order_after_start_trip'),'data' => null],422);
        }
        // \DB::beginTransaction();
        // try {
            $order_data = ['order_status' => $request->order_status , 'order_status_times' => [$request->order_status => date('Y-m-d h:i A')]];

            // if ($request->order_status == 'start_trip') {
            //     $fcm_data = [
            //             'title' => trans('dashboard.fcm.start_trip_status_title'),
            //             'body' => trans('dashboard.fcm.start_trip_status_body',['driver' => $order->driver->fullname]),
            //             'notify_type' => 'start_trip',
            //             'order_id' => $order->id,
            //             'order_type' => $order->order_type,
            //             'order_status' => $order->order_status,
            //         ];
            //     pushFcmNotes($fcm_data,[$order->client_id]);
            //     $order->client->notify(new FCMNotification($fcm_data,['database']));
            // }

            if ($request->order_status == 'pre_client_accept_start') {
                $fcm_data = [
                        'title' => trans('dashboard.fcm.'.$order->order_type.'.pre_client_accept_start_title'),
                        'body' => trans('dashboard.fcm.'.$order->order_type.'.pre_client_accept_start_body',['driver' => $order->driver->fullname]),
                        'notify_type' => 'pre_client_accept_start',
                        'order_id' => $order->id,
                        'order_type' => $order->order_type,
                        'order_status' => $order->order_status,
                        // 'fcm_sound' => 'newOrder.mp3',
                    ];
                pushFcmNotes($fcm_data,[$order->client_id]);
                $order->client->notify(new FCMNotification($fcm_data,['database']));
            }


            if ($request->order_status == 'driver_finish' && ! $order->finished_at) {

                $driver = auth('api')->user();
                $app_commission = optional(optional($driver->subscribedPackage)->package)->commission;
                $driver_wallet = (float)$driver->wallet;
                $client = $order->client;

                $new_wallet = 0;
                $free_wallet_balance = 0;
                $wallet_amount = $order->total_price;
                $wallet_client_amount = $order->total_price;
                $withdrawal_from_client = false;

                if (setting('enable_make_order_and_take_order') &&
                $client->clientOrders()->whereIn('order_status',['admin_finish','client_finish','driver_finish'])->whereDate('created_at',date('Y-m-d'))->where('payer','client')->count() > 0 &&
                $client->clientOrders()->whereIn('order_status',['admin_finish','client_finish','driver_finish'])->whereDate('created_at',date('Y-m-d'))->where('payer','app')->count() < 1 && (float)setting('second_trip_max_price') <= $wallet_amount) {
                    $wallet_client_amount = max(($wallet_amount - (float)setting('second_trip_max_price')), 0);
                    $withdrawal_from_client = true;
                    $order_data +=['payer' => 'app', 'amount_paid_from_payer' => $wallet_client_amount];
                }

                use_point_offer($client , $driver);

                if ($order->is_paid_by_wallet) {
                    $free_wallet_balance = max(($client->free_wallet_balance - $wallet_client_amount),0);

                    if ($wallet_client_amount) {
                        $new_wallet = wallet_transaction($client , $wallet_client_amount , 'withdrawal' , $order);
                        $client->update(['wallet' => $new_wallet, 'free_wallet_balance' => $free_wallet_balance]);
                    }

                    if ($client->temporaryWallets()->live()->where('rest_amount',">",0)->count()) {
                        $temp_wallet = $client->temporaryWallets()->live()->where('rest_amount',">",0)->first();

                        $temp_wallet->update(['rest_amount' => max(0,($temp_wallet->rest_amount - $wallet_client_amount))]);
                    }

                    wallet_transaction($driver , $wallet_amount , 'charge' , $order);

                    $driver_wallet += $wallet_amount;
                }else{
                    $wallet_driver_amount = $wallet_amount > $wallet_client_amount ? ($wallet_amount - $wallet_client_amount) : null;
                    if ($wallet_driver_amount) {
                        wallet_transaction($driver ,$wallet_driver_amount,'charge' ,$order);
                        $driver_wallet += $wallet_driver_amount;
                    }
                    if ($wallet_client_amount && $withdrawal_from_client) {
                        $new_wallet = wallet_transaction($client , $wallet_client_amount , 'withdrawal' , $order);
                        $client->update(['wallet' => $new_wallet]);
                    }
                }

                if ($driver->driver->is_on_default_package) {
                    $trip_price = 0;
                    if ((int)$driver->driver->free_order_counter < (int)setting('number_of_free_orders_on_default_package')) {
                        $driver->driver()->update(['free_order_counter' => \DB::raw('free_order_counter + 1')]);
                    }else{
                        $trip_price = (setting('price_of_default_package_order') ? (float)setting('price_of_default_package_order') : 1 );

                        $new_wallet = wallet_transaction($driver , $trip_price , 'withdrawal', $order);

                        $driver_wallet -= $trip_price;
                    }
                    $order_data += ['is_driver_on_default_package' => 1 , 'default_package_price' => $trip_price];
                }

                $start_at = date("Y-m-d H:i:s",strtotime(optional($order->order_status_times)->start_trip));
                $order_data += ['finished_at' => now(),'actual_time' => now()->diffInMinutes($start_at) ?? $order->expected_time,'wallet_amount' => $wallet_amount , 'share_link_uuid' => null, 'app_commission' => $app_commission , 'is_deduct_commission' => true];
                $driver->driver()->updateOrCreate(['user_id' => $driver->id],['is_available' => 1]);

                // if (@$driver->driver->is_signed_to_elm) {
                //     $elm_reply = $this->finishTrip($order);
                //     $order_data +=['elm_reply' => $elm_reply];
                // }

                if ($app_commission) {
                    wallet_transaction($driver , $app_commission , 'withdrawal' , $order);

                    $driver_wallet -= $app_commission;
                }

                $driver->update(['wallet' => $driver_wallet]);

                $fcm_data = [
                    'title' => $order->order_type == 'ride' ? trans('api.messages.driver_finish_trip') : trans('api.messages.driver_finish_order'),
                    'body' => "",
                    'notify_type' => 'order_finished',
                    'can_show_lucky_boxes' => $order->luckyBoxes()->where('gift_user.user_id',auth('api')->id())->doesntExist(),
                    // 'fcm_sound' => 'newOrder.mp3',
                    'tip' => is_null($order->tip) ? $order->tip :(float)$order->tip,
                    'order_id' => $order->id
                ];
                pushFcmNotes($fcm_data,[$order->client_id]);
            }

            if (in_array($request->order_status, ['driver_cancel']) && $order->driver_id) {
                auth('api')->user()->driver()->updateOrCreate(['user_id' => $order->driver_id],['is_available' => 1]);
                $order_data += ['share_link_uuid' => null];
                $fcm_data = [
                    'title' => trans('api.messages.order_canceled'),
                    'body' => "",
                    'notify_type' => 'order_canceled',
                    'order_id' => $order->id,
                    // 'fcm_sound' => 'newOrder.mp3',
                ];
                pushFcmNotes($fcm_data,[$order->client_id]);
            }
            $order->update($order_data);
            // \DB::commit();
            $admins = User::whereIn('user_type',['admin','superadmin'])->get();
            \Notification::send($admins,new ChangeOrderStatusNotification($order));
            // if ($request->order_status == 'driver_finish') {
            //     auth('api')->user()->driver()->updateOrCreate(['user_id' => auth('api')->id()],['is_available' => 1]);
            //     $fcm_data = [
            //         'title' => trans('dashboard.fcm.change_order_status_title'),
            //         'body' => trans('dashboard.fcm.change_order_status_body',['driver' => $order->driver->fullname,'order_type' =>trans('dashboard.order.order_types.'.$order->order_type)]),
            //         'notify_type' => 'change_order_status',
            //         'order_id' => $order->id,
            //         'order_type' => $order->order_type,
            //         'order_status' => $order->order_status,
            //     ];
            //     // \Notification::send($order->client,new FCMNotification($fcm_data));
            // }
            return (new OrderResource($order))->additional(['status' => 'success' , 'message' => trans('api.messages.success_change_order_status')]);

        // }catch (\Exception $e) {
        //    \DB::rollback();
        //    \Log::info($e->getMessage());
        //    return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        // }

    }

}

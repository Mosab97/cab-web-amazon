<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\{OfferResource , OrderResource};
use App\Http\Requests\Api\Offer\{ClientAcceptOfferRequest};
use App\Notifications\General\{FCMNotification};
use App\Notifications\Order\{OrderNotification};
use App\Models\{Order , OrderOffer , User};
use App\Notifications\Order\{ChangeOrderStatusNotification};
use App\Jobs\{UpdateOrderStatus};
use Illuminate\Support\Str;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offers($order_id)
    {
        $offers = OrderOffer::whereHas('order',function ($q) {
            $q->where('client_id',auth('api')->id());
        })->where('order_id',$order_id)->latest()->paginate(20);
        return OfferResource::collection($offers)->additional(['status' => 'success','message'=>'']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOffer($order_id,$offer_id)
    {
        $offer = OrderOffer::whereHas('order',function ($q) {
            $q->where('client_id',auth('api')->id());
        })->where('order_id',$order_id)->findOrFail($offer_id);

        foreach (auth('api')->user()->unreadNotifications as $notification) {
            if (isset($notification->data['offer_id']) && $notification->data['offer_id'] == $offer->id && is_null($notification->read_at)) {
                $notification->markAsRead();
                // notify client
            }
        }
        return (new OfferResource($offer))->additional(['status' => 'success' , 'message' => '']);
    }

    public function acceptOffer(ClientAcceptOfferRequest $request)
    {
        $offer = OrderOffer::whereHas('order',function ($q) {
            $q->where('client_id',auth('api')->id());
        })->where('order_id',$request->order_id)->findOrFail($request->offer_id);
        $order = Order::where('client_id',auth('api')->id())->findOrFail($request->order_id);
        if ($offer->offer_price > auth('api')->user()->wallet && $order->is_paid_by_wallet) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.ur_wallet_lt_offer_price')]);
        }

        \DB::beginTransaction();
        try {

            $offer->update(['price_offer_status' => 'accepted']);
            $order->offers()->where('id',"<>",$offer->id)->update(['price_offer_status' => 'rejected']);

            $notified_drivers = $order->driverNotifiedOrders->mapWithKeys(function ($item) use($offer){
                $drivers = [];
                if ($item['id'] == $offer->driver_id) {
                    $drivers[$item['id']] = ['status' => 'accepted'];
                }else {
                    $drivers[$item['id']] = ['status' => 'rejected'];
                }
                return $drivers;
            })->toArray();

            $order->driverNotifiedOrders()->syncWithoutDetaching($notified_drivers);
            $user = auth('api')->user();
            // $wallet_amount = 0;
            // if ($order->is_paid_by_wallet) {
            //     $free_wallet_balance = $user->free_wallet_balance - $offer->offer_price <= 0 ? 0 : ($user->free_wallet_balance - $offer->offer_price);
            //     $user->update(['wallet' => ($user->wallet - $offer->offer_price),'free_wallet_balance' => $free_wallet_balance]);
            //     $wallet_amount = $offer->offer_price;
            //
            // }
            $order->update(['accepted_offer_id' => $offer->id , 'order_status' => 'shipped' , 'order_status_times' => ['shipped' => date("Y-m-d h:i A")] , 'total_price' => $offer->offer_price , 'driver_id' => $offer->driver_id , 'car_id' => optional($offer->driver->car)->id]);
            // ,'wallet_amount' => $wallet_amount

            // if ($order->is_paid_by_wallet) {
            //     $order->driver->update(['wallet' => ($order->driver->wallet + $wallet_amount)]);
            // }

            $order->driver->driver()->updateOrCreate(['user_id' => $order->driver_id],['is_available' => 0]);
            $order->update(['share_link_uuid' => (string) Str::uuid()]);

            \DB::commit();
            $minutes_to_finish = ((int)convertArabicNumber(setting('waiting_time_to_finish_order'))) ?? 1;
            UpdateOrderStatus::dispatch($order,'admin_finish')->delay(now()->addMinutes($minutes_to_finish))->onQueue('low');
            $admins = User::whereIn('user_type',['admin','superadmin'])->get();
            \Notification::send($admins,new ChangeOrderStatusNotification($order));
            $fcm_data = [
                // 'title' => trans('dashboard.fcm.accept_offer_title'),
                'title' => trans('dashboard.fcm.'.$order->order_type.'.accept_offer_body',['order_number' => $order->id]),
                'body' => '',
                'notify_type' => 'accept_offer',
                'order_id' => $order->id,
                'order_type' => $order->order_type,
            ];
            pushFcmNotes($fcm_data,[$offer->driver_id]);
            $offer->driver->notify(new FCMNotification($fcm_data,['database']));
            return (new OrderResource($order))->additional(['status' => 'success' , 'message' => trans('api.messages.success_send_to_driver')]);
         }catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
         }
    }
}

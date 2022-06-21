<?php

namespace App\Http\Controllers\Api\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Driver\{OrderResource};
use App\Http\Requests\Api\Order\{OrderOfferRequest};
use App\Notifications\General\{FCMNotification};
use App\Models\{OrderOffer , User , Order};
use App\Notifications\Order\{ChangeOrderStatusNotification};
use App\Jobs\{UpdateOrderStatus};
use Illuminate\Validation\ValidationException;

class OfferController extends Controller
{

    public function store(OrderOfferRequest $request)
    {
        // if ($request->order_type != 'delivery' and $request->offer_price < (setting('min_offer_price')??10) ) {
        //     throw ValidationException::withMessages([
        //         'offer_price' => ['يجب أن تكون قيمة العرض مساوية أو أكبر من ' . (setting('min_offer_price')??10)],
        //     ]);
        // }

        $order = Order::whereNull('accepted_offer_id')->findOrFail($request->order_id);
        // if (!auth('api')->user()->subscribedPackage()->whereDate('end_at',">=",date("Y-m-d"))->where('is_paid',1)->exists()) {
        //     return response()->json(['status' => 'fail','data' => null, 'message' => trans('api.messages.sub_package_to_make_offers')],422);
        // }
        $canceled_finished_arr = ['client_cancel','driver_cancel','admin_cancel','client_finish','driver_finish','admin_finish'];
        if (in_array($order->order_status,$canceled_finished_arr)) {
            return response()->json(['status' => 'fail' , 'message' => trans('api.messages.cant_make_offer_on_cancel_or_finished_orders'),'data' => null],422);
        }

        $is_another_offers = auth('api')->user()->driverOffers()->where('order_offers.order_id',"<>",$order->id)->where('order_offers.price_offer_status','pending')->whereHas('order',function ($q) use($canceled_finished_arr,$order){
            $q->whereNotIn('orders.order_status',$canceled_finished_arr);
        })->exists();

        if ($is_another_offers) {
            return response()->json(['status' => 'fail' , 'message' => trans('api.messages.cant_make_offer_on_another_orders'),'data' => null],422);
        }

        \DB::beginTransaction();
        try {
           if ($order->order_status != 'client_recieve_offers') {
               $order->update(['order_status' => 'client_recieve_offers','order_status_times' => ['client_recieve_offers' => date("Y-m-d h:i A")]]);
               // $start_at = date("Y-m-d H:i:s",strtotime(optional($order->order_status_times)->pending));
               // $minutes_after_pending = (int)now()->diffInMinutes($start_at);
               $minutes_to_cancel = (((int)convertArabicNumber(setting('waiting_time_to_cancel_order'))) ?? 1);
               UpdateOrderStatus::dispatch($order,'admin_cancel','pending')->delay(now()->addMinutes($minutes_to_cancel))->onQueue('low');
           }
           $offer = $order->offers()->updateOrCreate(['order_id' => $request->order_id , 'driver_id' => auth('api')->id()],$request->validated()+['driver_id' => auth('api')->id()]);
           \DB::commit();
           $fcm_data = [
               'title' => trans('dashboard.fcm.new_offer_title'),
               'body' => trans('dashboard.fcm.new_offer_body',['driver' => auth('api')->user()->fullname,'offer_price' => $offer->offer_price , 'order_id' => $order->id]),
               'notify_type' => 'new_offer',
               'offer_id' => $offer->id,
               'order_id' => $order->id
           ];
           $admins = User::whereIn('user_type',['admin','superadmin'])->get();
           \Notification::send($admins,new ChangeOrderStatusNotification($order));
           \Notification::send($order->client,new FCMNotification($fcm_data,['database']));
           pushFcmNotes($fcm_data,[$order->client_id]);
           return (new OrderResource($order))->additional(['status' => 'success' , 'message' => trans('api.messages.success_send_to_client')]);
        }catch (\Exception $e) {
           \DB::rollback();
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }

}

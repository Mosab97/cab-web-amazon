<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\{OrderResource};
use App\Http\Requests\Api\Order\{
    OrderRequest,
    ClientChangeOrderStatus,
    RateDriverRequest,
    ClientRecieveOrderRequest,
    ResendOrderRequest,
    TipRequest
};

use App\Jobs\{SendOrderRequestToDriver, UpdateOrderStatus, SendFCMNotification};
use App\Notifications\{
    General\FCMNotification,
    Order\OrderNotification,
    Order\ChangeOrderStatusNotification
};
use App\Models\{Order, User, Driver, CancelReason, Device, PointOffer};
use App\Services\{WaslElmService};
use Illuminate\Support\Facades\Log;

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
        $orders = Order::where('client_id', auth('api')->id())->when($request->status, function ($q) use ($request) {
            switch ($request->status) {
                case 'pending':
                    $q->where('order_status', $request->status);
                    break;
                case 'current':
                    $q->whereIn('order_status', ['client_recieve_offers', 'shipped']);
                    break;
                case 'finished':
                    $q->whereIn('order_status', ['client_finish', 'admin_finish', 'driver_finish']);
                    break;
            }
        })->latest()->paginate(20);
        return OrderResource::collection($orders)->additional(['status' => 'success', 'message' => '']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $order_id)
    {
        $order = Order::where('client_id', auth('api')->id())->findOrFail($order_id);

        foreach (auth('api')->user()->unreadNotifications as $notification) {
            if (isset($notification->data['order_id']) && $notification->data['order_id'] == $order->id && is_null($notification->read_at)) {
                $notification->markAsRead();
                // notify client
            }
        }

        return (new OrderResource($order))->additional(['status' => 'success', 'message' => '']);
    }

    public function store(OrderRequest $request)
    {
        // \DB::beginTransaction();

        try {
            // if ($request->pay_type == 'wallet'){
            //     return response()->json(['data' => null , 'message' => trans('api.messages.wallet_is_soon'),'status' => 'fail'],422);
            // }
            $order = auth('api')->user()->clientOrders()->whereIn('order_status', ['pending', 'client_recieve_offers', 'shipped', 'start_trip', 'pre_client_accept_start', 'client_reject_start'])->first();
            if ($order) {
                return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.already_have_order')], 422);
                //trans('api.messages.no_live_order')
            }
            if ($request->pay_type == 'wallet' && auth('api')->user()->wallet < ($request->budget + ((float)setting('min_wallet_amount_found_when_order')))) {
                return response()->json(['data' => null, 'message' => trans('api.messages.ur_wallet_less_than_budget_plus_addition', ['min_wallet_order_amount' => (float)setting('min_wallet_amount_found_when_order')]), 'status' => 'fail'], 422);
            }
            $order_data = [
                'client_id' => auth('api')->id(),
                'order_status' => 'pending',
                'is_paid_by_wallet' => $request->pay_type == 'wallet' ? true : false,
                'pay_type' => $request->pay_type ?? 'cash',
                'order_status_times' => ['pending' => date("Y-m-d h:i A")],
            ];
            $order = Order::create($request->validated() + $order_data);

            $this->sendOrderToDrivers($order);

            $admins = User::whereIn('user_type', ['admin', 'superadmin'])->get();
            \Notification::send($admins, new OrderNotification($order));

            return (new OrderResource($order))->additional(['status' => 'success', 'message' => trans('api.messages.success_send_to_drivers')]);
        } catch (\Exception $e) {

            // \DB::rollback();
            return response()->json(['status' => 'fail', 'message' => trans('dashboard.messages.something_went_wrong_please_try_again'), 'data' => null], 500);
        }
    }

    public function changeOrderStatus(ClientChangeOrderStatus $request)
    {
        $order = Order::where('client_id', auth('api')->id())->findOrFail($request->order_id);
        if (in_array($order->order_status, ['pending', 'client_recieve_offers', 'shipped']) && $request->order_status != 'client_cancel') {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.' . $order->order_type . '.cant_finish_order_before_start_trip')]);
        } elseif (in_array($order->order_status, ['start_trip']) && $request->order_status != 'client_finish') {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.' . $order->order_type . '.cant_cancel_order_after_start_trip')]);
        } elseif (in_array($order->order_status, ['driver_cancel', 'admin_cancel']) && in_array($request->order_status, ['client_cancel', 'client_finish'])) {
            $fcm_data = [
                'title' => trans('api.messages.driver_cancel_order'),
                'body' => "",
                'notify_type' => 'order_canceled',
                'order_id' => $order->id
            ];
            pushFcmNotes($fcm_data, [$order->client_id, $order->driver_id]);
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.' . $order->order_type . '.cant_cancel_order_after_start_trip')]);
        } elseif (in_array($order->order_status, ['driver_cancel', 'admin_cancel', 'client_cancel']) && in_array($request->order_status, ['client_finish'])) {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.cant_finish_order_after_cancel')], 422);
        } elseif (in_array($order->order_status, ['driver_finish']) && $order->driver_id && $request->order_status == 'client_finish') {
            $fcm_data = [
                'title' => $order->order_type == 'ride' ? trans('api.messages.driver_finish_trip') : trans('api.messages.driver_finish_order'),
                'body' => "",
                'notify_type' => 'order_finished',
                'order_id' => $order->id
            ];
            pushFcmNotes($fcm_data, [$order->client_id]);
        }
        // \DB::beginTransaction();
        // try {
        $order_data = [];
        $client_data = [];

        if ($order->order_status == 'pre_client_accept_start' && $request->order_status == 'start_trip') {
            $fcm_data = [
                'title' => trans('api.messages.client_accept_start_trip'),
                'body' => trans('dashboard.fcm.client_start_trip_status_body', ['client' => $order->client->fullname]),
                'notify_type' => 'start_trip',
                'order_id' => $order->id,
                'order_status' => $order->order_status,
                // 'fcm_sound' => 'newOrder.mp3',
            ];
            pushFcmNotes($fcm_data, [$order->driver_id]);
        }
        if ($order->order_status == 'pre_client_accept_start' && $request->order_status == 'client_reject_start' && $order->order_type == 'delivery') {
            $fcm_data = [
                'title' => trans('api.messages.client_reject_start_trip'),
                'body' => "",
                'notify_type' => 'client_reject_start',
                'order_id' => $order->id,
                'order_status' => 'client_reject_start',
                // 'fcm_sound' => 'newOrder.mp3',
            ];
            pushFcmNotes($fcm_data, [$order->driver_id]);
            $order_data += ['order_status' => 'start_trip', 'order_status_times' => ['start_trip' => date('Y-m-d h:i A')]];
        }
        if ($order->order_status == 'pre_client_accept_start' && $request->order_status == 'client_reject_start' && $order->order_type == 'ride') {
            $fcm_data = [
                'title' => trans('api.messages.client_reject_start_trip'),
                'body' => "",
                'notify_type' => 'client_reject_start',
                'order_id' => $order->id,
                'order_status' => 'client_reject_start',
                // 'fcm_sound' => 'newOrder.mp3',
            ];
            pushFcmNotes($fcm_data, [$order->driver_id]);
            $order_data += ['order_status' => 'shipped', 'order_status_times' => ['shipped' => date('Y-m-d h:i A')]];
        }

        if (!in_array($request->order_status, ['client_reject_start'])) {
            $order_data += ['order_status' => $request->order_status, 'order_status_times' => [$request->order_status => date('Y-m-d h:i A')]];
        }

        if (in_array($request->order_status, ['client_finish']) && !$order->finished_at) {
            $client = auth('api')->user();
            $new_wallet = 0;
            $driver = User::where('user_type', 'driver')->find($order->driver_id);
            $app_commission = optional(optional($driver->subscribedPackage)->package)->commission;
            $driver_wallet = (float)$driver->wallet;
            // Point Offers
            use_point_offer($client, $driver);

            $wallet_amount = $order->total_price;
            $wallet_client_amount = $order->total_price;
            $withdrawal_from_client = false;

            if (
                setting('enable_make_order_and_take_order') &&
                $client->clientOrders()->whereIn('order_status', ['admin_finish', 'client_finish', 'driver_finish'])->whereDate('created_at', date('Y-m-d'))->where('payer', 'client')->count() > 0 &&
                $client->clientOrders()->whereIn('order_status', ['admin_finish', 'client_finish', 'driver_finish'])->whereDate('created_at', date('Y-m-d'))->where('payer', 'app')->count() < 1 && (float)setting('second_trip_max_price') <= $wallet_amount
            ) {
                $wallet_client_amount = max($wallet_amount - (float)setting('second_trip_max_price'), 0);
                $withdrawal_from_client = true;
                $order_data += ['payer' => 'app', 'amount_paid_from_payer' => $wallet_client_amount];
            }

            if ($order->is_paid_by_wallet) {
                $free_wallet_balance = max(($client->free_wallet_balance - $wallet_client_amount), 0);

                if ($wallet_client_amount) {
                    $new_wallet = wallet_transaction($client, $wallet_client_amount, 'withdrawal', $order);
                    $client->update(['wallet' => $new_wallet, 'free_wallet_balance' => $free_wallet_balance]);
                }

                if ($client->temporaryWallets()->live()->where('rest_amount', ">", 0)->count() && $wallet_client_amount) {
                    $temp_wallet = $client->temporaryWallets()->live()->where('rest_amount', ">", 0)->first();

                    $temp_wallet->update(['rest_amount' => max(0, ($temp_wallet->rest_amount - $wallet_client_amount))]);
                }

                wallet_transaction($driver, $wallet_amount, 'charge', $order);

                $driver_wallet += $wallet_amount;
            } else {
                $wallet_driver_amount = $wallet_amount > $wallet_client_amount ? ($wallet_amount - $wallet_client_amount) : null;
                if ($wallet_driver_amount) {
                    wallet_transaction($driver, $wallet_driver_amount, 'charge', $order);
                    $driver_wallet += $wallet_driver_amount;
                }
                if ($wallet_client_amount && $withdrawal_from_client) {
                    $new_wallet = wallet_transaction($client, $wallet_client_amount, 'withdrawal', $order);
                    $client->update(['wallet' => $new_wallet]);
                }
            }

            if ($driver->driver->is_on_default_package) {
                $trip_price = 0;
                if ((int)$driver->driver->free_order_counter < (int)setting('number_of_free_orders_on_default_package')) {
                    $driver->driver()->update(['free_order_counter' => \DB::raw('free_order_counter + 1')]);
                } else {
                    $trip_price = (setting('price_of_default_package_order') ? (float)setting('price_of_default_package_order') : 1);

                    $new_wallet = wallet_transaction($driver, $trip_price, 'withdrawal', $order);

                    $driver_wallet -= $trip_price;
                }
                $order_data += ['is_driver_on_default_package' => 1, 'default_package_price' => $trip_price];
            }

            $start_at = date("Y-m-d H:i:s", strtotime(optional($order->order_status_times)->start_trip));
            $order_data += ['finished_at' => now(), 'actual_time' => now()->diffInMinutes($start_at) ?? $order->expected_time, 'wallet_amount' => $wallet_amount];

            $driver->driver()->updateOrCreate(['user_id' => $order->driver_id], ['is_available' => 1]);

            // if ($driver->driver->is_signed_to_elm) {
            //     $elm_reply = $this->finishTrip($order);
            //     $order_data +=['elm_reply' => $elm_reply];
            // }
            $order_data += ['share_link_uuid' => null, 'client_recieved_order' => true, 'app_commission' => $app_commission, 'is_deduct_commission' => true];

            if ($app_commission) {
                wallet_transaction($driver, $app_commission, 'withdrawal', $order);

                $driver_wallet -= $app_commission;
            }

            $driver->update(['wallet' => $driver_wallet]);
            // $client->update($client_data);
            $fcm_data = [
                'title' => $order->order_type == 'ride' ? trans('api.messages.client_finish_trip') : trans('api.messages.client_finish_order'),
                'body' => "",
                'notify_type' => 'order_finished',
                'can_show_lucky_boxes' => $order->luckyBoxes()->where('gift_user.user_id', auth('api')->id())->doesntExist(),
                'order_id' => $order->id,
                // 'fcm_sound' => 'newOrder.mp3',
            ];

            pushFcmNotes($fcm_data, [$order->driver_id]);
        }
        if (in_array($request->order_status, ['client_cancel'])) {
            $order_data += ['order_status' => 'client_cancel', 'order_status_times' => ['client_cancel' => date('Y-m-d h:i A')]];
            if ($request->cancel_reason_id) {
                $cancel_reason = CancelReason::findOrFail($request->cancel_reason_id);
                $order_data += ['cancel_reason_id' => $cancel_reason->id, 'cancel_reason_data' => $cancel_reason->toJson()];
            }
            if ($order->driver_id) {
                $order_data += ['share_link_uuid' => null];
                $order->driver->driver()->updateOrCreate(['user_id' => $order->driver_id], ['is_available' => 1]);
                $fcm_data = [
                    'title' => trans('api.messages.client_cancel_order'),
                    'body' => "",
                    'notify_type' => 'order_canceled',
                    'order_id' => $order->id,
                    // 'fcm_sound' => 'newOrder.mp3',
                ];
                pushFcmNotes($fcm_data, [$order->driver_id]);
            }
        }

        $order->update($order_data);

        // \DB::commit();
        if ($request->order_status == 'client_finish') {
            $fcm_data = [
                'title' => trans('dashboard.fcm.change_order_status_title'),
                'body' => trans('dashboard.fcm.change_order_status_body', ['client' => $order->client->fullname, 'order_type' => trans('dashboard.order.order_types.' . $order->order_type)]),
                'notify_type' => 'change_order_status',
                'order_id' => $order->id,
                'order_type' => $order->order_type,
                'order_status' => $order->order_status,
            ];
            // \Notification::send($order->driver,new FCMNotification($fcm_data));
        }

        $admins = User::whereIn('user_type', ['admin', 'superadmin'])->get();
        \Notification::send($admins, new ChangeOrderStatusNotification($order));
        return (new OrderResource($order))->additional(['status' => 'success', 'message' => trans('api.messages.success_send_to_drivers')]);

        // }catch (\Exception $e) {
        //    \DB::rollback();
        //    return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        // }

    }


    public function SetRate(RateDriverRequest $request)
    {
        $order = Order::where('client_id', auth('api')->id())->whereNotNull('driver_id')->findOrFail($request->order_id);

        $client = auth('api')->user();
        $client->rateDrivers()->syncWithoutDetaching([$order->driver_id => ['rate' => $request->rate, 'review' => $request->review, 'order_id' => $order->id]]);
        $order->driver()->update(['rate_avg' => $order->rates()->avg('rate')]);
        if (@$order->driver->driver->is_signed_to_elm) {
            $elm_reply = $this->finishTrip($order);
            $order->update(['elm_reply' => $elm_reply]);
        }
        return (new OrderResource($order))->additional(['status' => 'success', 'message' => trans('dashboard.messages.success_update')]);
    }

    public function clientRecieveOrder(ClientRecieveOrderRequest $request)
    {
        $order = Order::where('client_id', auth('api')->id())->whereNotNull('driver_id')->findOrFail($request->order_id);
        $order->update(['client_recieved_order' => true]);
        return (new OrderResource($order))->additional(['status' => 'success', 'message' => trans('dashboard.messages.success_update')]);
    }


    public function resendOrder(ResendOrderRequest $request)
    {
        $order = Order::where('client_id', auth('api')->id())->whereNull('driver_id')->where('order_status', 'pending')->findOrFail($request->order_id);

        $order->update(['budget' => $request->budget]);

        $this->sendOrderToDrivers($order);

        return (new OrderResource($order))->additional(['status' => 'success', 'message' => trans('api.messages.success_send_to_drivers')]);
    }

    protected function sendOrderToDrivers($order)
    {
        $minutes = ((int)convertArabicNumber(setting('waiting_time_for_driver_response'))) ? ((int)convertArabicNumber(setting('waiting_time_for_driver_response'))) : 1;
        $minutes_to_cancel = ((int)convertArabicNumber(setting('waiting_time_to_cancel_order'))) ? ((int)convertArabicNumber(setting('waiting_time_to_cancel_order'))) : 1;

        $drivers = Driver::whereHas('user', function ($q)  use ($order) {
            $q->available()->whereHas('profile', function ($q) {
                $q->whereNotNull('profiles.last_login_at');
            })->whereHas('devices')
                ->whereHas('car', function ($q) use ($order) {
                    $q->where('cars.car_type_id', $order->car_type_id);
                });
        })
//            ->whereIn('driver_type', [$order->order_type, 'both'])->where(function ($q) {
//        })
            ->when($order->start_lat && $order->start_lng, function ($q) use ($order) {
            $q->nearest($order->start_lat, $order->start_lng);
        })->when(((int)convertArabicNumber(setting('number_drivers_to_notify'))) > 0, function ($q) {
            $q->take(convertArabicNumber(setting('number_drivers_to_notify')));
        })->get();

        $drivers_ids_array = $drivers->pluck('user_id')->toArray();
        $db_drivers = User::whereIn('id', $drivers_ids_array)->get();

        $fcm_body = trans('dashboard.fcm.new_order_body', ['client' => auth('api')->user()->fullname, 'order_type' => trans('dashboard.order.order_types.' . $order->order_type)]);

        if ($order->order_type == 'ride') {
            $fcm_body = trans('dashboard.fcm.new_trip_body', ['client' => auth('api')->user()->fullname, 'order_type' => trans('dashboard.order.order_types.' . $order->order_type)]);
        }
        $fcm_data = [
            'title' => trans('dashboard.fcm.new_order_title'),
            'body' => $fcm_body,
            'notify_type' => 'new_order',
            'order_id' => $order->id,
            'order_type' => $order->order_type,
            // 'fcm_sound' => 'newOrder.mp3',
            'fcm_sound' => 'default',
        ];
        SendFCMNotification::dispatch($fcm_data, $drivers_ids_array)->onQueue('wallet');

        $notified_drivers = $drivers->mapWithKeys(function ($item) {
            return [$item['user_id'] => ['status' => 'notify', 'notify_number' => 1]];
        })->toArray();
        $order->driverNotifiedOrders()->attach($notified_drivers);
        \Notification::send($db_drivers, new FCMNotification($fcm_data, ['database']));

        // Resend If Not Offers
//        SendOrderRequestToDriver::dispatch($order, $drivers_ids_array, (int)setting('number_drivers_to_notify'))->delay(now()->addMinutes($minutes))->onQueue('high');
//        UpdateOrderStatus::dispatch($order, 'admin_cancel')->delay(now()->addMinutes($minutes_to_cancel))->onQueue('low');
    }

    public function sendTip(TipRequest $request, $order_id)
    {
        $order = Order::where('client_id', auth('api')->id())->whereNotNull('driver_id')->findOrFail($order_id);

        $user = auth('api')->user();
        if ($user->wallet < (float) $request->amount) {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.ur_wallet_lt_tip_amount')], 422);
        }
        $another_user = $order->driver;
        if ($request->amount) {
            $user_wallet = wallet_transaction($user, $request->amount, 'withdrawal', $order);
            $another_user_wallet = wallet_transaction($another_user, $request->amount, 'charge', $order);

            $user->update(['wallet' => $user_wallet]);
            $another_user->update(['wallet' => $another_user_wallet]);
            $fcm_data = [
                'title' => trans('api.messages.new_transfer_transaction_title'),
                'body' => trans('api.messages.new_transfer_transaction_body', ['from' => $user->fullname ?? $user->phone, 'amount' => $request->amount]),
                'notify_type' => 'transfer_transaction',
                'order_id' => $order->id
            ];
            pushFcmNotes($fcm_data, [$another_user->id]);
        }
        $order->update(['tip' => $request->amount]);
        return (new OrderResource($order))->additional(['status' => 'success', 'message' => trans('api.messages.success_transfer_from_ur_wallet_to_another')]);
    }
}

<?php

namespace App\Http\Controllers\Api\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Driver\{PackageResource};
use App\Http\Requests\Api\Driver\Package\{PackageSubscribeRequest , RenewFromWalletRequest , ExtendPackageSubscribeRequest};
use App\Models\{Package , User , PackageDriver , Driver};

class PackageController extends Controller
{
    public function index()
    {
        $package = optional(auth('api')->user()->driver)->subscribedPackage;
        $driver = auth('api')->user();
        $car = $driver->car;
        $can_pay_with_wallet = (bool) setting('enable_update_subscribe_from_wallet');

        if (!$package && $car && $driver->driver->is_admin_accept && $driver->driver->is_on_default_package && $driver->wallet > -(setting('min_wallet_to_recieve_order') ?? 10)) {
            return response()->json([
                'status' => 'success' ,
                'data' => ['is_admin_accept' => true] ,
                'message' => trans('api.messages.u_r_on_default_package') ,
                'is_admin_accept' => true,
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }elseif (!$package && $car && $driver->driver->is_admin_accept && $driver->driver->is_on_default_package && $driver->wallet <= -(setting('min_wallet_to_recieve_order') ?? 10)) {
            return response()->json([
                'status' => 'success' ,
                'data' => ['is_admin_accept' => true] ,
                'message' => trans('api.messages.plz_charge_wallet_or_update_package') ,
                'is_admin_accept' => true,
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }elseif ($package && $car && $driver->driver->is_admin_accept && $driver->driver->is_on_default_package && $driver->wallet > -(setting('min_wallet_to_recieve_order') ?? 10)) {

            return (new PackageResource($package))->additional([
                'status' => 'success',
                'message' => trans('api.messages.u_r_on_default_package_with_subscribed_on_package'),
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_admin_accept' => (boolean) $driver->driver->is_admin_accept,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }elseif ($package && $car && $driver->driver->is_admin_accept && $driver->driver->is_on_default_package && $driver->wallet < -(setting('min_wallet_to_recieve_order') ?? 10)) {

            return (new PackageResource($package))->additional([
                'status' => 'success',
                'message' => trans('api.messages.u_r_on_default_package_with_subscribed_on_package_and_wallet_lt_default'),
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_admin_accept' => (boolean) $driver->driver->is_admin_accept,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }elseif (!$package && $car && !$driver->driver->is_admin_accept) {
            return response()->json([
                'status' => 'success' ,
                'data' => ['is_admin_accept' => false] ,
                'message' => trans('api.messages.refuse_ur_car_data') ,
                'is_admin_accept' => false,
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }elseif ($package && $car && !$driver->driver->is_admin_accept) {
            return response()->json([
                'status' => 'success' ,
                'data' => ['is_admin_accept' => false] ,
                'message' => trans('api.messages.refuse_ur_car_data'),
                'is_admin_accept' => false,
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }elseif (!$car) {
            return response()->json([
                'status' => 'success' ,
                'data' => ['is_admin_accept' => false] ,
                'message' => trans('api.messages.u_havnt_car'),
                'is_admin_accept' => false,
                'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
                'is_expired' => (bool)(!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
                'can_pay_with_wallet' => $can_pay_with_wallet,
                'tax'=> (float)setting('tax')
            ]);
        }

        return (new PackageResource($package))->additional([
            'status' => 'success',
            'message' => '',
            'is_on_default_package' => (boolean) $driver->driver->is_on_default_package,
            'is_admin_accept' => (boolean) $driver->driver->is_admin_accept,
            'is_expired' => (!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),
            'can_pay_with_wallet' => $can_pay_with_wallet,
            'tax'=> (float)setting('tax')
        ]);
    }

    public function store(PackageSubscribeRequest $request)
    {
        $package_data = Package::active()->findOrFail($request->package_id);
        $tax = (float) (setting('tax')/100);
        \DB::beginTransaction();
        try {
            $driver = Driver::firstOrCreate(['user_id' => auth('api')->id()]);
            $driver_package = optional(auth('api')->user()->driver)->subscribedPackage;
            
            if ($driver_package && @optional($driver_package->end_at)->gt(now()) && $driver_package->package_id == $request->package_id && $driver_package->is_paid) {
                $price = $package_data->package_price;
                if ($package_data->is_discount_active && $package_data->start_discount_at && now()->isBetween($package_data->start_discount_at,$package_data->end_discount_at)) {
                    $price = $price * ($package_data->discount_percent/100);
                }

                $package = auth('api')->user()->driverPackages()->create([
                    'added_by_id' => auth('api')->id(),
                    'package_id' => $request->package_id,
                    'subscribed_at' => now(),
                    'end_at' => $driver_package->end_at->addMonths(($package_data->duration + $package_data->free_duration)),
                    'price' => $price,
                    'is_paid' => true,
                    'tax' => $tax,
                    'subscribe_status' => 'subscribed',
                    'package_data' => $package_data->toJson(),
                    'transaction_id' => $request->transaction_id,
                    'transaction_data' => $request->transaction_data,
                    'driver_id' => auth('api')->id(),
                ]);
                $driver_package->update(['subscribe_status' => 'extended']);
                $driver->update(['subscribed_package_id' => $package->id,'is_on_default_package' => false]);
                $message = trans('api.messages.success_subscribe_renewal');
                
            }elseif ($driver_package && @optional($driver_package->end_at)->gt(now()) && $driver_package->package_id != $request->package_id && $driver_package->is_paid) {
                \Log::info('log1');
                $price = $package_data->package_price;
                if ($package_data->is_discount_active && $package_data->start_discount_at && now()->isBetween($package_data->start_discount_at,$package_data->end_discount_at)) {
                    $price = $price * ($package_data->discount_percent/100);
                }

                $package = auth('api')->user()->driverPackages()->create([
                    'package_id' => $request->package_id,
                    'added_by_id' => auth('api')->id(),
                    'subscribed_at' => now(),
                    'end_at' => $driver_package->end_at->addMonths(($package_data->duration + $package_data->free_duration)),
                    'price' => $price,
                    'is_paid' => true,
                    'tax' => $tax,
                    'package_data' => $package_data->toJson(),
                    'subscribe_status' => 'subscribed',
                    'transaction_id' => $request->transaction_id,
                    'transaction_data' => $request->transaction_data,
                ]);
                $driver_package->update(['subscribe_status' => 'extended']);
                $driver->update(['subscribed_package_id' => $package->id,'is_on_default_package' => false]);
                $message = trans('api.messages.success_subscribed_and_start_after_current_finish');
               
            }elseif ($driver_package && @optional($driver_package->end_at)->gt(now()) && $driver_package->package_id == $request->package_id && !$driver_package->is_paid) {
                
                $price = $package_data->package_price;
                if ($package_data->is_discount_active && $package_data->start_discount_at && now()->isBetween($package_data->start_discount_at,$package_data->end_discount_at)) {
                    $price = $price * ($package_data->discount_percent/100);
                }

                $driver_package->update([
                    'is_paid' => true,
                    'subscribed_at' => now(),
                    'end_at' => now()->addMonths(($package_data->duration + $package_data->free_duration)),
                    'price' => $price,
                    'is_paid' => true,
                    'tax' => $tax,
                    'package_data' => $package_data->toJson(),
                    'subscribe_status' => 'subscribed',
                    'transaction_id' => $request->transaction_id,
                    'transaction_data' => $request->transaction_data,
                ]);
                $driver->update(['is_on_default_package' => false]);
               
            }elseif ($driver_package && @optional($driver_package->end_at)->gt(now()) && $driver_package->package_id != $request->package_id && ! $driver_package->is_paid) {
                $driver_package->update(['subscribe_status' => 'finished']);
                \Log::info('log3');
                $driver->update(['is_on_default_package' => true]);
            }else{
                $price = $package_data->package_price;
                
                if ($package_data->is_discount_active && $package_data->start_discount_at && now()->isBetween($package_data->start_discount_at,$package_data->end_discount_at)) {
                    $price = $price * ($package_data->discount_percent/100);
                }

                $package = auth('api')->user()->driverPackages()->create([
                    'package_id' => $request->package_id,
                    'added_by_id' => auth('api')->id(),
                    'subscribed_at' => now(),
                    'end_at' => now()->addMonths(($package_data->duration + $package_data->free_duration)),
                    'price' => $price,
                    'is_paid' => true,
                    'tax' => $tax,
                    'package_data' => $package_data->toJson(),
                    'subscribe_status' => 'subscribed',
                    'transaction_id' => $request->transaction_id,
                    'transaction_data' => $request->transaction_data,
                ]);
                $driver->update(['subscribed_package_id' => $package->id,'is_on_default_package' => false]);
                $message = trans('api.messages.success_subscribed');
                
            }

            auth('api')->user()->walletTransactions()->create([
                'transaction_id' => $request->transaction_id,
                'transaction_type' => 'charge',
                'amount' => $package->price,
                'wallet_before' => auth('api')->user()->wallet,
                'wallet_after' => auth('api')->user()->wallet,
                'added_by_id' => auth('api')->id(),
                'transfer_status' => 'transfered',
                'app_typeable_type' => 'App\Models\PackageDriver',
                'app_typeable_id' => $package->id,
            ]);
           \DB::commit();

           return (new PackageResource($package))->additional(['status' => 'success' , 'message' => $message]);
        }catch (\Exception $e) {
            \Log::info($e) ;
           \DB::rollback();
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }

    public function extendPackage(ExtendPackageSubscribeRequest $request)
    {
        $package_data = Package::active()->findOrFail($request->package_id);
        $tax = (float) (setting('tax')/100);
        \DB::beginTransaction();
        try {
            $driver = Driver::firstOrCreate(['user_id' => auth('api')->id()]);
            $driver_package = optional(auth('api')->user()->driver)->subscribedPackage;
            if ($driver_package->is_use_extend) {
                return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.u_r_use_this_offer')]);
            }
            if ($driver_package && @optional($driver_package->end_at)->gt(now()) && $driver_package->is_paid) {
                if ($package_data->is_extend_active && $package_data->start_extend_at && now()->isBetween($package_data->start_extend_at,$package_data->end_extend_at)) {
                    $driver_package->update(['subscribe_status' => 'extended','end_at' => $driver_package->end_at->addDays((int)$package_data->extend_duration) , 'is_use_extend' => true]);

                }
                $message = trans('api.messages.success_extend_subscribe');
            }else{
                $message = trans('api.messages.ur_sub_is_expired_or_not_have_package');
            }
           \DB::commit();

           return (new PackageResource($driver->subscribedPackage))->additional(['status' => 'success' , 'message' => $message]);
        }catch (\Exception $e) {
           \DB::rollback();
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }

    public function checkSubscribtion()
    {
        $driver = auth('api')->user();
        $package = optional($driver->driver)->subscribedPackage;
        $message = '';
        $is_expired = false;
        if (!optional($driver->driver)->is_admin_accept){
            $message = trans('api.messages.admin_not_accept_ur_data');
        }elseif($driver->driver->is_on_default_package && $driver->driver->subscribed_package_id) {
            $is_expired = true;
            $message = trans('api.messages.u_r_on_default_package_with_subscribed_on_package');
        }elseif ($driver->driver->is_on_default_package) {
            $is_expired = true;
            $message = trans('api.messages.u_r_on_default_package');
        }elseif (!$driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))) {
            $is_expired = true;
            $message = trans('api.messages.u_r_on_default_package');
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'is_expired' => $is_expired,
                'is_on_default_package' => ($driver->driver->is_on_default_package && (!$package || (@$package->end_at && optional($package->end_at)->lt(now()) || !@$package->is_paid))),//(boolean) $driver->driver->is_on_default_package,
                'is_admin_accept' => (boolean) $driver->driver->is_admin_accept,
            ],
            'message' => $message
        ]);
    }

    public function renewSubscribtionFromWallet(RenewFromWalletRequest $request)
    {
        $can_pay_with_wallet = (bool) setting('enable_update_subscribe_from_wallet');
        if (!$can_pay_with_wallet) {
            return response()->json(['status' => 'fail' , 'message' => setting('enable_update_subscribe_from_wallet_msg'), 'data' => null],422);
        }
        $driver = auth('api')->user();
        $package = Package::active()->findOrFail($request->package_id);
        if($driver->renewRequests()->where(['package_id' => $package->id ,'renew_status' => 'pending'])->exists()){
            return response()->json(['status' => 'success' , 'message' => trans('api.messages.u_have_oldest_request_wait_for_replying') , 'data' => null]);
        }
        // if ($driver->wallet < $package->package_price) {
        //     return response()->json(['status' => 'fail' , 'message' => trans('api.messages.ur_wallet_lt_package_price') , 'data' => null]);
        // }
        $driver->renewRequests()->updateOrCreate(['driver_id' => $driver->id,'renew_status' => 'pending'],$request->validated(),['renew_status' => 'pending','last_changed_by_id' => $driver->id,'driver_id' => $driver->id]);
        return response()->json(['status' => 'success' , 'message' => trans('api.messages.request_send_to_admin_will_reply_soon') , 'data' => null]);
    }

    public function checkRenewSubscribtionFromWallet()
    {
        $message = '';
        $data = ['can_pay_with_wallet' => true];
        if (! (bool) setting('enable_update_subscribe_from_wallet')) {
            $message = trans('api.messages.this_service_unavailable_now');
            $data = ['can_pay_with_wallet' => false];
        }
        return response()->json(['status' => 'success' , 'message' => $message, 'data' => $data]);
    }

}

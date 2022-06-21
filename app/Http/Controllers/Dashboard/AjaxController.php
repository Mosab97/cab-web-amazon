<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User , City , Brand,
    CarModel , Car , Package,
    Order , Driver , PackageDriver,
    WalletTransaction , GeneralInviteCode,
    AppAd , TemporaryWallet
};
use App\Http\Requests\Dashboard\User\{
    UpdateUserWalletRequest, UpdateUserDeptRequest, AddBalanceToAllRequest, AcceptDriverDataRequest, UserHealthStatusDataRequest, SetWalletToZeroRequest, ChangeDriverTypeRequest, SetNewPackageRequest, SetNewPackageToAllRequest,
    AddTempBalanceToAllRequest,ConvertUnavailableDriversToAvailableRequest
};
use App\Http\Requests\Dashboard\Order\{OrderStatusRequest};
use App\Http\Requests\Dashboard\Package\{
    UpdateSubscribtionRequest, SubscribePackageRequest , SubscribeAllDriversPackageRequest
};
use App\Notifications\General\{GeneralNotification , FCMNotification};
use App\Notifications\Order\{ChangeOrderStatusNotification};
use App\Http\Requests\Dashboard\WalletTransaction\{WalletTransactionRequest};
use App\Jobs\{UpdateWallet , ChangePackageOfDrivers , UpdateWalletByTempBalance , UpdateTempWallet};
use App\Services\{WaslElmService};
use Carbon\Carbon;

class AjaxController extends Controller
{
    use WaslElmService;

    public function checkIfTempBalance(Request $request)
    {
        $wallet_temps = TemporaryWallet::finished()->where('is_expired',0)->get();

        foreach ($wallet_temps as $wallet) {
            $wallet->update(['is_expired' => 1]);
            // $wallet->user->update(['wallet' => \DB::raw('wallet -'.$wallet->rest_amount)]);
            $new_wallet = wallet_transaction($wallet->user, $wallet->rest_amount, 'withdrawal', $wallet);
            $wallet->user->update(['wallet' => $new_wallet]);
        }
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function getUsersByType($user_type = 'client')
    {
        $users = User::where('user_type',$user_type)->get();
        $view = view('dashboard.ad.ajax.'.$user_type,compact('users'))->render();
        return response()->json(['value' => 1 , 'view' => $view]);
    }

    public function getUsersByTypeSearch(Request $request, $user_type = 'client')
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $users = User::where('user_type',$user_type)->where(function($q)use($keyword){
                $q->where('fullname',"LIKE","%{$keyword}%")->orWhere('email',"LIKE","%{$keyword}%")->orWhere('phone',"LIKE","%{$keyword}%");
            })->simplePaginate(20);
            return response()->json($users);
        }
    }

    public function getCitiesByCountry($country_id)
    {
        $cities = City::where('country_id',$country_id)->get()->pluck('name','id');
        $view = view('dashboard.ad.ajax.city',compact('cities'))->render();
        return response()->json(['value' => 1 , 'view' => $view]);
    }

    public function getCarSearch(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $cars = Car::when($keyword,function ($q) use($keyword) {
                $q->whereHas('brand',function ($q) use($keyword) {
                    $q->whereTranslationLike('name',"%{$keyword}%",'ar')->orWhereTranslationLike('name',"%{$keyword}%",'en')->orWhereTranslationLike('desc',"%{$keyword}%",'ar')->orWhereTranslationLike('desc',"%{$keyword}%",'en');
                })->orWhereHas('carModel',function ($q) use($keyword) {
                    $q->whereTranslationLike('name',"%{$keyword}%",'ar')->orWhereTranslationLike('name',"%{$keyword}%",'en')->orWhereTranslationLike('desc',"%{$keyword}%",'ar')->orWhereTranslationLike('desc',"%{$keyword}%",'en');
                })->orWhereHas('carType',function ($q) use($keyword) {
                    $q->whereTranslationLike('name',"%{$keyword}%",'ar')->orWhereTranslationLike('name',"%{$keyword}%",'en')->orWhereTranslationLike('desc',"%{$keyword}%",'ar')->orWhereTranslationLike('desc',"%{$keyword}%",'en');
                })->orWhere('diving_licence_no',$keyword)
                ->orWhere('plate_number',$keyword)
                ->orWhere('license_serial_number',$keyword);
            })->paginate(20);
            return response()->json($cars);
        }
    }

    public function getCarModelsByBrand($brand_id)
    {
        $car_models = CarModel::where('brand_id',$brand_id)->get()->pluck('name','id');
        $view = view('dashboard.car.ajax.car_model',compact('car_models'))->render();
        return response()->json(['value' => 1 , 'view' => $view]);
    }

    public function updateUserWallet(UpdateUserWalletRequest $request , $user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->wallet > $request->wallet) {
            $amount = $user->wallet - $request->wallet;
            $free_wallet_balance = $user->free_wallet_balance - $amount <= 0 ? 0 : ($user->free_wallet_balance - $amount);

            $before_wallet_charge = ['wallet_before' => $user->wallet , 'wallet_after' => $request->wallet , 'transaction_type' => 'withdrawal' , 'added_by_id' => auth()->id(),'amount' => $amount,'transfer_status' => 'transfered'];
            $user->walletTransactions()->create($before_wallet_charge);
            $user->update(['wallet' => $request->wallet,'free_wallet_balance' => $free_wallet_balance]);
        }elseif($user->wallet < $request->wallet){
            $amount = $request->wallet - $user->wallet;
            $free_wallet_balance = $user->free_wallet_balance + $amount;

            $before_wallet_charge = ['wallet_before' => $user->wallet , 'wallet_after' => $request->wallet , 'transaction_type' => 'charge' , 'added_by_id' => auth()->id(),'amount' => $amount,'transfer_status' => 'transfered'];
            $user->walletTransactions()->create($before_wallet_charge);

            $user->update(['wallet' => $request->wallet ,'free_wallet_balance' => $free_wallet_balance]);
        }
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function updateUserDept(UpdateUserDeptRequest $request , $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['user_dept_to_app' => $request->dept]);
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function setUserWalletZero(SetWalletToZeroRequest $request , $user_id)
    {
        if ($request->user_type && !auth()->user()->hasPermissions($request->user_type,'wallet')) {
            return response()->json([ 'value' => 0,'errors' => [trans('dashboard.error.403_msg')]], 422);
        }

        $new_wallet = '';
        if ($user_id == 'all') {
            User::where('user_type',$request->user_type)->when($request->user_type,function ($q) use($request) {
                if ($request->user_type == 'client') {
                    $q->where(function ($q) use($request) {
                        $q->when($request->order_status == 'clients_not_have_orders',function ($q) {
                            $q->whereDoesntHave('clientOrders');
                        })->when($request->order_status == 'clients_not_have_orders',function ($q) {
                            $q->whereDoesntHave('clientOrders',function ($q) {
                                $q->whereIn('order_status',['client_finish','admin_finish','driver_finish']);
                            });
                        })/*->when($request->order_status == 'clients_not_use_lucky_boxes',function ($q) {
                            $q->doesntHave('luckyBoxes');
                        })*/->when($request->order_status == 'clients_not_charge_thier_wallet',function ($q) {
                            $q->whereDoesntHave('walletTransactions',function ($q) {
                                $q->whereNotNull('transaction_id');
                            })->orWhereDoesntHave('walletTransactions');
                        });
                    });
                }elseif ($request->user_type == 'driver') {
                    $q->where(function ($q) {
                        $q->whereDoesntHave('driverOrders',function ($q) {
                            $q->whereIn('order_status',['client_finish','admin_finish','driver_finish']);
                        })->orWhereDoesntHave('driverOrders');
                    });
                }
            })->when($request->user_list,function ($q) use($request) {
                $q->whereIn('users.id',$request->user_list);
            })->update(['wallet' => 0 , 'free_wallet_balance' => 0]);
        }else{
            $user = User::where('user_type',$request->user_type)->findOrFail($user_id);
            $new_wallet = $user->wallet;
            if ($user->wallet > 0) {
                $new_wallet = wallet_transaction($user , $user->wallet , 'withdrawal');
            }elseif($user->wallet < 0){
                $new_wallet = wallet_transaction($user , - $user->wallet , 'charge');
            }
            $user->update(['wallet' => $new_wallet,'free_wallet_balance' => 0]);
        }
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_set_update_user_wallet_by_zero'),'wallet' => $new_wallet]);
    }

    public function addBalanceToAll(AddBalanceToAllRequest $request )
    {
        if ($request->user_type && !auth()->user()->hasPermissions($request->user_type,'wallet')) {
            return response()->json([ 'value' => 0,'errors' => [trans('dashboard.error.403_msg')]], 422);
        }
        UpdateWallet::dispatch($request->user_type , $request->amount , $request->user_list)->onQueue('wallet');

        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function convertUnavailableDriversToAvailable(ConvertUnavailableDriversToAvailableRequest $request)
    {
        $drivers = Driver::when($request->driver_list,function ($q) use($request) {
            $q->whereIn('user_id',$request->driver_list);
        })->when($request->status,function ($q) use($request) {
            switch ($request->status) {
                case 'deactive':
                    $q->whereHas('user',function ($q) {
                        $q->where('is_active',0);
                    });
                    break;
                case 'ban':
                    $q->whereHas('user',function ($q) {
                        $q->where('is_ban',1);
                    });
                    break;
                case 'with_special_needs':
                    $q->whereHas('user',function ($q) {
                        $q->where('is_with_special_needs',1);
                    });
                    break;
                case 'accepted':
                        $q->where('is_admin_accept',1);
                    break;
                case 'paid':
                    $q->whereHas('subscribedPackage',function ($q) {
                        $q->whereDate('package_drivers.end_at',">",date("Y-m-d"))->where('is_paid',1);
                    });
                    break;
                case 'driver_without_orders':
                    $q->whereHas('user',function ($q) {
                        $q->doesntHave('driverOrders');
                    });
                    break;
                case 'wait_accept_drivers':
                    $q->where('is_admin_accept',0)->where(function ($q) {
                        $q->whereNull('accepted_status')->orWhere('accepted_status','waiting');
                    });
                    break;
                case 'refused_drivers':
                    $q->where('is_admin_accept',0)/*->where('accepted_status','refused')*/;
                    break;
                case 'available':
                    $q->where(function ($q) {
                        $q->where('drivers.is_on_default_package',1)->where(['is_available' => 1 , 'is_driver_available' => 1 , 'is_admin_accept' => 1])
                        ->whereHas('user',function ($q) {
                            $q->where('wallet',">",-((float)setting('min_wallet_to_recieve_order')));
                        });
                    });
                    break;
                case 'disable_to_recieve_orders':
                    $q->where(function ($q) {
                        $q->where(['is_admin_accept' => 0])->orWhereHas('subscribedPackage',function ($q) {
                            $q->whereDate('package_drivers.end_at',"<",date("Y-m-d"))->where('package_drivers.is_paid',false);
                            })->orWhere('is_available',false)->orWhere('is_driver_available',false);
                    });
                    break;
                case 'enable_to_recieve_orders':
                    $q->where(function ($q) {
                        $q->where(['is_available' => 1])->whereHas('subscribedPackage',function ($q) {
                            $q->whereDate('package_drivers.end_at',">=",date("Y-m-d"))->where('package_drivers.is_paid',true);
                        });
                    });
                    break;
                case 'not_developer_available':
                        $q->where(['is_available' => 1]);
                    break;
                case 'not_available':
                    // $q->whereHas('driver',function ($q) {
                    //     $q->where(['is_on_default_package' => true , 'is_admin_accept' => 1])
                    //         ->whereHas('user',function ($q) {
                    //              $q->where('wallet',"<=",-(setting('min_wallet_to_recieve_order') ?? 10));
                    //        });
                    //    });
                    $q->whereHas('driver',function ($q) {
                        $q->whereHas('subscribedPackage',function ($q) {
                            $q->whereDate('package_drivers.end_at',"<",date("Y-m-d"))->orWhere('package_drivers.is_paid',false);
                        })->orWhereNull('subscribed_package_id');
                    });
                    break;
                case 'drivers_subscribed_this_week':
                    $q->whereHas('user',function ($q) {
                        $q->whereBetween('users.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    });
                    break;
                case 'both_type':
                    $q->where(['driver_type' => 'both']);
                    break;
                case 'delivery':
                    $q->where(['driver_type' => 'delivery']);
                    break;
                case 'ride':
                    $q->where(['driver_type' => 'ride']);
                    break;
                case 'monthly_drivers':
                    $q->where(['is_on_default_package' => 0]);
                    break;
                case 'on_order_drivers':
                    $q->where(['is_on_default_package' => 1]);
                    break;
                case 'has_balance_in_wallet':
                    $q->whereHas('user',function ($q) {
                        $q->where('wallet',">",0);
                    });
                    break;
            }
        })->update(['is_available' => true, 'is_driver_available' => true]);

        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function addTempBalanceToAll(AddTempBalanceToAllRequest $request)
    {
        if ($request->user_type && !auth()->user()->hasPermissions($request->user_type,'wallet')) {
            return response()->json([ 'value' => 0,'errors' => [trans('dashboard.error.403_msg')]], 422);
        }

        $start_at = Carbon::parse($request->start_at);
        $end_at = Carbon::parse($request->end_at);

        $minutes = now()->diffInMinutes($start_at);
        // $temp = $end_at->diffInMinutes($start_at);

        UpdateWalletByTempBalance::dispatch($request->user_type, $request->validated() , $request->user_list)->delay(now()->addMinutes($minutes))->onQueue('temp_balance');

        // UpdateTempWallet::dispatch()->delay($start_at->addMinutes($temp))->onQueue('temp_balance');

        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }


    public function EnableDriverData(AcceptDriverDataRequest $request , $driver_id)
    {
        if(!auth()->user()->hasPermissions('driver','admin_accept_driver')){
            return response()->json([ 'value' => 0,'errors' => [trans('dashboard.error.403_msg')]], 422);
        }
        $driver = Driver::where('user_id',$driver_id)->firstOrFail();
        $driver_data = ['is_admin_accept' => $request->is_admin_accept,'accepted_status' => ($request->is_admin_accept ? 'accepted' : 'refused') , 'refuse_reason' => $request->refuse_reason, 'is_driver_available' => 1];

        if ($driver->is_admin_accept && setting('register_in_elm') == 'with_accept_data') {
            $elm_reply = $this->registerDriver($driver);
            $driver_data += ['elm_reply' => $elm_reply];
            if (@$elm_reply['resultCode'] == 'success') {
                $driver_data += ['is_signed_to_elm' => true];
            }
        }
        $driver->update($driver_data);
        $body = trans('dashboard.fcm.car_data_statuses_body.refused_driver');
        if ($driver->is_admin_accept) {
            switch ($driver->driver_type) {
                case 'delivery':
                    $body = trans('dashboard.fcm.car_data_statuses_body.accepted_delivery');
                break;
                case 'ride':
                    $body = trans('dashboard.fcm.car_data_statuses_body.accepted_ride');
                break;
                default:
                    $body = trans('dashboard.fcm.car_data_statuses_body.accepted_both');
                break;
            }
        }
        $fcm_data =[
            'title' => trans('dashboard.fcm.car_data_statuses_title.'.($driver->is_admin_accept ? 1 : 0)),
            'body' => $request->refuse_reason ?? $body,
            'notify_type' => 'change_car_status',
        ];
        $text = $driver->is_admin_accept ? trans('dashboard.driver.admin_accept') : trans('dashboard.driver.admin_refuse');
        $text_class = $driver->is_admin_accept ? 'text-success' : 'text-danger';
        $removed_class = $driver->is_admin_accept ? 'text-danger' : 'text-success';
        $accept_btn = $driver->is_admin_accept ? 'disabled' : false;
        $refuse_btn = !$driver->is_admin_accept ? 'disabled' : false;
        $driver->user->notify(new FCMNotification($fcm_data,['database']));
        pushFcmNotes($fcm_data,[$driver->user_id]);
        return response()->json(['value' => 1 ,'is_admin_accept' => $driver->is_admin_accept , 'text_class' => $text_class , 'removed_class' => $removed_class  , 'text' => $text  , 'accept_btn' => $accept_btn , 'refuse_btn' => $refuse_btn]);
    }

    public function changeDriverType(ChangeDriverTypeRequest $request , $driver_id)
    {
        $driver = Driver::where('user_id',$driver_id)->firstOrFail();

        $driver->update(['driver_type' => $request->driver_type]);

        $text = trans('dashboard.driver.driver_types.'.$driver->driver_type);

        return response()->json(['value' => 1 , 'text' => $text]);
    }

    public function userHealthStatus(UserHealthStatusDataRequest $request , $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['is_with_special_needs' => !$user->is_with_special_needs,'refuse_health_reason' => $request->refuse_health_reason]);

        $text = $user->is_with_special_needs ? trans('dashboard.user.with_special_needs') : trans('dashboard.user.not_with_special_needs');

        $accept_btn = $user->is_with_special_needs ? 'disabled' : false;
        $refuse_btn = !$user->is_with_special_needs ? 'disabled' : false;
        return response()->json(['value' => 1 ,'is_with_special_needs' => $user->is_with_special_needs, 'text' => $text  , 'accept_btn' => $accept_btn , 'refuse_btn' => $refuse_btn]);
    }

    public function EnableDriverPackageSubscribe(Request $request , $driver_id)
    {
        $driver = Driver::where('user_id',$driver_id)->firstOrFail();
        $driver_package = $driver->subscribedPackage;
        $style_befor = $driver_package->subscribe_status_css;
        $driver_package->update([
            'subscribed_at' => now(),
            'end_at' => now()->addMonths(($driver_package->duration + $driver_package->free_duration)),
            'price' => $driver_package->package_price,
            'is_paid' => true,
            'package_data' => $driver_package->toJson(),
            'subscribe_status' => 'subscribed',
        ]);
        $driver->update(['is_on_default_package' => false , 'free_order_counter' => 0]);
        $paid_status_css = $driver_package->paid_status_css;
        $paid_status_text = trans('dashboard.package.paid_statuses.'.$driver_package->is_paid);

        return response()->json([
            'value' => 1 ,
            'end_date' => $driver_package->end_at->format("Y-m-d") ,
            'package_status' => $driver_package->subscribe_status ,
            'package_status_css' => $driver_package->subscribe_status_css , 'style_before' => $style_befor ,
            'paid_status_css' => $paid_status_css ,
            'paid_status_text' => $paid_status_text
        ]);
    }

    public function setSubscribePackageToNotAvailableDrivers(SubscribeAllDriversPackageRequest $request)
    {
        $drivers = Driver::when($request->status,function ($q) use($request) {
            switch ($request->status) {
                case 'not_available':
                    $q->whereHas('subscribedPackage',function ($q) {
                        $q->whereDate('package_drivers.end_at',"<",date("Y-m-d"))->orWHere('package_drivers.is_paid',false);
                    });
                break;
            }
        })->when($request->user_list,function ($q) use($request) {
            $q->whereIn('drivers.user_id',$request->user_list);
        })->latest();

        foreach ($drivers->get() as $driver) {
            $driver->subscribedPackage->update(['end_at' => $request->extend_to, 'subscribe_status' => (now()->lte($request->extend_to) ? 'subscribed' : 'finished'), 'is_paid' => $request->is_paid]);
        }
        $drivers->update(['is_on_default_package' => false , 'free_order_counter' => 0]);
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function setSubscribePackageToDriver(SubscribePackageRequest $request , $package_id , $driver_id)
    {
        $driver = Driver::where('user_id',$driver_id)->firstOrFail();
        $package = PackageDriver::findOrFail($package_id);
        $package->update($request->validated()+['subscribe_status' => (now()->gt($request->end_at) ? 'finished' : 'subscribed'),'updated_by_id' => auth()->id()]);
        // if (now()->gt($request->end_at)) {
        //     $driver->update(['is_on_default_package' => true , 'free_order_counter' => 0]);
        // }else{
        //     $driver->update(['is_on_default_package' => false , 'free_order_counter' => 0]);
        // }
        $view = view('dashboard.driver.ajax.package',compact('package'))->render();
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update') , 'view' => $view ]);


    }

    public function setNewPackageToDriver(SetNewPackageRequest $request , $driver_id)
    {
        $driver = Driver::where('user_id',$driver_id)->firstOrFail();
        $old_package = $driver->subscribedPackage;
        if ($old_package && optional($old_package->end_at)->gt(now())) {
            $old_package->update(['subscribe_status' => 'finished' , 'end_at' => now()]);
        }
        $package = Package::findOrFail($request->package_id);
        $sub_package = $driver->user->driverPackages()->create([
            'package_id' => $package->id,
            'added_by_id' => auth()->id(),
            'subscribed_at' => now(),
            'end_at' => $request->is_paid ? now()->addMonths(($package->duration + $package->free_duration)) : now(),
            'price' => $package->package_price,
            'is_paid' => $request->is_paid,
            'is_paid_by_wallet' => false,
            'subscribe_status' => 'subscribed',
            'package_data' => $package->toJson(),
            'driver_id' => $driver->id,
        ]);
        $driver->update(['subscribed_package_id' => $sub_package->id,'is_on_default_package' => 0]);
        $view = view('dashboard.driver.ajax.new_package',compact('sub_package'))->render();
        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update') , 'view' => $view ,'end_at' => $sub_package->end_at->format("Y-m-d")]);
    }

    public function setNewPackageToDrivers(SetNewPackageToAllRequest $request)
    {
         ChangePackageOfDrivers::dispatch($request->validated())->onQueue('wallet');
         return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update')]);
    }

    public function getElmReply(Request $request , $driver_id)
    {
        $driver = User::where('user_type','driver')->findOrFail($driver_id);
        $elm_reply = $driver->driver->elm_reply;
        if (!$elm_reply) {
            $elm_reply = $this->driverVehicleEligibility($driver);
            $driver->driver()->update(['elm_reply' => $elm_reply]);
        }
        return response()->json(['value' => 1 ,'resultCode' => @$elm_reply['resultCode'] ?? $driver->fullname ,'resultMsg' => @$elm_reply['resultCode'] ? @$elm_reply['resultMsg'] : trans('dashboard.driver.elm.no_data_returned')]);
    }

    public function registerDriverToElm(Request $request , $driver_id)
    {
        $driver = User::where('user_type','driver')->findOrFail($driver_id);
        $elm_reply = $this->registerDriver($driver);
        if ($elm_reply) {
            $driver_data = ['elm_reply' => $elm_reply];
            if (@$elm_reply['resultCode'] == 'success') {
                $driver_data += ['is_signed_to_elm' => true];
            }
            $driver->driver()->update($driver_data);
        }
        return response()->json(['value' => 1 ,'resultCode' => @$elm_reply['resultCode'],'resultMsg' => @$elm_reply['resultMsg']]);
    }

    public function getSearch(Request $request)
    {
        $query = request()->query('query');
        $clients = User::where('user_type','client')->where(function($q)use($query){
            $q->where('fullname',"LIKE","%{$query}%")->orWhere('email',"LIKE","%{$query}%")->orWhere('phone',"LIKE","%{$query}%");
        })->get();

        $drivers = User::where('user_type','driver')->where(function($q)use($query){
            $q->where('fullname',"LIKE","%{$query}%")->orWhere('email',"LIKE","%{$query}%")->orWhere('phone',"LIKE","%{$query}%");
        })->get();

        $admins = User::where('user_type','admin')->where(function($q)use($query){
            $q->where('fullname',"LIKE","%{$query}%")->orWhere('email',"LIKE","%{$query}%")->orWhere('phone',"LIKE","%{$query}%");
        })->where('id',"<>",auth()->id())->get();

        $brands = Brand::whereTranslationLike('name',"%{$query}%",'ar')->orWhereTranslationLike('name',"%{$query}%",'en')->orWhereTranslationLike('desc',"%{$query}%",'ar')->orWhereTranslationLike('desc',"%{$query}%",'en')->get();

        $car_models = CarModel::whereTranslationLike('name',"%{$query}%",'ar')->orWhereTranslationLike('name',"%{$query}%",'en')->orWhereTranslationLike('desc',"%{$query}%",'ar')->orWhereTranslationLike('desc',"%{$query}%",'en')->get();


        $collection = $clients->merge($admins);
        $collection = $collection->merge($drivers);
        $collection = $collection->merge($admins);
        $collection = $collection->merge($brands);
        $collection = $collection->merge($car_models);
        $view = view('dashboard.layout.ajax.search',compact('collection'))->render();
        return response()->json(['value' => 1 , 'view' => $view]);
    }

    public function enablePackageActive($package_id)
    {
        $package = Package::findOrFail($package_id);
        $package->update(['is_active' => !$package->is_active]);
        return response()->json(['value' => 1 ,'is_active' => $package->is_active ,'message' => trans('dashboard.messages.success_update')]);
    }

    public function enableInviteCodeActive($invite_code_id)
    {
        $invite_code = GeneralInviteCode::findOrFail($invite_code_id);
        $invite_code->update(['is_active' => !$invite_code->is_active]);
        return response()->json(['value' => 1 ,'is_active' => $invite_code->is_active ,'message' => trans('dashboard.messages.success_update')]);
    }

    public function enableAppAdActive($app_ad_id)
    {
        $app_ad = AppAd::findOrFail($app_ad_id);
        $app_ad->update(['is_active' => !$app_ad->is_active]);
        return response()->json(['value' => 1 ,'is_active' => $app_ad->is_active ,'message' => trans('dashboard.messages.success_update')]);
    }

    public function deleteAppImage(Request $request , $id)
    {
        $image = AppImage::findOrFail($id);
        $image->delete();
        if (file_exists(storage_path('app/public/images/'.$request->class_name.'/'.$image->image))){
            \File::delete(storage_path('app/public/images/'.$request->class_name.'/'.$image->image));
        }
        return response()->json(['value' => 1]);
    }

    public function generateCode($length = 8 , $type = 'numbers' , $model = 'Coupon' ,$col = 'code', $letter_type = 'all')
    {
        $model_name = '\\App\\Models\\' . $model;
        return generate_unique_code($length, $model_name ,$col ,$type ,$letter_type);
    }

    public function updateOrderStatus(OrderStatusRequest $request , $order_id)
    {
        $order = Order::findOrFail($order_id);
        if ($request->order_status) {
            if (in_array($request->order_status,['admin_finish','client_finish','driver_finish']) && ! $order->finished_at && $order->driver_id) {
                $driver = $order->driver;
                $driver_wallet = (float)$driver->wallet;
                $order->update(['finished_at' => now()]);
                if ($order->driver_id) {
                    $order->driver->driver()->updateOrCreate(['user_id' => $order->driver_id],['is_available' => 1]);
                    if ($order->driver->driver->is_on_default_package) {
                        if ($order->driver->driver->free_order_counter < setting('number_of_free_orders_on_default_package')) {
                            $order->driver->driver()->update(['free_order_counter' => \DB::raw('free_order_counter + 1')]);
                        }
                        $order->driver()->update(['wallet' => ($driver_wallet -((float)setting('price_of_default_package_order') ?? 1 ))]);
                    }
                }
                if ($order->order_status == 'start_trip') {
                    $wallet_amount = 0;

                    $client = $order->client;
                    if ($order->is_paid_by_wallet) {
                        $free_wallet_balance = $client->free_wallet_balance - $order->total_price <= 0 ? 0 : ($client->free_wallet_balance - $order->total_price);
                        $client->update(['wallet' => ($client->wallet - $order->total_price),'free_wallet_balance' => $free_wallet_balance]);
                        $wallet_amount = $order->total_price;
                    }
                    $start_at = date("Y-m-d H:i:s",strtotime(optional($order->order_status_times)->start_trip));
                    $order->update(['actual_time' => now()->diffInMinutes($start_at) ?? $order->expected_time,'wallet_amount' => $wallet_amount]);

                    if ($order->is_paid_by_wallet) {
                        $driver->update(['wallet' => ($driver_wallet + (float)$wallet_amount)]);
                    }
                }
            }
            if (in_array($request->order_status,['admin_cancel','client_cancel','driver_cancel','shipped']) && $order->driver_id && (!$order->finished_at || $order->order_status == 'start_trip')) {
                $order->driver->driver()->updateOrCreate(['user_id' => $order->driver_id],['is_available' => 1]);
            }
            $order->update(['order_status' => $request->order_status,'order_status_times' => [$request->order_status => date("Y-m-d h:i A")]]);
            $admins = User::whereIn('user_type',['admin','superadmin'])->get();
            \Notification::send($admins,new ChangeOrderStatusNotification($order));

            return response()->json(['value' => 1 ,'message' => trans('dashboard.messages.success_update')]);
        }else{
            return response()->json(['value' => 0 ,'message' => trans('dashboard.messages.no_data_found')]);
        }
    }

    public function updateWalletTransferStatus(WalletTransactionRequest $request , $wallet_id)
    {
        $wallet_transfer = WalletTransaction::pending()->where('transaction_type','withdrawal')->findOrFail($wallet_id);
        if ($request->transfer_status == 'refused') {
            $wallet_transfer->user()->update(['wallet' => ($wallet_transfer->user->wallet + $wallet_transfer->amount) , 'free_wallet_balance' => ($wallet_transfer->user->free_wallet_balance + $wallet_transfer->free_wallet_balance)]);
        }
        $wallet_transfer->update(['transfer_status' => $request->transfer_status , 'transfer_at' => ($request->transfer_status == 'transfered' ? now() : null)]);

        // \Mail::to($wallet_transfer->email)->send(new ReplyWalletTransaction($reply));
        $pushFcmNotes = [
            'title' => trans('dashboard.fcm.transfer_request'),
            'body' => trans('dashboard.fcm.transfer_statuses.'.$request->transfer_status),
            'notify_type' => 'management',
        ];
        // if ($request->send_type == 'fcm') {
            pushFcmNotes($pushFcmNotes, [$wallet_transfer->user_id]);
        // }else{
            // send_sms($wallet_transfer->user->phone,$pushFcmNotes['body']);
        // }
        \Notification::send($wallet_transfer->user,new GeneralNotification($pushFcmNotes+['wallet_id' => $wallet_transfer->id]));

        return response()->json(['value' => 1 ,'message' => trans('dashboard.messages.success_send')]);

    }

    public function getNewOrders(Request $request)
    {
        $orders = Order::withTrashed()->latest()->whereIn('order_status',['pending','client_recieve_offers'])->paginate(10);
        $css_class = 'text-warning';
        $view = view('dashboard.home.ajax.order',compact('orders','css_class'))->render();
        return response()->json(['value' => 1 ,'view' => $view]);
    }

    public function getCurrentOrders(Request $request)
    {
        $orders = Order::withTrashed()->latest()->whereIn('order_status',['shipped'])->paginate(10);
        $css_class = 'text-primary';
        $view = view('dashboard.home.ajax.order',compact('orders','css_class'))->render();
        return response()->json(['value' => 1 ,'view' => $view]);
    }

    public function getFinishedOrders(Request $request)
    {
        $orders = Order::withTrashed()->latest()->whereIn('order_status',['client_finish','driver_finish','admin_finish'])->paginate(10);
        $css_class = 'text-success';
        $view = view('dashboard.home.ajax.order',compact('orders','css_class'))->render();
        return response()->json(['value' => 1 ,'view' => $view]);
    }

    public function UpdatePackageEndDate(UpdateSubscribtionRequest $request , $package_id , $driver_id)
    {
        $package = PackageDriver::findOrFail($package_id);
        $style_befor = $package->subscribe_status_css;
        $driver = User::where('user_type','driver')->findOrFail($driver_id);
        $end_date = \Carbon\Carbon::parse($request->end_at);
        $package->update(['end_at' => $request->end_at , 'subscribe_status' => (now()->gt($end_date) ? 'finished' : 'subscribed')]);

        return response()->json(['value' => 1 , 'message' => trans('dashboard.messages.success_update') , 'end_date' => $package->end_at->format("Y-m-d") , 'package_status' => $package->subscribe_status , 'package_status_css' => $package->subscribe_status_css , 'style_before' => $style_befor]);
    }
}

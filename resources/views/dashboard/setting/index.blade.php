@extends('dashboard.layout.layout')
@section('current',trans('dashboard.setting.setting'))
@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.setting.setting') !!}</h5>
    </div>
    <div class="card-body">
        {!! Form::open(['route'=>'dashboard.setting.store','method'=>'POST','files'=>true,'class'=>'form-horizontal']) !!}
        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#main">{!! trans('dashboard.setting.main_setting') !!}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wallet">{!! trans('dashboard.setting.wallet_setting') !!}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#mail">{!! trans('dashboard.setting.mail_setting') !!}</a></li>

            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms">{!! trans('dashboard.setting.sms_setting') !!}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about">{!! trans('dashboard.setting.setting_about') !!}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#social">{!! trans('dashboard.social.social') !!}</a></li>

        </ul>

        <div class="tab-content">
            <div id="main" class="tab-pane fade show active">
                <div class="form-group mt-4">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.project_name') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('project_name', setting('project_name') ? setting('project_name'):old('project_name'), ['class'=>'form-control','id'=>'project_name','placeholder'=>trans('dashboard.setting.project_name')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.general.email') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('email', setting('email') ? setting('email'):old('email'), ['class'=>'form-control','id'=>'email','placeholder'=>trans('dashboard.general.email')]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.general.phones') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('phones', setting('phones') ? setting('phones'):old('phones'), ['class'=>'form-control tagsinput-custom-tag-class','placeholder'=>trans('dashboard.setting.phones')]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.map_api') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('map_api', setting('map_api') ? setting('map_api'):old('map_api'), ['class'=>'form-control','placeholder'=>trans('dashboard.setting.map_api')]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.search_distance') }} </label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('search_distance', setting('search_distance') ? setting('search_distance'):old('search_distance'), ['class' => "touchspin", 'init-val' => null ]) !!}
                            </div>
                        </div>

                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.number_drivers_to_notify') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('number_drivers_to_notify', setting('number_drivers_to_notify') ? setting('number_drivers_to_notify'):old('number_drivers_to_notify'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.number_drivers_to_notify_desc') !!}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.driver_notify_count_to_refuse') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('driver_notify_count_to_refuse', setting('driver_notify_count_to_refuse') ? setting('driver_notify_count_to_refuse'):old('driver_notify_count_to_refuse'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.driver_notify_count_to_refuse_desc') !!}</p>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.waiting_time_for_driver_response_label') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('waiting_time_for_driver_response', setting('waiting_time_for_driver_response') ? setting('waiting_time_for_driver_response'):old('waiting_time_for_driver_response'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.waiting_time_for_driver_response') !!}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.waiting_time_to_finish_order') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('waiting_time_to_finish_order', setting('waiting_time_to_finish_order') ? setting('waiting_time_to_finish_order'):old('waiting_time_to_finish_order'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.waiting_time_to_finish_order_desc') !!}</p>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.waiting_time_to_cancel_order') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('waiting_time_to_cancel_order', setting('waiting_time_to_cancel_order') ? setting('waiting_time_to_cancel_order'):old('waiting_time_to_cancel_order'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.waiting_time_to_cancel_order_desc') !!}</p>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_offer_price') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_offer_price', setting('min_offer_price') ? setting('min_offer_price'):old('min_offer_price'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_limit_withdrawal') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_limit_withdrawal', setting('min_limit_withdrawal') ? setting('min_limit_withdrawal'):old('min_limit_withdrawal'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.number_of_cars_on_map') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('number_of_cars_on_map', setting('number_of_cars_on_map') ? setting('number_of_cars_on_map'):old('number_of_cars_on_map'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.tax') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('tax', setting('tax') ? setting('tax'):old('tax'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="vs-checkbox-con vs-checkbox-info">
                                {!! Form::checkbox('enable_update_subscribe_from_wallet', "1" , setting('enable_update_subscribe_from_wallet') ? setting('enable_update_subscribe_from_wallet'):old('enable_update_subscribe_from_wallet')) !!}
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                </span>
                                <span class="font-medium-1 mr-2">{!! trans('dashboard.setting.enable_update_subscribe_from_wallet') !!}</span>
                            </div>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.enable_update_subscribe_from_wallet_msg') }}</label>
                        <div class="col-md-7">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::textarea('enable_update_subscribe_from_wallet_msg', setting('enable_update_subscribe_from_wallet_msg') ? setting('enable_update_subscribe_from_wallet_msg'):old('enable_update_subscribe_from_wallet_msg'), ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->email == 'developer@info.com')
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ trans('dashboard.setting.is_payment_showing') }}</label>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="vs-radio-con vs-radio-success col-md-7">
                                {!! Form::radio('is_payment_showing', "enable" , setting('is_payment_showing') == 'enable' || ! setting('is_payment_showing') ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.payment_service_enable') }}</span>

                            </div>
                            <div class="vs-radio-con vs-radio-success">
                                {!! Form::radio('is_payment_showing', "disable" , setting('is_payment_showing') == 'disable' ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.payment_service_disable') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ trans('dashboard.setting.test_version') }}</label>
                    <div class="col-md-10">
                        {!! Form::text('test_version', setting('test_version') ? setting('test_version'):old('test_version'), ['class'=>'form-control','id'=>'test_version','placeholder'=>trans('dashboard.setting.test_version')]) !!}
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="vs-checkbox-con vs-checkbox-info">
                                {!! Form::checkbox('enable_make_order_and_take_order', "1" , setting('enable_make_order_and_take_order') ? setting('enable_make_order_and_take_order'):old('enable_make_order_and_take_order')) !!}
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                </span>
                                <span class="font-medium-1 mr-2">{!! trans('dashboard.setting.enable_order_with_order_offer') !!}</span>
                            </div>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.second_trip_max_price') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('second_trip_max_price', setting('second_trip_max_price') ? setting('second_trip_max_price'):old('second_trip_max_price'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-8">{{ trans('dashboard.setting.number_of_repeat_order_offer') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('number_of_repeat_order_offer', setting('number_of_repeat_order_offer') ? setting('number_of_repeat_order_offer'):old('number_of_repeat_order_offer'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ trans('dashboard.setting.register_in_elm') }}</label>
                    <div class="col-md-10">
                        <div class="row">
                            <ul class="list-unstyled mb-0">
                                <li class="d-block mr-2 mb-2">
                                    <div class="vs-radio-con vs-radio-success">
                                        {!! Form::radio('register_in_elm', "after_register" , setting('register_in_elm') == 'after_register' ? 'checked' : null) !!}
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="">{{ trans('dashboard.setting.register_in_elm_after_register') }}</span>
                                    </div>
                                </li>
                                <li class="d-block mr-2 mb-2">
                                    <div class="vs-radio-con vs-radio-success">
                                        {!! Form::radio('register_in_elm', "with_accept_data" , setting('register_in_elm') == 'with_accept_data' ? 'checked' : null) !!}
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="">{{ trans('dashboard.setting.register_in_elm_with_accept_data') }}</span>
                                    </div>
                                </li>
                                <li class="d-block mr-2 mb-2">
                                    <div class="vs-radio-con vs-radio-success">
                                        {!! Form::radio('register_in_elm', "register_manually" , !setting('register_in_elm') || setting('register_in_elm') == 'register_manually' ? 'checked' : null) !!}
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="">{{ trans('dashboard.setting.register_in_elm_register_manually') }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.general.logo') !!}</label>
                        <div class="col-lg-9">
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input" id="inputGroupFile02" onchange="readUrl(this)">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            @if (setting('logo'))
                            <img src="{{ setting('logo') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;;">
                            @else
                            <img src="{{ asset('dashboardAsset/global/images/default.jpg') }}" class="img-thumbnail image-preview" style="width: 100%; height: 100px;">

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="wallet" class="tab-pane fade">
                <div class="form-group mt-4">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_wallet_amount_found_when_order') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_wallet_amount_found_when_order', setting('min_wallet_amount_found_when_order') ? setting('min_wallet_amount_found_when_order'):old('min_wallet_amount_found_when_order'), ['class' => "touchspin"])
                                !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.min_wallet_amount_found_when_order_desc') !!}</p>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_amount_in_transfer_transaction') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_amount_in_transfer_transaction', setting('min_amount_in_transfer_transaction') ? setting('min_amount_in_transfer_transaction'):old('min_amount_in_transfer_transaction'), ['class' => "touchspin"])
                                !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.min_amount_in_transfer_transaction_desc') !!}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.num_points_when_client_register_by_refer_code') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('num_points_when_client_register_by_refer_code', setting('num_points_when_client_register_by_refer_code') ?
                                setting('num_points_when_client_register_by_refer_code'):old('num_points_when_client_register_by_refer_code'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.num_points_when_driver_register_by_refer_code') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('num_points_when_driver_register_by_refer_code', setting('num_points_when_driver_register_by_refer_code') ?
                                setting('num_points_when_driver_register_by_refer_code'):old('num_points_when_driver_register_by_refer_code'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_amount_charge_client') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_amount_charge_client', setting('min_amount_charge_client') ? setting('min_amount_charge_client'):old('min_amount_charge_client'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_amount_charge_driver') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_amount_charge_driver', setting('min_amount_charge_driver') ? setting('min_amount_charge_driver'):old('min_amount_charge_driver'), ['class' => "touchspin"]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.amount_of_on_account_for_user') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('amount_of_on_account_for_user', setting('amount_of_on_account_for_user') ? setting('amount_of_on_account_for_user'):old('amount_of_on_account_for_user'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.amount_of_on_account_for_user_desc') !!}</p>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_amount_in_wallet_to_use_salfni') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_amount_in_wallet_to_use_salfni', setting('min_amount_in_wallet_to_use_salfni') ? setting('min_amount_in_wallet_to_use_salfni'):old('min_amount_in_wallet_to_use_salfni'), ['class' => "touchspin"])
                                !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.min_amount_in_wallet_to_use_salfni_desc') !!}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.number_of_days_to_update_special_needs_client_wallet') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('number_of_days_to_update_special_needs_client_wallet', setting('number_of_days_to_update_special_needs_client_wallet') ?
                                setting('number_of_days_to_update_special_needs_client_wallet'):old('number_of_days_to_update_special_needs_client_wallet'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.number_of_days_to_update_special_needs_client_wallet_desc') !!}</p>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.amount_of_special_needs_help') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('amount_of_special_needs_help', setting('amount_of_special_needs_help') ? setting('amount_of_special_needs_help'):old('amount_of_special_needs_help'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.amount_of_special_needs_help_desc') !!}</p>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.min_wallet_to_recieve_order') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('min_wallet_to_recieve_order', setting('min_wallet_to_recieve_order') ? setting('min_wallet_to_recieve_order'):old('min_wallet_to_recieve_order'), ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.min_wallet_to_recieve_order_desc') !!}</p>
                        </div>
                        <label class="font-medium-1 col-md-2">{{ trans('dashboard.setting.number_of_free_orders_on_default_package') }}</label>
                        <div class="col-md-4">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('number_of_free_orders_on_default_package', setting('number_of_free_orders_on_default_package') ? setting('number_of_free_orders_on_default_package'):old('number_of_free_orders_on_default_package'),
                                ['class' => "touchspin"]) !!}
                            </div>
                            <p class="text-success">{!! trans('dashboard.setting.number_of_free_orders_on_default_package_desc') !!}</p>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-4">{{ trans('dashboard.setting.price_of_default_package_order') }}</label>
                        <div class="col-md-8">
                            <div class="input-group input-group-lg" style="width: 100%;">
                                {!! Form::number('price_of_default_package_order', setting('price_of_default_package_order') ? setting('price_of_default_package_order'):old('price_of_default_package_order'), ['class' => "touchspin"]) !!}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.ar.home_msg') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('home_msg_ar', setting('home_msg_ar') ? setting('home_msg_ar'):old('home_msg_ar'), ['class'=>'form-control','placeholder'=>trans('dashboard.ar.home_msg')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.en.home_msg') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('home_msg_en', setting('home_msg_en') ? setting('home_msg_en'):old('home_msg_en'), ['class'=>'form-control','placeholder'=>trans('dashboard.en.home_msg')]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="sms" class="tab-pane fade">
                <div class="form-group row mt-4">
                    <label class="col-form-label col-lg-2">{{ trans('dashboard.setting.use_sms_service') }}</label>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="vs-radio-con vs-radio-success col-md-7">
                                {!! Form::radio('use_sms_service', "enable" , setting('use_sms_service') == 'enable' || ! setting('use_sms_service') ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.sms_service_enable') }}</span>

                            </div>
                            <div class="vs-radio-con vs-radio-success">
                                {!! Form::radio('use_sms_service', "disable" , setting('use_sms_service') == 'disable' ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.sms_service_disable') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{ trans('dashboard.setting.sms_provider') }}</label>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="vs-radio-con vs-radio-success col-md-4">
                                {!! Form::radio('sms_provider', "hisms" , setting('sms_provider') == 'hisms' || ! setting('sms_provider') ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.sms_service_hisms') }}</span>

                            </div>
                            <div class="vs-radio-con vs-radio-success col-md-4">
                                {!! Form::radio('sms_provider', "net_powers" , setting('sms_provider') == 'net_powers' ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.sms_service_net_powers') }}</span>
                            </div>
                            <div class="vs-radio-con vs-radio-success">
                                {!! Form::radio('sms_provider', "sms_gateway" , setting('sms_provider') == 'sms_gateway' ? 'checked' : null) !!}
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">{{ trans('dashboard.setting.sms_service_sms_gateway') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.sms_sender_name') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('sms_sender_name', setting('sms_sender_name') ? setting('sms_sender_name'):old('sms_sender_name'), ['class'=>'form-control','id'=>'sms_sender_name','placeholder'=>trans('dashboard.setting.sms_sender_name')])
                            !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.sms_username') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('sms_username', setting('sms_username') ? setting('sms_username'):old('sms_username'), ['class'=>'form-control','id'=>'sms_username','placeholder'=>trans('dashboard.setting.sms_username')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.sms_password') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('sms_password', setting('sms_password') ? setting('sms_password'):old('sms_password'), ['class'=>'form-control','id'=>'sms_password','placeholder'=>trans('dashboard.setting.sms_password')]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="mail" class="tab-pane fade">
                <div class="form-group mt-4">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.driver_mail') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('driver', setting('driver') ? setting('driver'):old('driver'), ['class'=>'form-control','id'=>'driver','placeholder'=>trans('dashboard.setting.driver_mail')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.host') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('host', setting('host') ? setting('host'):old('host'), ['class'=>'form-control','id'=>'host','placeholder'=>trans('dashboard.setting.host')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.from_address') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('from_address', setting('from_address') ? setting('from_address'):old('from_address'), ['class'=>'form-control','id'=>'from_address','placeholder'=>trans('dashboard.setting.from_address')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.from_name',['name'=>setting('project_name')]) !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('from_name', setting('from_name') ? setting('from_name'):old('from_name'), ['class'=>'form-control','id'=>'from_name','placeholder'=>trans('dashboard.setting.from_name',['name'=>setting('project_name')])])
                            !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.username') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('username', setting('username') ? setting('username'):old('username'), ['class'=>'form-control','id'=>'username','placeholder'=>trans('dashboard.setting.username')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.general.password') !!}</label>
                        <div class="col-md-4">
                            {!! Form::password('password', ['class'=>"form-control", 'id'=>"password", 'placeholder'=>trans('dashboard.general.password')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.port') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('port', setting('port') ? setting('port'):old('port'), ['class'=>'form-control','id'=>'port','placeholder'=>trans('dashboard.setting.port')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.setting.encry') !!}</label>
                        <div class="col-md-4">
                            {!! Form::select('encry', ['tls'=>'tls','ssl'=>'ssl'],setting('encry') ? setting('encry') : old('encry'), ['class'=>'form-control select-search', 'id'=>"encry", 'placeholder'=>trans('dashboard.setting.encry')]) !!}
                        </div>
                    </div>
                </div>

            </div>
            <div id="about" class="tab-pane fade">
                <div class="form-group mt-4">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.ar.policy') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('policy_ar', setting('policy_ar') ? setting('policy_ar'):old('policy_ar'), ['class'=>'form-control','placeholder'=>trans('dashboard.ar.policy')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.en.policy') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('policy_en', setting('policy_en') ? setting('policy_en'):old('policy_en'), ['class'=>'form-control','id' => 'full-container','placeholder'=>trans('dashboard.en.policy')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.ar.terms') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('terms_ar', setting('terms_ar') ? setting('terms_ar'):old('terms_ar'), ['class'=>'form-control editor','placeholder'=>trans('dashboard.ar.terms')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.en.terms') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('terms_en', setting('terms_en') ? setting('terms_en'):old('terms_en'), ['class'=>'form-control editor','id' => 'full-container','placeholder'=>trans('dashboard.en.terms')]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.ar.desc') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('desc_ar', setting('desc_ar') ? setting('desc_ar'):old('desc_ar'), ['class'=>'form-control','placeholder'=>trans('dashboard.ar.desc')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.en.desc') !!}</label>
                        <div class="col-md-10">
                            {!! Form::textarea('desc_en', setting('desc_en') ? setting('desc_en'):old('desc_en'), ['class'=>'form-control','placeholder'=>trans('dashboard.en.desc')]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="social" class="tab-pane fade">
                {{-- <div class="form-group mt-4">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.address_lable') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('address', setting('address') ? setting('address'):old('address'), ['class'=>'form-control','id'=>'address','placeholder'=>trans('dashboard.social.address')]) !!}
                        </div>
                    </div>
                </div> --}}
                <div class="form-group mt-4">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.whatsapp') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('whatsapp', setting('whatsapp') ? setting('whatsapp'):old('whatsapp'), ['class'=>'form-control','id'=>'whatsapp','placeholder'=>trans('dashboard.social.whatsapp')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.sms_message') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('sms_message', setting('sms_message') ? setting('sms_message'):old('sms_message'), ['class'=>'form-control','id'=>'sms_message','placeholder'=>trans('dashboard.social.sms_message')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.facebook') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('facebook', setting('facebook') ? setting('facebook'):old('facebook'), ['class'=>'form-control','id'=>'facebook','placeholder'=>trans('dashboard.social.facebook')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.twitter') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('twitter', setting('twitter') ? setting('twitter'):old('twitter'), ['class'=>'form-control','id'=>'twitter','placeholder'=>trans('dashboard.social.twitter')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.youtube') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('youtube', setting('youtube') ? setting('youtube'):old('youtube'), ['class'=>'form-control','id'=>'youtube','placeholder'=>trans('dashboard.social.youtube')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.instagram') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('instagram', setting('instagram') ? setting('instagram'):old('instagram'), ['class'=>'form-control','id'=>'instagram','placeholder'=>trans('dashboard.social.instagram')]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.tiktok') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('tiktok', setting('tiktok') ? setting('tiktok'):old('tiktok'), ['class'=>'form-control','id'=>'tiktok','placeholder'=>trans('dashboard.social.tiktok')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.snapchat') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('snapchat', setting('snapchat') ? setting('snapchat'):old('snapchat'), ['class'=>'form-control','id'=>'snapchat','placeholder'=>trans('dashboard.social.snapchat')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.youtube') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('youtube', setting('youtube') ? setting('youtube'):old('youtube'), ['class'=>'form-control','id'=>'youtube','placeholder'=>trans('dashboard.social.youtube')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.instagram') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('instagram', setting('instagram') ? setting('instagram'):old('instagram'), ['class'=>'form-control','id'=>'instagram','placeholder'=>trans('dashboard.social.instagram')]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.g_play_app') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('g_play_app', setting('g_play_app') ? setting('g_play_app'):old('g_play_app'), ['class'=>'form-control','id'=>'g_play_app','placeholder'=>trans('dashboard.social.g_play_app')]) !!}
                        </div>
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.app_store_app') !!}</label>
                        <div class="col-md-4">
                            {!! Form::text('app_store_app', setting('app_store_app') ? setting('app_store_app'):old('app_store_app'), ['class'=>'form-control','id'=>'app_store_app','placeholder'=>trans('dashboard.social.app_store_app')]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="font-medium-1 col-md-2">{!! trans('dashboard.social.huawei_store_app') !!}</label>
                        <div class="col-md-10">
                            {!! Form::text('huawei_store_app', setting('huawei_store_app') ? setting('huawei_store_app'):old('huawei_store_app'), ['class'=>'form-control','id'=>'huawei_store_app','placeholder'=>trans('dashboard.social.huawei_store_app')]) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">{{ trans('dashboard.general.save') }} <i class="{{ app()->getLocale() == 'ar' ? 'icon-arrow-left13' : 'icon-arrow-right13'}} position-right"></i></button>
        </div>

        {!! form::close() !!}
    </div>

</div>
@endsection
@include('dashboard.setting.scripts')

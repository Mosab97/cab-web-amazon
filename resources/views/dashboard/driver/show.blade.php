@extends('dashboard.layout.layout')

@section('content')
<div id="user-profile">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2 border-info rounded">
                <div class="relative">
                    <div class="cover-container">
                        <img class="img-fluid bg-cover rounded-top w-100" src="{{ asset('dashboardAssets') }}/images/banner/parallax-4.jpg" alt="{{ $driver->fullname }}" style="height:300px; width:100%;">
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <div class="avatar">
                            <a href="{{ $driver->avatar }}" data-fancybox="gallery">
                                <img src="{{ $driver->avatar }}" class="rounded-circle img-border box-shadow-1" alt="{{ $driver->fullname }}">
                                <span class="avatar-status-busy avatar-status-lg" id="online_{{ $driver->id }}"></span>
                            </a>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('dashboard.driver.edit',$driver->id) }}" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                                <i class="feather icon-edit-2"></i>
                            </a>
                            <a href="javascript::void(0)" class="btn btn-icon btn-icon rounded-circle btn-danger" onclick="notify('{{ $driver->id }}','{{ route('dashboard.notification.store') }}','driver')">
                                <i class="feather icon-bell"></i>
                            </a>
                        </div>
                    </div>
                </div>



                <div class="d-flex justify-content-center align-items-center profile-header-nav rounded-bottom">
                    <nav class="navbar navbar-expand-sm w-100 pr-5 mr-5 ml-1">
                        <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="feather icon-align-justify"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav nav-tabs justify-content-right w-75 ml-sm-auto" role="tablist">
                                <li class="nav-item px-sm-0">
                                    <a href="#profile" data-toggle="tab" id="profile-tab" aria-controls="profile" class="nav-link font-small-3 active" aria-selected="true">
                                        <i class="feather icon-user font-small-3"></i>
                                        {!! trans('dashboard.user.profile') !!}
                                    </a>

                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#orders" data-toggle="tab" id="orders-tab" aria-controls="orders" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-shopping-cart font-small-3"></i>
                                        {!! trans('dashboard.order.orders') !!}

                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#offers" data-toggle="tab" id="offers-tab" aria-controls="offers" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-gift font-small-3"></i>
                                        {!! trans('dashboard.offer.offers') !!}

                                    </a>
                                </li>

                                <li class="nav-item px-sm-0">
                                    <a href="#packages" data-toggle="tab" id="packages-tab" aria-controls="packages" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-package font-small-3"></i>
                                        {!! trans('dashboard.package.packages') !!}

                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#health" data-toggle="tab" id="health-tab" aria-controls="health" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-heart font-small-3"></i>
                                        {!! trans('dashboard.user.health_status') !!}

                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#financial" data-toggle="tab" id="financial-tab" aria-controls="financial" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-dollar-sign font-small-3"></i>
                                        {!! trans('dashboard.user.financial_record') !!}
                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#elm" data-toggle="tab" id="elm-tab" aria-controls="elm" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-truck font-small-3"></i>
                                        {!! trans('dashboard.driver.elm.elm_platform') !!}

                                    </a>
                                </li>

                                <li class="nav-item px-sm-0">
                                    <a href="#wallet_transfers" data-toggle="tab" id="elm-tab" aria-controls="wallet_transfers" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-repeat font-small-3"></i>
                                        {!! trans('dashboard.wallet_transfer.wallet_transfers') !!}

                                    </a>
                                </li>

                                <li class="nav-item px-sm-0">
                                    <a href="#points" data-toggle="tab" id="point-tab" aria-controls="points" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-hash font-small-3"></i>
                                        {!! trans('dashboard.point.points') !!}
                                    </a>
                                </li>

                                <li class="nav-item px-sm-0">
                                    <a href="#wallet_transactions" data-toggle="tab" id="wallet_transaction-tab" aria-controls="wallet_transactions" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-credit-card font-small-3"></i>
                                        {!! trans('dashboard.wallet_transaction.wallet_transactions') !!}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="profile-info" class="row">
        <!-- Basic datatable -->
        <div class="col-md-9">
            <div class="card border-info">
                <div class="card-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="profile" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.user.fullname') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->fullname }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.email') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->email }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-mail"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.phone') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->phone }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-phone"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.user.identity_number') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->identity_number }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-credit-card"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.driver.date_of_birth') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ optional($driver->date_of_birth)->format("Y-m-d") }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-calendar"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.driver.date_of_birth_hijri') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ optional($driver->date_of_birth_hijri)->format("Y-m-d") }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-moon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.added_date') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->created_at->format("Y-m-d") }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-calendar"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.added_time') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->created_at->format("h:i A") }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-clock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.country.country') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->country_name }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-flag"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.city.city') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->city_name }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-flag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.user.active_state') !!}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{!! $driver->is_admin_active_user ? trans('dashboard.user.active') : trans('dashboard.user.not_active') !!}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-log-in"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.user.ban_state') !!}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{!! $driver->is_ban ? trans('dashboard.user.ban') : trans('dashboard.user.not_ban') !!}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-slash"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.point.point_count') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->points }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-hash"></i>
                                            </div>
                                        </div>

                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.driver.driver_type') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ trans('dashboard.driver.driver_types.'.optional($driver->driver)->driver_type) }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-car"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.driver.admin_accept_status') !!}</label>
                                        <div class="col-md-10 position-relative has-icon-left">
                                            <input type="text" value="{!! @$driver->driver->is_admin_accept ? trans('dashboard.driver.admin_accept') : trans('dashboard.driver.admin_refuse') !!}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-log-in"></i>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.user.ban_reason') !!}</label>
                                        <div class="col-md-10">
                                            {!! Form::textarea("", $driver->is_ban ? $driver->ban_reason : null, ['class' => 'form-control','readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="orders" aria-labelledby="orders-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $orders->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.order.order_number') !!}</th>
                                                    <th>{!! trans('dashboard.client.client') !!}</th>
                                                    <th>{!! trans('dashboard.order.pay_type') !!}</th>
                                                    <th>{!! trans('dashboard.order.order_type') !!}</th>
                                                    <th>{!! trans('dashboard.order.order_status') !!}</th>
                                                    <th>{!! trans('dashboard.order.total_price') !!}</th>
                                                    <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                    <th><i class="feather icon-zap"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr class="{{ $order->id }} text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ optional($order->client)->fullname }}</td>
                                                    <td>{{ trans('dashboard.order.pay_types.'.$order->pay_type) }}</td>
                                                    <td>{{ trans('dashboard.order.order_types.'.$order->order_type) }}</td>
                                                    <td>
                                                        {!! trans('dashboard.order.statuses.'.$order->order_status) !!}
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-success badge-md mr-1 mb-1">{{ $order->total_price }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-violet badge-md mr-1 mb-1">{{ $order->created_at->format("Y-m-d") }}</div>
                                                    </td>
                                                    <td class="product-action text-center font-medium-3">
                                                        <a href="{!! route('dashboard.order.show',$order->id) !!}" class="text-primary mr-2">
                                                            <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $orders->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="offers" aria-labelledby="offers-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $offers->links() !!}
                                    </div>
                                    <div class="row">
                                        @forelse ($offers as $offer)
                                        @if ($offer->order->client)

                                        <div class="col-xl-4 col-md-6 col-sm-12 profile-card-2">
                                            <div class="card border-info" style="height: 329.188px;">

                                                <div class="card-header mx-auto pb-0">
                                                    <div class="row m-0">
                                                        <div class="col-sm-12 text-center">
                                                            <h4>{{ optional(@$offer->order->client)->fullname }}</h4>
                                                        </div>
                                                        <div class="col-sm-12 text-center">
                                                            <p class=""><a href="tel:{{ optional(@$offer->order->client)->phone }}">{{ optional(@$offer->order->client)->phone }}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body text-center mx-auto">
                                                        <div class="avatar avatar-xl">
                                                            <a href="{!! @$offer->order->client_id ? route('dashboard.client.show',$offer->order->client_id) : '#' !!}">
                                                                <img class="img-fluid" src="{{ optional(@$offer->order->client)->avatar }}" alt="{{ optional(@$offer->order->client)->fullname }}">
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <div class="uploads">
                                                                <p class="font-weight-bold font-medium-2 mb-0">{{ $offer->offer_price }}</p>
                                                                <span class="">{!! trans('dashboard.offer.offer_price') !!}</span>
                                                            </div>
                                                            <div class="followers">
                                                                <p class="font-weight-bold font-medium-2 mb-0">{{ optional(@$offer->order->client)->clientOrders->count() }}</p>
                                                                <span class="">{{ trans('dashboard.order.order_count') }}</span>
                                                            </div>
                                                            <div class="following">
                                                                <p class="font-weight-bold font-medium-2 mb-0">(<i class="feather icon-star text-warning mr-50"></i>
                                                                    {{ $offer->order->rates()->where(['client_id' => $offer->order->client_id , 'driver_id' => $offer->driver_id])->avg('rates.rate') }})</p>
                                                                <span class="">{!! trans('dashboard.client.client_rate_on_order') !!}</span>
                                                            </div>
                                                        </div>
                                                        <div class="badge badge-lg block {{ $offer->price_offer_status_css }} mt-3">
                                                            <span>
                                                                {!! trans('dashboard.offer.offer_statuses.'.$offer->price_offer_status) !!}
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                        @empty

                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-styled-left alert-dismissible">
                                                {{ trans('dashboard.order.no_offer_used') }}
                                            </div>

                                        </div>
                                        @endforelse
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        {!! $offers->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="packages" aria-labelledby="packages-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $packages->links() !!}
                                    </div>
                                    <div class="row driver_packages">
                                        @forelse ($packages as $package)
                                        <div class="col-md-6 col-sm-12 profile-card-2 ">
                                            <div class="card border-info" style="height: 272.188px;" id="package_subscribe_{{ $package->id }}">

                                                <div class="card-header mx-auto pb-0">
                                                    <div class="row m-0">
                                                        <div class="col-sm-12 text-center">
                                                            <h4>{{ $package->name }}</h4>
                                                        </div>
                                                        <div class="col-sm-12 text-center">
                                                            <p class="">{{ @$package->package_data_array['package_price'] }} {{ trans('dashboard.currency.rs') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body text-center mx-auto">

                                                        <div class="d-flex justify-content-between mt-2">
                                                            <div class="uploads">
                                                                <p class="font-weight-bold font-medium-1 mb-0">{{ optional($package->subscribed_at)->format("Y-m-d") }}</p>
                                                                <span class="">{!! trans('dashboard.package.subscribed_at') !!}</span>
                                                            </div>
                                                            <div class="followers">
                                                                <p class="font-weight-bold font-medium-1 mb-0 package_{{ $package->id }}">{{ optional($package->end_at)->format("Y-m-d") }}</p>
                                                                <span class="">{{ trans('dashboard.package.end_at') }}</span>
                                                            </div>
                                                            <div class="following">
                                                                <p class="font-weight-bold font-medium-1 mb-0 {{ $package->paid_status_css }} paid_status_css_{{ $package->id }}">{{ trans('dashboard.package.paid_statuses.'.$package->is_paid) }}</p>
                                                                <span class="">{!! trans('dashboard.package.paid_status') !!}</span>
                                                            </div>
                                                        </div>
                                                        <div class="badge badge-lg block {{ $package->subscribe_status_css }} status_{{ $package->id }} mt-3">
                                                            <span>
                                                                {{ $package->subscribe_status }}
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty

                                        <div class="col-md-12 no_package_alert">
                                            <div class="alert alert-info alert-styled-left alert-dismissible">
                                                {{ trans('dashboard.package.not_packages_used') }}
                                            </div>

                                        </div>
                                        @endforelse
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        {!! $packages->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="elm" aria-labelledby="elm-tab">
                            <div class="card border-info">
                                <div class="card-header">
                                    <div class="card-title">{{ trans('dashboard.driver.elm_data') }}</div>
                                    <div class="heading-elements">
                                        <div class="badge badge-primary block badge-md mr-1 mb-1">
                                            {{ $driver->driver->elm_reply ? trans('dashboard.driver.elm.previous_check') : trans('dashboard.driver.elm.no_check_yet') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 mb-1">
                                            <div class="users-view-image mx-auto d-block text-center">
                                                <img src="{{ asset('dashboardAssets') }}/global/images/brands/elm.jpg" class="users-avatar-shadow rounded" style="height: 120px; width:120px;" alt="{{ @$driver->fullname }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">
                                                        {{ trans('dashboard.user.identity_number') }} :
                                                    </td>
                                                    <td>{{ $driver->identity_number ?? trans('dashboard.general.no_data') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">
                                                        {!! trans('dashboard.general.phone') !!} :
                                                    </td>
                                                    <td>{{ $driver->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">
                                                        {!! trans('dashboard.driver.date_of_birth') !!} :
                                                    </td>
                                                    <td>{{ optional($driver->date_of_birth)->format("Y-m-d") ?? trans('dashboard.general.no_data') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">
                                                        {!! trans('dashboard.driver.date_of_birth_hijri') !!} :
                                                    </td>
                                                    <td>{{ optional($driver->date_of_birth_hijri)->format("Y-m-d") ?? trans('dashboard.general.no_data') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">{!! trans('dashboard.car.license_serial_number') !!} :
                                                    </td>
                                                    <td>
                                                        {{ @$driver->car->license_serial_number ?? trans('dashboard.general.no_data') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">
                                                        {!! trans('dashboard.car.plate_type') !!} :
                                                    </td>
                                                    <td>
                                                        @if (@$driver->car->plate_type)
                                                            {{ trans('dashboard.car.plate_types.'.$driver->car->plate_type) }}
                                                            @else
                                                            {!! trans('dashboard.general.no_data') !!}
                                                            @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{!! trans('dashboard.car.plate_number') !!} : </td>
                                                    <td>{{ @$driver->car->plate_number ?? trans('dashboard.general.no_data') }}</td>
                                                </tr>

                                            </table>
                                        </div>
                                        @if ($driver->identity_number)
                                        <div class="col-6">
                                            <a href="javascript::void(0)" class="btn btn-primary mr-1 float-left" onclick="getElmReply('{{ $driver->id }}')"><i class="feather icon-check-circle"></i> {!! trans('dashboard.driver.elm.reply') !!}</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript::void(0)" class="btn btn-success mr-1 float-right" onclick="registerToElm('{{ $driver->id }}')"><i class="feather icon-edit"></i> {!! trans('dashboard.driver.elm.register') !!}</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="health" aria-labelledby="health-tab">
                            <div class="card border-info">
                                <div class="card-header">
                                    <div class="card-title">
                                        {{ trans('dashboard.user.health_status') }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.user.is_infected') }}</label>
                                        <div class="col-md-3 position-relative has-icon-left">
                                            <input type="text" value="{{ $driver->is_infected ? trans('dashboard.user.infected') : trans('dashboard.user.not_infected') }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-heart"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-3">{{ trans('dashboard.user.is_with_special_needs') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left" id="health_status">
                                            <input type="text" name="is_with_special_needs" value="{{ $driver->is_with_special_needs ? trans('dashboard.user.with_special_needs') : trans('dashboard.user.not_with_special_needs') }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-help-circle"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>{!! trans('dashboard.user.admin_accept_health_status') !!}</p>

                                        </div>
                                        <div class="col-md-8 mb-1">
                                            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                                                <button onclick="acceptDriverHealthData('{{ $driver->id }}')" {{  $driver->is_with_special_needs ? 'disabled' : null }}
                                                    class="btn btn-primary font-small-3 text-bold-600 accept_health_btn_{{ $driver->id }}">{{ trans('dashboard.driver.accept_data') }}</button>
                                                <button onclick="openRefuseDriverHealthData('{{ $driver->id }}')" {{ !  $driver->is_with_special_needs ? 'disabled' : null }}
                                                    class="btn btn-danger font-small-3 text-bold-600 refuse_health_btn_{{ $driver->id }}">{{ trans('dashboard.driver.refuse_data') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            @if ($driver->health_certificate_type == 'image')
                                                <a href="{{ $driver->health_certificate }}" data-fancybox="gallery">
                                                    <img src="{{ $driver->health_certificate }}" alt="" style="width:400px; height:300px;" class="img-preview rounded">
                                                </a>
                                            @elseif ($driver->health_certificate_type == 'file')
                                                <object data="{{ $driver->health_certificate }}" type="application/pdf" width="300" height="200">
                                                    <a href="{{ $driver->health_certificate }}">{{ str_after($driver->health_certificate,'___file_') }}</a>
                                                </object>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="financial" aria-labelledby="financial-tab">
                            <div class="card border-info">
                                <div class="card-header">
                                    <div class="card-title">
                                        {{ trans('dashboard.user.financial_record') }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <table>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.finished_orders',['count' => $finished_orders->count(),'total_price' => $finished_orders->sum('total_price')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.cash_finished_orders', ['count' => $finished_orders->where('pay_type','cash')->count(), 'total_price' => $finished_orders->where('pay_type','cash')->sum('total_price')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.wallet_finished_orders', ['count' => $finished_orders->where('pay_type','wallet')->count(), 'total_price' => $finished_orders->where('pay_type','wallet')->sum('total_price')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.balance_lucky_box', ['count' => $driver->luckyBoxes->where('gift_type','balance')->count(), 'total_price' => $driver->luckyBoxes()->where('gift_type','balance')->sum('balance')]) !!}
                                                </tr>

                                            </table>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <table>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.points_lucky_box', ['count' => $driver->luckyBoxes->where('gift_type','points')->count(), 'total_price' => $driver->luckyBoxes()->where('gift_type','points')->sum('points')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.balance_withdrawal', [
                                                        'count' => $driver->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->count(),
                                                        'total_price' => $driver->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->transfered()->sum('amount')]) !!}

                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.balance_point_package', [
                                                        'count' => $driver->walletTransactions()->where(['transaction_type' => 'charge', 'app_typeable_type' => 'App\Models\PointPackage'])->count(),
                                                        'total_price' => $driver->walletTransactions()->where(['transaction_type' => 'charge', 'app_typeable_type' => 'App\Models\PointPackage'])->sum('amount')]) !!}

                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="wallet_transfers" aria-labelledby="wallet_transfers-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transfers->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.trans_num') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.transfer_from') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.transfer_to') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.amount') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.wallet_before_transfer') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.wallet_after_transfer') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.transfer_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($wallet_transfers as $wallet_transfer)
                                                <tr class="{{ $wallet_transfer->id }} text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $wallet_transfer->id }}</td>
                                                    <td>
                                                        @if ($wallet_transfer->transfer_from_id != $driver->id)
                                                            <a href="{{ route('dashboard.'.optional($wallet_transfer->transferFrom)->user_type.'.show',$wallet_transfer->transfer_from_id) }}">
                                                                {{ optional($wallet_transfer->transferFrom)->fullname }}
                                                            </a>
                                                        @else
                                                            {{ optional($wallet_transfer->transferFrom)->fullname }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($wallet_transfer->transfer_to_id != $driver->id)
                                                            <a href="{{ route('dashboard.'.optional($wallet_transfer->transferTo)->user_type.'.show',$wallet_transfer->transfer_to_id) }}">
                                                                {{ optional($wallet_transfer->transferTo)->fullname }}
                                                            </a>
                                                        @else
                                                            {{ optional($wallet_transfer->transferTo)->fullname }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-info text-bold-700 badge-md mr-1 mb-1">{{ $wallet_transfer->amount }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transfer->wallet_before }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transfer->wallet_after }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-violet badge-md mr-1 mb-1">{{ optional($wallet_transfer->created_at)->format("Y-m-d") }}</div>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transfers->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="points" aria-labelledby="points-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $points->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.point.creator') !!}</th>
                                                    <th>{!! trans('dashboard.point.amount') !!}</th>
                                                    <th>{!! trans('dashboard.point.points') !!}</th>
                                                    <th>{!! trans('dashboard.point.point_status') !!}</th>
                                                    <th>{!! trans('dashboard.point.used_status') !!}</th>
                                                    <th>{!! trans('dashboard.point.used_type') !!}</th>
                                                    <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($points as $point)
                                                    <tr class="{{ $point->id }} text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ optional($point->creator)->fullname }}
                                                        </td>

                                                        <td>
                                                            {{ $point->amount }}
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md text-bold-700 text-white mr-1 mb-1">{{ $point->points }}</div>
                                                        </td>
                                                        <td>
                                                            {{ trans('dashboard.point.point_statuses.'.$point->status) }}
                                                        </td>
                                                        <td>
                                                            {{ trans('dashboard.point.used_statuses.'.$point->is_used) }}
                                                        </td>
                                                        <td>
                                                            {{ trans('dashboard.point.reasons.'.$point->reason) }}
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $point->created_at->format("Y-m-d") }}</div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $points->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="wallet_transactions" aria-labelledby="wallet_transfers-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transactions->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transaction_number') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transfer_to') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transfer_from') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transaction_type') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.amount') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.wallet_before') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.wallet_after') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transaction_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($wallet_transactions as $wallet_transaction)
                                                    <tr class="{{ $wallet_transaction->id }} text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $wallet_transaction->id }}</td>
                                                        <td>
                                                            @if ($wallet_transaction->user && $wallet_transaction->user_id != $driver->id && !in_array(@$wallet_transaction->user->user_type ,['admin','superadmin']))
                                                                <a href="{{ route('dashboard.'.$wallet_transaction->user->user_type.'.show',$wallet_transaction->user_id) }}">
                                                                    {{ optional($wallet_transaction->user)->fullname }}
                                                                </a>
                                                            @else
                                                                {{ optional($wallet_transaction->user)->fullname }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($wallet_transaction->added_by_id != $driver->id && !in_array(@$wallet_transaction->addedBy->user_type ,['admin','superadmin',null]))
                                                                <a href="{{ route('dashboard.'.$wallet_transaction->addedBy->user_type.'.show',$wallet_transaction->added_by_id) }}">
                                                                    {{ optional($wallet_transaction->addedBy)->fullname }}
                                                                </a>
                                                            @else
                                                                {{ optional($wallet_transaction->addedBy)->fullname ?? trans('dashboard.wallet_transaction.system') }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="badge {{ $wallet_transaction->transaction_type == 'withdrawal' ? 'badge-danger' : 'badge-info' }} text-bold-700 badge-md mr-1 mb-1">
                                                                {{ trans('dashboard.wallet_transaction.transaction_types.'.$wallet_transaction->transaction_type) }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-info text-bold-700 badge-md mr-1 mb-1">{{ $wallet_transaction->amount }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transaction->wallet_before }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transaction->wallet_after }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ optional($wallet_transaction->created_at)->format("Y-m-d") }}</div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transactions->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('dashboard.driver.elm.reply') !!}</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-12">
                                <input type="text" value="{{ @$driver->driver->elm_reply['resultCode'] }}" class="form-control resultCode" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <textarea rows="4" class="form-control resultMsg" readonly>{{ @$driver->driver->elm_reply['resultMsg'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-info">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('dashboard.user.wallet') !!}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <div class="col-12">
                            <fieldset class="form-label-group form-group position-relative has-icon-left input-divider-left">
                                <input type="text" class="form-control" id="order_count" value="{{ $driver->driverOrders()->whereIn('order_status',['client_finish','driver_finish','admin_finish'])->where('is_deduct_commission',true)->count() }}" readonly>
                                <div class="form-control-position">
                                    <i class="feather icon-credit-card text-primary"></i>
                                </div>
                                <label for="order_count">{!! trans('dashboard.order.finished_orders') !!}</label>
                            </fieldset>

                        </div>
                        <div class="col-12">
                            <fieldset class="form-label-group form-group position-relative has-icon-left input-divider-left">
                                <input type="text" class="form-control" id="app_commission" value="{{ $driver->driverOrders()->whereIn('order_status',['client_finish','driver_finish','admin_finish'])->sum('app_commission') }}" readonly>
                                <div class="form-control-position">
                                    <i class="feather icon-credit-card text-primary"></i>
                                </div>
                                <label for="app_commission">{!! trans('dashboard.user.app_commission') !!}</label>
                            </fieldset>

                        </div>

                        <div class="col-12">
                            <fieldset class="form-label-group form-group position-relative has-icon-left input-divider-left">
                                <input type="text" class="form-control" id="iconLeftDivider" value="{{ $driver->wallet < 0 ? - $driver->wallet : 0 }}" readonly>
                                <div class="form-control-position">
                                    <i class="feather icon-credit-card text-primary"></i>
                                </div>
                                <label for="iconLeftDivider">{!! trans('dashboard.user.debt_wallet') !!}</label>
                            </fieldset>

                        </div>

                        <div class="col-12">
                            <label>{!! trans('dashboard.user.wallet') !!}</label>
                            <div class="position-relative has-icon-left input-group form-group">
                                {!! Form::text("wallet", $driver->wallet , ['class'=>"form-control user_wallet form-control-sm",'aria-describedby' => "button-addon2" ,'placeholder'=>trans('dashboard.user.wallet_value')]) !!}
                                <div class="form-control-position">
                                    <i class="feather icon-credit-card px-1 text-primary"></i>
                                </div>
                                @if (auth()->user()->hasPermissions('driver','wallet'))
                                <div class="input-group-append" id="button-addon2">
                                    <a href="javascript:void(0)" onclick="updateUserWallet('{{ $driver->id }}')" class="btn btn-primary btn-sm btn_change_wallet d-flex align-items-center"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-info">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('dashboard.user.rating') !!}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="list-group analytics-list">
                            <div class="list-group-item d-lg-flex justify-content-between align-items-start py-1">
                                <div class="float-left">
                                    <p class="text-bold-600 font-medium-2 mb-0 mt-25">{{ $driver->user_rate_percentage ? $driver->user_rate_percentage.'%' : '0%' }}</p>
                                    <small>{{ $driver->rateClients->count() }} {{ $driver->rateClients->count() > 1 ? trans('dashboard.user.users_make_rate') : trans('dashboard.user.user_make_rate') }}</small>
                                </div>
                                <div class="float-right">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:{{ $driver->user_rate_percentage ? $driver->user_rate_percentage.'%' : '0%' }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="list-group analytics-list">
                            <div class="list-group-item d-lg-flex justify-content-between align-items-start py-1">
                                <div class="float-left">
                                    <p class="text-bold-600 font-medium-2 mb-0 mt-25">{!! trans('dashboard.car.car') !!}</p>
                                    <small>
                                        @if($driver->car)
                                            <a href="{!! route('dashboard.car.show',$driver->car->id) !!}">{{ optional(@$driver->car->carModel)->name }} - {{ optional(@$driver->car->brand)->name }}</a></td>
                                            @endif
                                    </small>
                                </div>
                                <div class="float-right">
                                    @if($driver->car)
                                        <a href="{!! route('dashboard.car.show',$driver->car->id) !!}"><i class="feather icon-tv"></i></a></td>
                                        @endif
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->hasPermissions('driver','admin_accept_driver'))
                        <hr>
                        <div class="list-group analytics-list">
                            <div class="list-group-item py-1">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-bold-600 font-small-3 mb-0 mt-25">
                                            {!! trans('dashboard.driver.admin_accept_status') !!}
                                            ( <span
                                                class="font-small-1 {{ optional($driver->driver)->is_admin_accept ? 'text-success' : 'text-danger' }} span_driver_{{ $driver->id }}">{{ optional($driver->driver)->is_admin_accept ? trans('dashboard.driver.admin_accept') : trans('dashboard.driver.admin_refuse') }}</span>
                                            )
                                        </p>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                                            <button onclick="toggleAdminAccept('{{ $driver->id }}')" class="btn btn-primary font-small-3 text-bold-600 accept_btn_{{ $driver->id }}">{{ trans('dashboard.driver.accept_data') }}</button>
                                            <button onclick="openRefuseReasonModal('{{ $driver->id }}')" class="btn btn-danger font-small-3 text-bold-600 refuse_btn_{{ $driver->id }}">{{ trans('dashboard.driver.refuse_data') }}</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif
                        <hr>
                        @if (auth()->user()->hasPermissions('package','store') && auth()->user()->hasPermissions('package','update'))

                        @if ($driver->driverPackages()->exists())
                        <div class="form-group">
                            <label for="first-name-icon">
                                {!! trans('dashboard.package.increment_subscribed_date') !!}
                            </label>
                            <span class="float-left">({{ optional(optional(@$driver->driver->subscribedPackage)->package)->name }})</span>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                                    <a class="btn btn-success btn-sm text-bold-700 font-small-2 text-white" data-toggle="modal" data-target="#package_subscribe_modal"><i class="feather icon-calendar mr-1"></i> {{ trans('dashboard.package.renew') }}</a>
                                    <a class="btn btn-primary btn-sm text-bold-700 font-small-2 text-white" data-toggle="modal" data-target="#change_package_modal"><i class="feather icon-calendar mr-1"></i> {{ trans('dashboard.package.change_package') }}</a>

                                </div>
                            </div>
                        </div>

                        @else
                        <p class="text-warning text-center">{!! trans('dashboard.package.not_packages_used') !!}</p>
                        <div class=" d-flex justify-content-start">
                            <a class="btn btn-primary btn-block waves-effect waves-light text-white" data-toggle="modal" data-target="#change_package_modal"><i class="feather icon-calendar mr-1"></i> {{ trans('dashboard.package.change_package') }}</a>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent comments -->
            <div class="card border-info">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="card-title font-weight-semibold">{!! trans('dashboard.driver.other_drivers') !!}</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="media-list media-bordered">
                        @forelse ($other_drivers as $other_driver)
                        <div class="media">
                            <a class="media-left" href="{!! route('dashboard.driver.show',$other_driver->id) !!}">
                                <div class="avatar">
                                    <img class="rounded-circle" src="{{ $other_driver->avatar }}" alt="{{ $other_driver->fullname }}" height="40" width="40">
                                    <span class="avatar-status-busy avatar-status-md" id="online_{{ $other_driver->id }}"></span>
                                </div>
                            </a>
                            <div class="media-body text-left font-small-1">
                                <h5 class="media-heading">{{ $other_driver->fullname }}</h5>
                                {{ $other_driver->phone }}
                            </div>

                        </div>

                        @empty
                        <div class="media font-weight-semibold border-0 py-2 justify-content-center">{!! trans('dashboard.driver.no_drivers') !!}</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- /recent comments -->
        </div>
        <!-- /basic datatable -->
    </section>
</div>
@include('dashboard.layout.notify_modal')
@include('dashboard.driver.package_modal')
@include('dashboard.driver.change_package_modal')
@include('dashboard.driver.refuse_driver_data_modal')
@include('dashboard.driver.refuse_health_data_modal')
@endsection
@section('vendor_styles')

<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">
@endsection
@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/users.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/data-list-view.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/global/css/custom/custom_rate.css">


<style media="screen">
    .toggle-switch .custom-control-label:before {
        background-color: #666b81 !important;
    }

    .toggle-edit .custom-control-label:before {
        background-color: #666b81 !important;
        height: 24px !important;
        width: 45px !important;
    }

    .toggle-edit .custom-control-label:after {
        height: 20px !important;
        width: 20px !important;
    }

    .toggle-edit .custom-control-label {
        width: 25px !important;
    }
</style>
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>

<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>

@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/user-profile.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/navs/navs.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
    $(function() {
        $('.expire_date').pickadate({
            format: 'mm/dd/yyyy'
        });
    });

    function changePackageSubscribtion(packageId, driverId) {
        // var end_date = $('.expire_date').val();
        // var package_end_date = $('.package_'+packageId);
        // var package_status = $('.status_'+packageId);
        // var paid_status_css = $('.paid_status_css_'+packageId);
        var isPaid = $('.driver_package_form input[name=is_paid]:checked').val();
        var endAt = $('.driver_package_form input[name=end_at]').val();
        var form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        form_data.append('is_paid', isPaid);
        form_data.append('end_at', endAt);
        $.ajax({
            url: $('.driver_package_form').attr('action'),
            method: $('.driver_package_form').attr('method'),
            data: form_data,
            global: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success(data['message'], '', {
                        "progressBar": true
                    });


                    $('#package_subscribe_modal').modal('hide');
                    $('#package_subscribe_' + packageId).html(`
                    <div class="row align-items-center mx-auto" style="height: 333px !important;">
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `).delay(2000).queue(function(next) {
                        $(this).html(data.view);
                        next();
                    });

                    // package_end_date.text(data.end_date);
                    // package_status.text(data.package_status);
                    // package_status.removeClass(data.style_before);
                    // package_status.addClass(data.package_status_css);

                }
            }
        }).fail(function(data) {
            $.each(data.responseJSON.errors, function(index, val) {
                toastr.error(val, '', {
                    "progressBar": true
                });
            });
        });
    }

    function changePackageId() {

        var isPaid = $('.driver_change_package_form input[name=is_paid]:checked').val() == 'on' ? 1 : 0;
        var packageId = $('.driver_change_package_form select[name=package_id]').val();
        var form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        form_data.append('is_paid', isPaid);
        form_data.append('package_id', packageId);
        $.ajax({
            url: '{{ LaravelLocalization::localizeUrl('dashboard/ajax/set_new_package_to_driver/'.$driver->id) }}',
            method: $('.driver_change_package_form').attr('method'),
            data: form_data,
            global: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success(data['message'], '', {
                        "progressBar": true
                    });
                    $('#change_package_modal').modal('hide');
                    $('.driver_packages').prepend(data.view);
                    $('.no_package_alert').remove();
                }
            }
        }).fail(function(data) {
            $.each(data.responseJSON.errors, function(index, val) {
                toastr.error(val, '', {
                    "progressBar": true
                });
            });
        });
    }


// Health Status
    function acceptDriverHealthData(driver_id) {
        var accept_btn = $('.accept_health_btn_' + driver_id);
        var refuse_btn = $('.refuse_health_btn_' + driver_id);
        var input_text = $('#health_status input[name=is_with_special_needs]');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/user_health_status_data') }}/" + driver_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                } else {
                    toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                }
                input_text.val(data.text);
                accept_btn.attr('disabled', data.accept_btn);
                refuse_btn.attr('disabled', data.refuse_btn);
            }
        });
    }



    function openRefuseDriverHealthData(driver_id) {
        var driver_id = $('#refuse_health_reason_modal input[name=driver_id]').val(driver_id);
        $('#refuse_health_data_modal').modal('show');
    }

    function refuseUserHealthStatus() {
        var driver_id = $('#refuse_health_reason_modal input[name=driver_id]').val();
        var refuse_reason = $('#refuse_health_reason_modal textarea[name=refuse_health_reason]');
        var refuse_reason_val = refuse_reason.val();
        var accept_btn = $('.accept_health_btn_' + driver_id);
        var refuse_btn = $('.refuse_health_btn_' + driver_id);
        var input_text = $('#health_status input[name=is_with_special_needs]');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/user_health_status_data') }}/" + driver_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}',
                refuse_reason: refuse_reason_val
            },
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                } else {
                    toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                }
                $('#refuse_health_data_modal').modal('hide');
                input_text.val(data.text);
                accept_btn.attr('disabled', data.accept_btn);
                refuse_btn.attr('disabled', data.refuse_btn);
                refuse_reason.val('')
            }
        });
    }


//Driver Data
function toggleAdminAccept(driver_id) {
    var span_text = $('.span_driver_' + driver_id);
    var accept_btn = $('.accept_btn_' + driver_id);
    var refuse_btn = $('.refuse_btn_' + driver_id);
    $.ajax({
        url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/enable_driver_data') }}/" + driver_id,
        method: "POST",
        dataType: "json",
        data: {
            _token: '{{ csrf_token() }}',
            is_admin_accept : "1"
        },
        success: function(data) {
            if (data['value'] == 1) {
                toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                        "progressBar": true
                    });
            } else {
                toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                        "progressBar": true
                    });
            }
            span_text.text(data.text);
            span_text.removeClass(data.removed_class);
            span_text.addClass(data.text_class);
            // accept_btn.attr('disabled', data.accept_btn);
            // refuse_btn.attr('disabled', data.refuse_btn);
        }
    });
}

    function openRefuseReasonModal(driver_id) {
        var driver_id = $('#refuse_reason_modal input[name=driver_id]').val(driver_id);
        $('#refuse_driver_data_modal').modal('show');
    }

    function refuseDriverData() {
        var driver_id = $('#refuse_reason_modal input[name=driver_id]').val();
        var refuse_reason = $('#refuse_reason_modal textarea[name=refuse_reason]');
        var refuse_reason_val = refuse_reason.val();
        var accept_btn = $('.accept_btn_' + driver_id);
        var refuse_btn = $('.refuse_btn_' + driver_id);
        var span_text = $('.span_driver_' + driver_id);
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/enable_driver_data') }}/" + driver_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}',
                refuse_reason: refuse_reason_val,
                is_admin_accept : "0"
            },
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                } else {
                    toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                }
                $('#refuse_driver_data_modal').modal('hide');
                span_text.text(data.text);
                span_text.removeClass(data.removed_class);
                span_text.addClass(data.text_class);
                // accept_btn.attr('disabled', data.accept_btn);
                // refuse_btn.attr('disabled', data.refuse_btn);
                refuse_reason.val('')
            }
        });
    }

    function EnablePackageSubscribe(driver_id, packageId) {
        var end_date = $('.expire_date').val();
        var package_end_date = $('.package_' + packageId);
        var package_status = $('.status_' + packageId);
        var paid_status_css = $('.paid_status_css_' + packageId);
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/enable_driver_subscribe') }}/" + driver_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });

                    package_end_date.text(data.end_date);
                    package_status.text(data.package_status);
                    package_status.removeClass(data.style_before);
                    package_status.addClass(data.package_status_css);
                    paid_status_css.text(data.paid_status_text);

                } else {
                    toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                }
            }
        });
    }

    function registerToElm(driver_id) {
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/register_driver_to_elm') }}/" + driver_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data['value'] == 1) {
                    $('.resultCode').val(data.resultCode);
                    $('.resultMsg').val(data.resultMsg);
                }
            }
        });
    }

    function getElmReply(driver_id) {
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/get_elm_reply') }}/" + driver_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data['value'] == 1) {
                    $('.resultCode').val(data.resultCode);
                    $('.resultMsg').val(data.resultMsg);
                }
            }
        });
    }

    function updateUserWallet(userId) {
        var wallet = $('.user_wallet').val();
        var btn = $('.btn_change_wallet');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/update_user_wallet') }}/" + userId,
            method: "POST",
            dataType: "json",
            global: false,
            data: {
                wallet: wallet,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function(xhr) {
                btn.html('<div class="spinner-border text-success spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');
            },
            success: function(data) {
                if (data['value'] == 1) {
                    btn.html('<i class="feather icon-refresh-cw"></i>');
                    toastr.success(data['message'], '', {
                        "progressBar": true
                    });
                } else {
                    btn.html('<i class="feather icon-refresh-cw"></i>');
                    toastr.danger(data['message'], '', {
                        "progressBar": true
                    });
                }
            }
        }).fail(function(data) {
            btn.html('<i class="feather icon-refresh-cw"></i>');
            $.each(data.responseJSON.errors, function(index, val) {
                toastr.error(val, '', {
                    "progressBar": true
                });
            });
        });
    }
</script>
@endsection

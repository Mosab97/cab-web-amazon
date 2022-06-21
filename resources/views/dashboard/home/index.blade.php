@extends('dashboard.layout.layout')

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $clients_count }}</h2>
                                <p>{{ trans('dashboard.client.clients') }}</p>
                            </div>
                            <div class="avatar bg-rgba-success p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.client.index') }}">
                                        <i class="feather icon-users text-success font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $drivers_count }}</h2>
                                <p>{{ trans('dashboard.driver.drivers') }}</p>
                            </div>
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.driver.index') }}">
                                        <i class="feather icon-truck text-primary font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $clients_is_active_count }}</h2>
                                <p>{{ trans('dashboard.client.deacive_clients') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.client.index') }}?status=deactive">
                                        <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $clients_is_ban_count }}</h2>
                                <p>{{ trans('dashboard.client.banned_clients') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.client.index') }}?status=ban">
                                        <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $drivers_is_active_count }}</h2>
                                <p>{{ trans('dashboard.driver.deacive_drivers') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.driver.index') }}?status=deactive">
                                        <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $wait_accept_drivers }}</h2>
                                <p style="font-size: small;">{{ trans('dashboard.driver.wait_accept_drivers') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-40 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.driver.index') }}?status=wait_accept_drivers">
                                        <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $drivers_is_ban_count }}</h2>
                                <p>{{ trans('dashboard.driver.banned_drivers') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.driver.index') }}?status=ban">
                                        <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $managers_count }}</h2>
                                <p>{{ trans('dashboard.manager.managers') }}</p>
                            </div>
                            <div class="avatar bg-rgba-violet p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.manager.index') }}">
                                        <i class="feather icon-user text-violet font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <div class="card border-info">
                <div class="card-header d-flex justify-content-between pb-0">
                    <a href="{{ route('dashboard.order.index') }}">
                        <h4 class="card-title">{!! trans('dashboard.order.total_orders') !!}</h4>
                    </a>

                </div>
                <div class="card-content">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                <h1 class="font-large-2 text-bold-700 mt-2 mb-0">{{ $orders_count }}</h1>
                                <small>{!! trans('dashboard.order.orders') !!}</small>
                            </div>
                            <div class="col-sm-10 col-12 d-flex justify-content-center">
                                <div id="support-tracker-chart"></div>
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between">
                            <div class="text-center">
                                <a href="{{ route('dashboard.order.index') }}?order_status=pending">
                                    <p class="mb-50">
                                        {!! trans('dashboard.order.pending_orders') !!}
                                    </p>
                                </a>
                                <span class="font-large-1">{{ $pending_orders_count }}</span>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('dashboard.order.index') }}?order_status=canceled">
                                    <p class="mb-50">{!! trans('dashboard.order.canceled_orders') !!}
                                    </p>
                                </a>
                                <span class="font-large-1">{{ $canceled_orders_count }}</span>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('dashboard.order.index') }}?order_status=finished">
                                    <p class="mb-50">{!! trans('dashboard.order.finished_orders') !!}</p>
                                </a>
                                <span class="font-large-1">{{ $finished_orders_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0" id="online_admins">0</h2>
                                <p>{{ trans('dashboard.admin.online_admins') }}</p>
                            </div>
                            <div class="avatar bg-rgba-info p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-success font-medium-5"></i>
                                    <span class="avatar-status-online avatar-status-lg"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0" id="online_clients">0</h2>
                                <p>{{ trans('dashboard.client.online_clients') }}</p>
                            </div>
                            <div class="avatar bg-rgba-info p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-success font-medium-5"></i>
                                    <span class="avatar-status-online avatar-status-lg"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0" id="online_drivers">0</h2>
                                <p>{{ trans('dashboard.driver.online_drivers') }}</p>
                            </div>
                            <div class="avatar bg-rgba-info p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-success font-medium-5"></i>
                                    <span class="avatar-status-online avatar-status-lg"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $wallet_orders_count }}</h2>
                                <p>{{ trans('dashboard.order.orders_paid_by_wallet') }}</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.order.index') }}?paid_by=wallet">
                                        <i class="feather icon-credit-card text-danger font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $cash_orders_count }}</h2>
                                <p>{{ trans('dashboard.order.orders_paid_by_cash') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.order.index') }}?paid_by=cash">
                                        <i class="feather icon-dollar-sign text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card border-info bg-transparent">
                        <div class="card-header rounded d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $orders_count }}</h2>
                                <p>{{ trans('dashboard.order.orders') }}</p>
                            </div>
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.order.index') }}">
                                        <i class="feather icon-pie-chart text-primary font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card border-info bg-transparent text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-clock text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="clock text-center">
                                        <span id="Date" class=""></span>
                                        <p id="islamicDate" class=""></p>
                                        <span class="">
                                            <ul>
                                                <li id="hours"></li>
                                                <li id="point">:</li>
                                                <li id="min"></li>
                                                <li id="point">:</li>
                                                <li id="sec"></li>
                                            </ul>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $cars_count }}</h2>
                        <p>{{ trans('dashboard.car.cars') }}</p>
                    </div>
                    <div class="avatar bg-rgba-info p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.car.index') }}">
                                <i class="feather icon-activity text-info font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $brands_count }}</h2>
                        <p>{{ trans('dashboard.brand.brands') }}</p>
                    </div>
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.brand.index') }}">
                                <i class="feather icon-flag text-danger font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $car_models_count }}</h2>
                        <p>{{ trans('dashboard.car_model.car_models') }}</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.car_model.index') }}">
                                <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
                <div class="card border-info bg-transparent">
                    <div class="card-header rounded d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $car_types_count }}</h2>
                            <p>{{ trans('dashboard.car_type.car_types') }}</p>
                        </div>
                        <div class="avatar bg-rgba-info p-50 m-0">
                            <div class="avatar-content">
                                <a href="{{ route('dashboard.car_type.index') }}">
                                    <i class="feather icon-target text-info font-medium-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $clients_is_with_special_needs_count }}</h2>
                        <p>{{ trans('dashboard.client.special_needs_clients') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.client.index') }}?status=with_special_needs">
                                <i class="feather icon-heart text-danger font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
                <div class="card border-info bg-transparent">
                    <div class="card-header rounded d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $drivers_is_with_special_needs_count }}</h2>
                            <p>{{ trans('dashboard.driver.special_needs_drivers') }}</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <a href="{{ route('dashboard.driver.index') }}?status=with_special_needs">
                                    <i class="feather icon-heart text-danger font-medium-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <div class="divider divider-success">
        <div class="divider-text"><i class="feather icon-truck"></i> {!! trans('dashboard.driver.drivers') !!}</div>
    </div>


    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $accepted_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.accepted_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=accepted">
                                <i class="feather icon-award text-success font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $paid_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.paid_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=paid">
                                <i class="feather icon-credit-card text-success font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-md-3 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $available_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.available_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=available">
                                <i class="feather icon-truck text-primary font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $refused_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.refused_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=refused_drivers">
                                <i class="feather icon-x text-danger font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $both_type_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.both_type_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=both_type">
                                <i class="feather icon-truck text-success font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $delivery_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.delivery_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=delivery">
                                <i class="feather icon-package text-primary font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $ride_drivers }}</h2>
                        <p>{{ trans('dashboard.driver.ride_drivers') }}</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.driver.index') }}?status=ride_drivers">
                                <i class="feather icon-users text-info font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="divider divider-success">
        <div class="divider-text"><i class="feather icon-package"></i> {!! trans('dashboard.package.packages') !!}</div>
    </div>
    <div class="row">

        <div class="col-lg-4 col-md-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $packages->count() }}</h2>
                        <p>{{ trans('dashboard.package.packages') }}</p>
                    </div>
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.package.index') }}">
                                <i class="feather icon-flag text-danger font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $active_packages }}</h2>
                        <p>{{ trans('dashboard.package.active_packages') }}</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.package.index') }}?status=active">
                                <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $app_commission }}</h2>
                        <p>{{ trans('dashboard.user.app_commission') }}</p>
                    </div>
                    <div class="avatar bg-rgba-info p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-credit-card text-info font-medium-5"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="divider divider-success">
        <div class="divider-text"><i class="feather icon-shopping-cart"></i> {!! trans('dashboard.order.today_count_finished_orders') !!}</div>
    </div>


    <div class="row">
        <div class="col-md-3 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $today_client_finished_orders }}</h2>
                        <p>{{ trans('dashboard.order.today_client_finished_orders') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.order.index') }}?date={{ date('Y-m-d') }}&user_type=client&order_status=finished">
                                <i class="feather icon-users text-success font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $today_driver_finished_orders }}</h2>
                        <p>{{ trans('dashboard.order.today_driver_finished_orders') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.order.index') }}?date={{ date('Y-m-d') }}&user_type=driver&order_status=finished">
                                <i class="feather icon-truck text-success font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $today_admin_finished_orders }}</h2>
                        <p>{{ trans('dashboard.order.today_admin_finished_orders') }}</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.order.index') }}?date={{ date('Y-m-d') }}&user_type=admin&order_status=finished">
                                <i class="feather icon-user text-success font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-12">
            <div class="card border-info bg-transparent">
                <div class="card-header rounded d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{ $today_finished_orders }}</h2>
                        <p>{{ trans('dashboard.order.today_finished_orders') }}</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <a href="{{ route('dashboard.order.index') }}?date={{ date('Y-m-d') }}&order_status=finished">
                                <i class="feather icon-calendar text-primary font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="divider divider-success">
        <div class="divider-text"><i class="feather icon-activity"></i></div>
    </div>
    {{-- Charts --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-info">
                <div class="card-header pb-1">
                    <h4 class="card-title">{!! trans('dashboard.chart.charts') !!}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{!! route('dashboard.home') !!}" method="get">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="font-medium-1 col-md-2">{{ trans('dashboard.general.from_date') }} </label>
                                            <div class="col-md-10">
                                                {!! Form::date("from_date", request('from_date') ? date("Y-m-d",strtotime(request('from_date'))) : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.general.from_date')])
                                                !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="font-medium-1 col-md-2">{{ trans('dashboard.general.to_date') }} </label>
                                            <div class="col-md-10">
                                                {!! Form::date("to_date", request('to_date') ? date("Y-m-d",strtotime(request('to_date'))) : null , ['class' => 'form-control expire_date' , 'placeholder' => trans('dashboard.general.to_date')]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-md btn-block btn-primary float-right"> {!! trans('dashboard.general.send') !!}</button>
                                </div>

                            </div>
                        </form>
                        <div class="divider divider-success">
                            <div class="divider-text"><i class="feather icon-bar-chart-2"></i></div>
                        </div>
                        <div id="client_chart" style="height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Orders --}}
    <div class="row">
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-">
                <li class="nav-item">
                    <a class="nav-link d-flex py-75 active" id="account-pill-new" data-toggle="pill" href="#new" aria-expanded="true">
                        <i class="feather icon-watch mr-50 font-medium-3"></i>
                        {!! trans('dashboard.order.new_orders') !!}
                    </a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link d-flex py-75" id="account-pill-current" data-toggle="pill" href="#current" aria-expanded="false">
                        <i class="feather icon-truck mr-50 font-medium-3"></i>
                        {!! trans('dashboard.order.current_orders') !!}
                    </a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link d-flex py-75" id="account-pill-finished" data-toggle="pill" href="#finished" aria-expanded="false">
                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                        {!! trans('dashboard.order.finished_orders') !!}
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="card border-info">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="new" aria-labelledby="account-pill-new" aria-expanded="true">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">{!! trans('dashboard.order.new_orders') !!}</h4>

                                    </div>
                                    <div class="card-content list-orders new_orders">
                                        <div class="table-responsive mt-1">
                                            <table class="table table-hover-animation mb-0 new_orders_scroll">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>#</th>
                                                        <th>{!! trans('dashboard.client.client') !!}</th>
                                                        <th>{!! trans('dashboard.order.order_status') !!}</th>
                                                        <th>{!! trans('dashboard.order.order_type') !!}</th>
                                                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                        <th><i class="feather icon-zap"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="new_orders_row">
                                                    @forelse ($new_orders as $order)
                                                    <tr class="text-center">
                                                        <td># {{ $order->id }} </td>
                                                        <td>{{ optional($order->client)->fullname }}</td>
                                                        <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i>{{ trans('dashboard.order.statuses.'.$order->order_status) }}</td>

                                                        <td>
                                                            {{ trans('dashboard.order.order_types.'.$order->order_type) }}
                                                        </td>
                                                        <td>{{ $order->created_at->isoFormat("D MMMM , Y ( h:mm a )") }}</td>
                                                        <td class="text-center font-medium-1">
                                                            <a href="{!! route('dashboard.order.show',$order->id) !!}" class="text-primary mr-2 font-medium-3">
                                                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <p>{{ trans('dashboard.order.no_orders') }}
                                                                <p>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="ajax-load text-center" style="display:none">
                                                <div class="spinner-border text-success" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="current" aria-labelledby="account-pill-current" aria-expanded="false">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">{!! trans('dashboard.order.current_orders') !!}</h4>
                                    </div>
                                    <div class="card-content list-orders current_orders">
                                        <div class="table-responsive mt-1">
                                            <table class="table table-hover-animation mb-0 current_orders_scroll">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>#</th>
                                                        <th>{!! trans('dashboard.client.client') !!}</th>
                                                        <th>{!! trans('dashboard.order.order_status') !!}</th>
                                                        <th>{!! trans('dashboard.order.order_type') !!}</th>
                                                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                        <th><i class="feather icon-zap"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="current_orders_row">
                                                    @forelse ($current_orders as $order)
                                                    <tr class="text-center">
                                                        <td># {{ $order->id }}</td>
                                                        <td>{{ optional($order->client)->fullname }}</td>
                                                        <td><i class="fa fa-circle font-small-3 text-primary mr-50"></i>{{ trans('dashboard.order.statuses.'.$order->order_status) }}</td>
                                                        <td>
                                                            {{ trans('dashboard.order.order_types.'.$order->order_type) }}
                                                        </td>
                                                        <td>{{ $order->created_at->isoFormat("D MMMM , Y ( h:mm a )") }}</td>
                                                        <td class="text-center font-medium-1">
                                                            <a href="{!! route('dashboard.order.show',$order->id) !!}" class="text-primary mr-2 font-medium-3">
                                                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <p>{{ trans('dashboard.order.no_orders') }}
                                                                <p>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="ajax-load text-center" style="display:none">
                                                <div class="spinner-border text-success" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="finished" aria-labelledby="account-pill-finished" aria-expanded="false">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">{!! trans('dashboard.order.finished_orders') !!}</h4>
                                    </div>
                                    <div class="card-content list-orders finished_orders">
                                        <div class="table-responsive mt-1">
                                            <table class="table table-hover-animation mb-0 finished_orders_scroll">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>#</th>
                                                        <th>{!! trans('dashboard.client.client') !!}</th>
                                                        <th>{!! trans('dashboard.order.order_status') !!}</th>
                                                        <th>{!! trans('dashboard.order.order_type') !!}</th>
                                                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                        <th><i class="feather icon-zap"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="finished_orders_row">
                                                    @forelse ($finished_orders as $order)
                                                    <tr class="text-center">
                                                        <td># {{ $order->id }}</td>
                                                        <td>{{ optional($order->client)->fullname }}</td>
                                                        <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>{{ trans('dashboard.order.statuses.'.$order->order_status) }}</td>
                                                        <td>
                                                            {{ trans('dashboard.order.order_types.'.$order->order_type) }}
                                                        </td>
                                                        <td>{{ $order->created_at->isoFormat("D MMMM , Y ( h:mm a )") }}</td>
                                                        <td class="text-center font-medium-1">
                                                            <a href="{!! route('dashboard.order.show',$order->id) !!}" class="text-primary mr-2 font-medium-3">
                                                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <p>{{ trans('dashboard.order.no_orders') }}
                                                                <p>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="ajax-load text-center" style="display:none">
                                                <div class="spinner-border text-success" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Analytics end -->
@endsection
@include('dashboard.home.scripts')

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
                {{-- <div class="col-md-6 col-12">
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
                </div> --}}
                {{-- <div class="col-md-6 col-12">
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
                </div> --}}
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
            {{-- <div class="card border-info">
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
            </div> --}}
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
                                <h2 class="text-bold-700 mb-0">{{ $countries_count }}</h2>
                                <p>{{ trans('dashboard.country.countries') }}</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.country.index') }}">
                                        <i class="feather icon-flag text-danger font-medium-5"></i>
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
                                <h2 class="text-bold-700 mb-0">{{ $cities_count }}</h2>
                                <p>{{ trans('dashboard.city.cities') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="{{ route('dashboard.city.index') }}">
                                        <i class="feather icon-corner-down-left text-warning font-medium-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6 col-12">
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
                </div> --}}
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


</section>
<!-- Dashboard Analytics end -->
@endsection
@include('dashboard.home.scripts')

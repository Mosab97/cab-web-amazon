@extends('dashboard.layout.layout')

@section('content')
<!-- page users view start -->
<section class="page-users-view">
    <div class="row">
        <!-- account start -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ trans('dashboard.car.car_data') }}</div>
                    <div class="heading-elements">
                        <div class="badge badge-primary block badge-md mr-1 mb-1">
                            {{ $car->created_at->format("Y-m-d") }}
                        </div>
                        <div class="badge badge-success block badge-md mr-1 mb-1">
                            {!! trans('dashboard.order.order_count') !!} : {{ $car->orders->count() }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="users-view-image d-flex align-items-center justify-content-center">
                            <span class="text-info users-avatar-shadow w-100 rounded d-flex align-items-center justify-content-center">
                                <i class="feather icon-truck font-large-3"></i>
                            </span>
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.brand.brand') }}
                                    </td>
                                    <td>{{ optional(@$car->brand)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {!! trans('dashboard.car_model.car_model') !!}
                                    </td>
                                    <td>{{ optional(@$car->carModel)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {!! trans('dashboard.car_type.car_type') !!}
                                    </td>
                                    <td>{{ optional(@$car->carType)->name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.car.license_serial_number') !!} :
                                    </td>
                                    <td>
                                        {{ $car->license_serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {!! trans('dashboard.car.plate_type') !!} :
                                    </td>
                                    <td>
                                        {{ trans('dashboard.car.plate_types.'.$car->plate_type) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.car.manufacture_year') !!} : </td>
                                    <td>{{ $car->manufacture_year }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-12">
                            <a href="{!! route('dashboard.car.edit',$car->id) !!}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> {!! trans('dashboard.general.edit') !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- account end -->
        <!-- information start -->
        <div class="col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{!! trans('dashboard.driver.driver') !!}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="users-view-image mx-auto d-block text-center">
                                <img src="{{ @$car->driver->avatar ?? $car->car_front_image }}" class="users-avatar-shadow rounded" style="height: 120px; width:120px;" alt="{{ @$car->driver->fullname }}">
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.user.fullname') !!}</td>
                                    <td>{{ @$car->driver->fullname }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.general.email') !!}</td>
                                    <td>{{ @$car->driver->email }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.general.phone') !!}</td>
                                    <td>{{ @$car->driver->phone }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-5 col-12">
                            <table>

                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.order.order_count') !!}</td>
                                    <td>{{ optional(@$car->driver->driverOrders)->count() }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.package.package') !!}</td>
                                    <td>
                                    @if ($car->driver && $car->driver->subscribedPackage()->whereDate('end_at',"<",date("Y-m-d"))->exists())
                                    {{ optional($car->driver->subscribedPackage()->whereDate('end_at',"<",date("Y-m-d")))->name }}
                                    ({!! trans('dashboard.driver.need_renewal_subscribtion') !!})

                                    @elseif ($car->driver && $car->driver->subscribedPackage()->whereDate('end_at',">",date("Y-m-d"))->exists())
                                    {{ optional($car->driver->subscribedPackage()->whereDate('end_at',">",date("Y-m-d"))->latest()->first())->name }} ({{ $car->driver->subscribedPackage->end_at->format("Y-m-d") }})

                                   @elseif ($car->driver && $car->driver->subscribedPackage()->whereNull('end_at')->whereNull('subscribed_at')->exists())
                                    {{ optional($car->driver->subscribedPackage()->whereNull('end_at')->whereNull('subscribed_at')->latest()->first())->name }}

                                    ({!! trans('dashboard.driver.need_buy_subscribtion') !!})

                                    @else
                                        {!! trans('dashboard.driver.not_subscribed') !!}
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.user.rating') !!}({{ @$car->driver->user_rate_percentage ? @$car->driver->user_rate_percentage.'%' : '0%' }})</td>
                                    <td>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            <div class="full-stars" style="width:{{ @$car->driver->user_rate_percentage ? @$car->driver->user_rate_percentage.'%' : '0%' }}"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- information start -->
    </div>
</section>
<section class="page-users-view">

    <div class="col-12">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="divider divider-success">
                        <div class="divider-text text-success font-medium-2">{!! trans('dashboard.car.related_cars') !!}</div>
                    </div>
                    <div class="card border-info bg-transparent">
                        <div class="card-body">
                            @if ($related_cars->count())
                            <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                <div class="swiper-wrapper">
                                    @foreach ($related_cars as $related_car)
                                    <div class="swiper-slide rounded swiper-shadow">
                                        <a href="{{ route('dashboard.car.show',$related_car->id) }}">
                                            <div class="item-heading">
                                                <p class="text-truncate mb-0">
                                                    {{ $related_car->brand->name . " - " . $related_car->carModel->name }}
                                                </p>
                                                <p>
                                                    <i class="feather icon-user"></i>
                                                    <small>{!! trans('dashboard.order.order_count') !!} : {{ $related_car->orders->count() }}</small>
                                                </p>
                                            </div>
                                            <div class="img-container w-50 mx-auto my-2 py-75">
                                                <img src="{{ $related_car->car_front_image }}" style="height:100px; width:134px;" class="img-fluid rounded" alt="{{ $related_car->id }}">
                                            </div>
                                            <div class="item-meta">
                                                <p class="text-primary mb-0">
                                                    {{ @$related_car->carType->name }}
                                                    <i class="feather icon-award"></i>
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    @endforeach
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                            </div>
                            @else
                            <p class="text-center text-bold-700 font-medium-3">{!! trans('dashboard.car.no_cars') !!}</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-12">
                    <div class="divider divider-success">
                        <div class="divider-text text-success font-medium-2">{!! trans('dashboard.general.images') !!}</div>
                    </div>
                    <div class="card border-info bg-transparent">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-6 user-latest-img">
                                    <a href="{{ $car->car_front_image }}" data-fancybox="gallery">
                                        <img src="{{ $car->car_front_image }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_front_image') !!}">
                                    </a>
                                </div>
                                <div class="col-md-4 col-6 user-latest-img">
                                    <a href="{{ $car->car_back_image }}" data-fancybox="gallery">
                                        <img src="{{ $car->car_back_image }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_back_image') !!}">
                                    </a>
                                </div>
                                <div class="col-md-4 col-6 user-latest-img">
                                    <a href="{{ $car->car_form_image }}" data-fancybox="gallery">
                                        <img src="{{ $car->car_form_image }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_form_image') !!}">
                                    </a>
                                </div>
                                <div class="col-md-4 col-6 user-latest-img">
                                    <a href="{{ $car->car_licence_image }}" data-fancybox="gallery">
                                        <img src="{{ $car->car_licence_image }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_licence_image') !!}">
                                    </a>
                                </div>
                                <div class="col-md-4 col-6 user-latest-img">
                                    <a href="{{ $car->car_insurance_image }}" data-fancybox="gallery">
                                        <img src="{{ $car->car_insurance_image }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_insurance_image') !!}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
<!-- page users view end -->
@endsection

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/swiper.min.css">
@endsection

@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/app-user.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/app-ecommerce-details.css">
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/global/css/custom/custom_rate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/users.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/extensions/swiper.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

@endsection

@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/swiper.min.js"></script>
@endsection

@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/app-ecommerce-details.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/forms/number-input.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/user-profile.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/extensions/swiper.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

@endsection

@extends('dashboard.layout.layout')

@section('content')
<!-- page users view start -->
<section class="page-users-view">
    <div class="row">
        <!-- account start -->
        <div class="col-12">
            <div class="card">
                @if (in_array($update_request->update_type ,['car_data','personal_car_data']))
                <div class="card-header">
                    <div class="card-title">{{ trans('dashboard.update_request.update_types.car_data') }}</div>
                    <div class="heading-elements">
                        <div class="badge badge-primary block badge-md mr-1 mb-1">
                            {{ $update_request->created_at->format("Y-m-d") }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="users-view-image d-flex align-items-center justify-content-center">
                            <span class="text-info users-avatar-shadow w-100 rounded d-flex align-items-center justify-content-center">
                                <i class="feather icon-truck font-large-3 mb-2"></i>
                            </span>
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.brand.brand') }}
                                    </td>
                                    <td>{{ optional(@$update_request->brand)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {!! trans('dashboard.car_model.car_model') !!}
                                    </td>
                                    <td>{{ optional(@$update_request->carModel)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {!! trans('dashboard.car_type.car_type') !!}
                                    </td>
                                    <td>{{ optional(@$update_request->carType)->name }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.car.license_serial_number') !!} :
                                    </td>
                                    <td>
                                        {{ $update_request->license_serial_number ?? trans('dashboard.general.no_data') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">
                                        {!! trans('dashboard.car.plate_type') !!} :
                                    </td>
                                    <td>
                                        @if (@$update_request->plate_type)
                                            {{ trans('dashboard.car.plate_types.'.$update_request->plate_type) }}
                                        @else
                                            {!! trans('dashboard.general.no_data') !!}
                                        @endif
                                    </td>
                                </tr>

                            </table>
                            </div>
                            <div class="col-12 col-md-12 col-lg-5">
                                <table class="ml-0 ml-sm-0 ml-lg-0">

                                    <tr>
                                        <td class="font-weight-bold">
                                            {!! trans('dashboard.car.plate_number') !!} :
                                        </td>
                                        <td>
                                            {{ $update_request->plate_number ?? trans('dashboard.general.no_data') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">{!! trans('dashboard.car.manufacture_year') !!} : </td>
                                        <td>{{ $update_request->manufacture_year }}</td>
                                    </tr>

                                    @if ($update_request->phone)
                                    <tr>
                                        <td class="font-weight-bold">
                                            {!! trans('dashboard.general.phone') !!}
                                        </td>
                                        <td>{{ $update_request->phone }}</td>
                                    </tr>
                                    @endif
                                    @if ($update_request->identity_number)
                                    <tr>
                                        <td class="font-weight-bold">
                                            {!! trans('dashboard.user.identity_number') !!}
                                        </td>
                                        <td>{{ $update_request->identity_number }}</td>
                                    </tr>
                                    @endif
                                    @if ($update_request->driver_type)
                                    <tr>
                                        <td class="font-weight-bold">
                                            {!! trans('dashboard.driver.driver_type') !!}
                                        </td>
                                        <td>{{ $update_request->driver_type }}</td>
                                    </tr>
                                    @endif

                                </table>
                            </div>

                        <div class="col-6">
                            {!! Form::model($update_request,['route' =>['dashboard.update_request.update',$update_request->id],'method' => 'PUT']) !!}
                            {!! Form::hidden('update_status', 'accepted') !!}
                            <button class="btn btn-primary mr-1 float-left"><i class="feather icon-edit-1"></i> {!! trans('dashboard.update_request.accept_update') !!}</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger mr-1 float-right" data-target="#modal_refuse" data-toggle="modal"><i class="feather icon-x-circle"></i> {!! trans('dashboard.update_request.refuse_update') !!}</button>
                        </div>
                    </div>
                </div>
            @elseif (in_array($update_request->update_type ,['personal_data','personal_car_data']))
                <div class="card-header">
                    <div class="card-title">{{ trans('dashboard.update_request.update_types.personal_data') }}</div>
                    <div class="heading-elements">
                        <div class="badge badge-primary block badge-md mr-1 mb-1">
                            {{ $update_request->created_at->format("Y-m-d") }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="users-view-image d-flex align-items-center justify-content-center">
                            <span class="text-info users-avatar-shadow w-100 rounded d-flex align-items-center justify-content-center">
                                <i class="feather icon-user font-large-3 mb-2"></i>
                            </span>
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.general.phone') }}
                                    </td>
                                    <td>{{ $update_request->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.user.identity_number') }}
                                    </td>
                                    <td>{{ $update_request->identity_number }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.driver.date_of_birth') }}
                                    </td>
                                    <td>{{ optional($update_request->date_of_birth)->format("Y-m-d") }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.driver.date_of_birth_hijri') }}
                                    </td>
                                    <td>{{ optional($update_request->date_of_birth_hijri)->format("Y-m-d") }}</td>
                                </tr>
                                @if ($update_request->user_type == 'driver')
                                    <tr>
                                        <td class="font-weight-bold">
                                            {{ trans('dashboard.driver.driver_type') }}
                                        </td>
                                        <td>{{ $update_request->driver_type }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="font-weight-bold">
                                        {{ trans('dashboard.driver.date_of_birth_hijri') }}
                                    </td>
                                    <td>{{ optional($update_request->date_of_birth_hijri)->format("Y-m-d") }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            {!! Form::model($update_request,['route' =>['dashboard.update_request.update',$update_request->id],'method' => 'PUT']) !!}
                            {!! Form::hidden('update_status', 'accepted') !!}
                            <button class="btn btn-primary mr-1 float-left"><i class="feather icon-edit-1"></i> {!! trans('dashboard.update_request.accept_update') !!}</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger mr-1 float-right" data-target="#modal_refuse" data-toggle="modal"><i class="feather icon-x-circle"></i> {!! trans('dashboard.update_request.refuse_update') !!}</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{!! trans('dashboard.'.$update_request->user_type.'.'.$update_request->user_type) !!}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="users-view-image mx-auto d-block text-center">
                                <img src="{{ @$update_request->user->avatar }}" class="users-avatar-shadow rounded" style="height: 120px; width:120px;" alt="{{ @$update_request->user->fullname }}">
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.user.fullname') !!}</td>
                                    <td>{{ @$update_request->user->fullname }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.general.email') !!}</td>
                                    <td>{{ @$update_request->user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{!! trans('dashboard.general.phone') !!}</td>
                                    <td>{{ @$update_request->user->phone }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if (in_array($update_request->update_type ,['car_data','personal_car_data']))
<section class="page-users-view">
    <div class=" col-12">
        <div class="divider divider-success">
            <div class="divider-text text-success font-medium-2">{!! trans('dashboard.general.images') !!}</div>
        </div>
        <div class="card border-info bg-transparent">
            <div class="card-body">
                <div class="row">
                    @if ($update_request->car_front_image)
                    <div class="col-md-4 col-6 user-latest-img">
                        <a href="{{ $update_request->car_front_image_asset }}" data-fancybox="gallery">
                            <img src="{{ $update_request->car_front_image_asset }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_front_image') !!}">
                        </a>
                    </div>
                    @endif
                    @if ($update_request->car_back_image)
                    <div class="col-md-4 col-6 user-latest-img">
                        <a href="{{ $update_request->car_back_image_asset }}" data-fancybox="gallery">
                            <img src="{{ $update_request->car_back_image_asset }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_back_image') !!}">
                        </a>
                    </div>
                    @endif
                    @if ($update_request->car_form_image)
                    <div class="col-md-4 col-6 user-latest-img">
                        <a href="{{ $update_request->car_form_image_asset }}" data-fancybox="gallery">
                            <img src="{{ $update_request->car_form_image_asset }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_form_image') !!}">
                        </a>
                    </div>
                    @endif
                    @if ($update_request->car_licence_image)
                    <div class="col-md-4 col-6 user-latest-img">
                        <a href="{{ $update_request->car_licence_image_asset }}" data-fancybox="gallery">
                            <img src="{{ $update_request->car_licence_image_asset }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_licence_image') !!}">
                        </a>
                    </div>
                    @endif
                    @if ($update_request->car_insurance_image)
                    <div class="col-md-4 col-6 user-latest-img">
                        <a href="{{ $update_request->car_insurance_image_asset }}" data-fancybox="gallery">
                            <img src="{{ $update_request->car_insurance_image_asset }}" class="img-fluid mb-1 rounded-sm" style="height:100px;" title="{!! trans('dashboard.car.car_insurance_image') !!}">
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>

@endif
@include('dashboard.update_request.refuse_modal')
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

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.driver.drivers') !!}</h5>
        <div class="header-elements">
            <div class="list-icons">
                @if ($driver_count)
                    <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="notify('all','{{ route('dashboard.notification.store') }}','driver')">
                        <i class="feather icon-bell"></i>
                        {{ trans('dashboard.notification.add_notification') }}
                    </a>
                @endif
                @if (!auth()->user()->hasPermissions('driver','search_about_single_user') || auth()->user()->user_type == 'superadmin')
                        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="convertDriversToAvailable()">
                            <i class="feather icon-bell"></i>
                            {{ trans('dashboard.driver.convert_unavailable_to_available') }}
                        </a>

                        @if ($driver_count && auth()->user()->hasPermissions('driver','wallet'))
                        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="addBalanceToAll('driver')">
                            <i class="feather icon-credit-card"></i>
                            {{ trans('dashboard.user.add_wallet') }}
                        </a>
                        @endif

                        {{-- <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="addTempBalanceToAll('driver')">
                            <i class="feather icon-credit-card"></i>
                            {{ trans('dashboard.user.add_temp_balance') }}
                        </a> --}}
                    @if (auth()->user()->hasPermissions('package','store') && auth()->user()->hasPermissions('package','update'))
                        @if (in_array(request('status') ,['not_available','monthly_drivers',null]) && $driver_count)
                            <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" data-toggle="modal" data-target="#package_subscribe_modal"><i class="feather icon-calendar mr-1"></i> {{ trans('dashboard.package.renew_package') }}</a>
                        @endif

                        @if (in_array(request('status') ,['on_order_drivers']) && $driver_count)
                            <a class="btn btn-primary text-bold-700 text-white mr-1 mb-1" data-toggle="modal" data-target="#change_package_modal"><i class="feather icon-calendar mr-1"></i> {{ trans('dashboard.package.change_package') }}</a>
                        @endif
                        @endif
                        <a class="btn btn-success mr-1 text-white mb-1 text-bold-700 font-medium-1 waves-effect waves-light">
                            <i class="feather icon-truck"></i>
                            {!! trans('dashboard.driver.driver_count') !!} : {{ $driver_count }}
                        </a>


                        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.driver.create') }}">
                            <i class="feather icon-plus"></i>
                            {{ trans('dashboard.driver.add_driver') }}
                        </a>

                @endif
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (auth()->user()->hasPermissions('driver','search_about_single_user') && auth()->user()->user_type == 'admin')
          <div class="row">
              <div class="form-group col-12">
                  <div class="mt-2">
                      <select class="select2 form-control select-remote-driver-ajax" name="driver_id" style="width: 100%;" data-placeholder="{{ trans('dashboard.driver.select_driver') }}">
                      </select>
                  </div>
              </div>
          </div>
      @elseif (!auth()->user()->hasPermissions('driver','search_about_single_user') || auth()->user()->user_type == 'superadmin')
        <div class="table-responsive">
            <table class="table table-bordered datatable-new-ajax table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>
                            <div class="vs-checkbox-con vs-checkbox-primary">
                                <input type="checkbox" class="select_all_rows" value="${data.id}" onclick="toggle(this)"/>
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                </span>
                            </div>
                        </th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.phone') !!}</th>
                        <th>{!! trans('dashboard.user.identity_number') !!}</th>
                        <th>{!! trans('dashboard.user.wallet') !!}</th>
                        <th>{!! trans('dashboard.order.finished_order_count') !!}</th>
                        @if (request('status') == 'drivers_cancelled_orders')
                            <th>{!! trans('dashboard.order.driver_cancel_order_count') !!}</th>
                        @endif
                        <th>{!! trans('dashboard.car.car') !!}</th>
                        @if (auth()->user()->hasPermissions('driver','admin_accept_driver'))
                        <th>{!! trans('dashboard.driver.admin_accept_status') !!}</th>
                        @endif
                        <th>{!! trans('dashboard.driver.driver_type') !!}</th>
                        <th>{!! trans('dashboard.driver.package_type') !!}</th>
                        <th>{!! trans('dashboard.driver.elm.elm_platform') !!}</th>
                        <th>{!! trans('dashboard.driver.end_subscribe_at') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th><i class="feather icon-zap"></i></th>
                    </tr>
                </thead>
                <tbody class="text-center">

                </tbody>
            </table>
        </div>
      @endif
    </div>
</div>
@include('dashboard.driver.all_drivers_subscribe_modal')
@include('dashboard.driver.refuse_driver_data_modal')
@include('dashboard.driver.change_package_modal')
@include('dashboard.driver.ajax.temp_wallet')
@include('dashboard.layout.delete_modal')
@include('dashboard.layout.notify_modal')
@include('dashboard.driver.ajax.wallet')
@endsection
@section('vendor_styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

<style media="screen">
    .toggle-switch .custom-control-label:before {
        background-color: #666b81 !important;
    }
</style>
@endsection
@include('dashboard.driver.scripts')

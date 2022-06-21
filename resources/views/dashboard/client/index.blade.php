@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.client.clients') !!}</h5>
        <div class="header-elements">
            <div class="list-icons">
            @if ($client_count)
                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="notify('all','{{ route('dashboard.notification.store') }}','client')">
                    <i class="feather icon-bell"></i>
                    {{ trans('dashboard.notification.add_notification') }}
                </a>
            @endif
            @if (!auth()->user()->hasPermissions('client','search_about_single_user') || auth()->user()->user_type == 'superadmin')
                @if ($client_count && auth()->user()->hasPermissions('client','wallet'))
                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="addBalanceToAll('client')">
                    <i class="feather icon-credit-card"></i>
                    {{ trans('dashboard.user.add_wallet') }}
                </a>

                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="addTempBalanceToAll('client')">
                    <i class="feather icon-credit-card"></i>
                    {{ trans('dashboard.user.add_temp_balance') }}
                </a>

                <a class="btn btn-warning mr-1 mb-1 waves-effect waves-light text-white" onclick="setWalletZero('all','client')">
                    <i class="feather icon-credit-card"></i>
                    {{ trans('dashboard.user.set_wallet_zero') }}
                </a>
                @endif

                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.client.create') }}">
                    <i class="feather icon-plus"></i>
                    {{ trans('dashboard.client.add_client') }}
                </a>

        @endif
            </div>
        </div>
    </div>

    <div class="card-body">
      @if (auth()->user()->hasPermissions('client','search_about_single_user') && auth()->user()->user_type == 'admin')
        <div class="row">
            <div class="form-group col-12">
                <div class="mt-2">
                    <select class="select2 form-control select-remote-client-ajax" name="client_id" style="width: 100%;" data-placeholder="{{ trans('dashboard.client.select_client') }}">
                    </select>
                </div>
            </div>
        </div>
    @elseif (!auth()->user()->hasPermissions('client','search_about_single_user') || auth()->user()->user_type == 'superadmin')
        <div class="table-responsive">
            <table class="table table-bordered datatable-new-ajax table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>
                            <div class="vs-checkbox-con vs-checkbox-primary justify-content-right">
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
                        <th>{!! trans('dashboard.general.email') !!}</th>
                        <th>{!! trans('dashboard.general.phone') !!}</th>
                        <th>{!! trans('dashboard.order.finished_order_count') !!}</th>
                        <th>{!! trans('dashboard.user.wallet') !!}</th>
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
@include('dashboard.layout.delete_modal')
@include('dashboard.layout.notify_modal')
@include('dashboard.client.ajax.temp_wallet')
@include('dashboard.client.ajax.wallet')
@include('dashboard.client.ajax.zero_wallet')
@endsection

@section('vendor_styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css"> --}}
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/custom/datetimepicker.css" />
@endsection
@include('dashboard.client.scripts')

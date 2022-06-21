@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.ambassador.'.request('user_type').'_ambassadors') !!}</h5>

        <div class="header-elements">
            <div class="list-icons">
                @if ($user_count)
                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="notify('all','{{ route('dashboard.notification.store') }}','{{ request('user_type') }}')">
                    <i class="feather icon-bell"></i>
                    {{ trans('dashboard.notification.add_notification') }}
                </a>
                @endif


            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered datatable-new-ajax table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.email') !!}</th>
                        <th>{!! trans('dashboard.general.phone') !!}</th>
                        <th>{!! trans('dashboard.user.referral_code') !!}</th>
                        <th>{!! trans('dashboard.user.referral_code_count') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th><i class="feather icon-zap"></i></th>
                    </tr>
                </thead>
                <tbody class="text-center">

                </tbody>
            </table>
        </div>
    </div>
</div>
@include('dashboard.layout.notify_modal')
@endsection

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@include('dashboard.ambassador.scripts')

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info text-center bg-transparent">
    <div class="card-content">
        <img src="{{ $lucky_box->image }}" alt="{{ $lucky_box->name }}" width="150" class="float-left mt-1 mb-1 pl-2 img-fluid">
        <div class="card-body">
            <h4 class="card-title mt-3">{{ $lucky_box->name }}</h4>
            <p class="card-text">{{ $lucky_box->offer }}</p>
        </div>
    </div>
</div>
<div class="card border-info text-center bg-transparent">
    <div class="card-content">
        <div class="card-body">
            @include('dashboard.lucky_box.show_filter')
        </div>
    </div>
</div>
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! $lucky_box->name !!}</h5>
        {{-- <div class="header-elements">
            <div class="list-icons">
                @if ($user_count)
                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light text-white" onclick="notify('all','{{ route('dashboard.notification.store') }}','{{ request('user_type') }}')">
                    <i class="feather icon-bell"></i>
                    {{ trans('dashboard.notification.add_notification') }}
                </a>
                @endif
            </div>
        </div> --}}
    </div>

    <div class="card-body">
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
                        <th>{!! trans('dashboard.user.wallet') !!}</th>
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
@include('dashboard.lucky_box.show_scripts')

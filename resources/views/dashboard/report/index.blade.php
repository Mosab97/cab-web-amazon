@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.report.reports') !!}</h5>

    </div>
    <div class="card-body">

        <div class="divider divider-success">
            <div class="divider-text"><i class="feather icon-calendar"></i></div>
        </div>

        @include('dashboard.report.filter')

        @includeWhen(request('custom_date_type') == 'month_year' || request('get_date') == 'this_month', 'dashboard.report.include.month_report')
        @includeWhen(request('custom_date_type') == 'year', 'dashboard.report.include.year_report')
        @includeWhen(request('custom_date_type') == 'day_month_year' || in_array(request('get_date'),['today','yesterday']), 'dashboard.report.include.daily_report')
        @includeWhen(request('get_date') == 'this_week', 'dashboard.report.include.week_report')
    </div>
</div>
@endsection

@include('dashboard.report.scripts')

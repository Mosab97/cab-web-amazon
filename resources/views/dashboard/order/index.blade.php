@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.order.orders') !!}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="btn btn-success mr-1 text-white mb-1 text-bold-700 font-medium-1 waves-effect waves-light">
                    <i class="feather icon-shopping-cart"></i>
                    {!! trans('dashboard.order.order_count') !!} : {{ $order_count }}
                </a>
                <a class="btn btn-primary mr-1 text-white mb-1 text-bold-700 font-medium-1 waves-effect waves-light">
                    <i class="feather icon-credit-card"></i>
                    {!! trans('dashboard.user.app_commission') !!} : {{ $app_commission }}
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row pb-4">
            <div class="col-lg-12">

                <div id="order_chart" style="height: 450px;"></div>

            </div>
        </div>

        <div class="divider divider-success">
            <div class="divider-text"><i class="feather icon-calendar"></i></div>
        </div>

        @include('dashboard.order.filter')

        <div class="table-responsive">
            <table class="table table-bordered datatable-new-ajax table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.order.order_number') !!}</th>
                        <th>{!! trans('dashboard.client.client') !!}</th>
                        <th>{!! trans('dashboard.driver.driver') !!}</th>
                        <th>{!! trans('dashboard.order.order_type') !!}</th>
                        <th>{!! trans('dashboard.order.order_status') !!}</th>
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
@endsection

@include('dashboard.order.scripts')

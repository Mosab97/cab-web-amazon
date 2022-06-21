@extends('dashboard.layout.layout')

@section('content')
<div id="user-profile">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2 border-info rounded">
                <div class="relative">
                    <div class="cover-container">
                        <img class="img-fluid bg-cover rounded-top w-100" src="{{ asset('dashboardAssets') }}/images/banner/banner-9.jpg" alt="{{ $client->fullname }}" style="height:300px; width:100%;">
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <div class="avatar">
                            <a href="{{ $client->avatar }}" data-fancybox="gallery">
                                <img src="{{ $client->avatar }}" class="rounded-circle img-border box-shadow-1" alt="{{ $client->fullname }}">
                                <span class="avatar-status-busy avatar-status-lg" id="online_{{ $client->id }}"></span>
                            </a>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('dashboard.client.edit',$client->id) }}" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                                <i class="feather icon-edit-2"></i>
                            </a>
                            <a href="javascript::void(0)" class="btn btn-icon btn-icon rounded-circle btn-danger" onclick="notify('{{ $client->id }}','{{ route('dashboard.notification.store') }}','client')">
                                <i class="feather icon-bell"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center profile-header-nav rounded-bottom">
                    <nav class="navbar navbar-expand-sm w-100 pr-5 mr-5 ml-1">
                        <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="feather icon-align-justify"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav nav-tabs justify-content-right w-75 ml-sm-auto" role="tablist">
                                <li class="nav-item px-sm-0">
                                    <a href="#profile" data-toggle="tab" id="profile-tab" aria-controls="profile" class="nav-link font-small-3 active" aria-selected="true">
                                        <i class="feather icon-user font-small-3"></i>
                                        {!! trans('dashboard.user.profile') !!}
                                    </a>

                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#orders" data-toggle="tab" id="orders-tab" aria-controls="orders" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-shopping-cart font-small-3"></i>
                                        {!! trans('dashboard.order.orders') !!}

                                    </a>
                                </li>

                                <li class="nav-item px-sm-0">
                                    <a href="#health" data-toggle="tab" id="health-tab" aria-controls="health" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-heart font-small-3"></i>
                                        {!! trans('dashboard.user.health_status') !!}

                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#financial" data-toggle="tab" id="financial-tab" aria-controls="financial" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-dollar-sign font-small-3"></i>
                                        {!! trans('dashboard.user.financial_record') !!}
                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#wallet_transfers" data-toggle="tab" id="wallet-tab" aria-controls="wallet_transfers" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-repeat font-small-3"></i>
                                        {!! trans('dashboard.wallet_transfer.wallet_transfers') !!}
                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#points" data-toggle="tab" id="point-tab" aria-controls="points" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-hash font-small-3"></i>
                                        {!! trans('dashboard.point.points') !!}
                                    </a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#wallet_transactions" data-toggle="tab" id="wallet_transaction-tab" aria-controls="wallet_transactions" class="nav-link font-small-3" aria-selected="false">
                                        <i class="feather icon-credit-card font-small-3"></i>
                                        {!! trans('dashboard.wallet_transaction.wallet_transactions') !!}
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="profile-info" class="row">
        <!-- Basic datatable -->
        <div class="col-md-9">
            <div class="card border-info">

                <div class="card-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="profile" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.user.fullname') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->fullname }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.phone') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->phone }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.email') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->email }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-mail"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.point.point_count') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->points }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-hash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.added_date') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->created_at->format("Y-m-d") }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-calendar"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.general.added_time') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->created_at->format("h:i A") }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-clock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.country.country') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->country_name }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-flag"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.city.city') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->city_name }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-flag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.user.active_state') !!}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{!! $client->is_admin_active_user ? trans('dashboard.user.active') : trans('dashboard.user.not_active') !!}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-log-in"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.user.ban_state') !!}</label>
                                        <div class="col-md-4 position-relative has-icon-left">
                                            <input type="text" value="{!! $client->is_ban ? trans('dashboard.user.ban') : trans('dashboard.user.not_ban') !!}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-slash"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{!! trans('dashboard.user.ban_reason') !!}</label>
                                        <div class="col-md-10">
                                            {!! Form::textarea("", $client->is_ban ? $client->ban_reason : null, ['class' => 'form-control','readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="orders" aria-labelledby="orders-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $orders->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.order.order_number') !!}</th>
                                                    <th>{!! trans('dashboard.driver.driver') !!}</th>
                                                    <th>{!! trans('dashboard.order.pay_type') !!}</th>
                                                    <th>{!! trans('dashboard.order.order_type') !!}</th>
                                                    <th>{!! trans('dashboard.order.order_status') !!}</th>
                                                    <th>{!! trans('dashboard.order.total_price') !!}</th>
                                                    <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                    <th><i class="feather icon-zap"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr class="{{ $order->id }} text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ optional($order->driver)->fullname }}</td>
                                                    <td>{{ trans('dashboard.order.pay_types.'.$order->pay_type) }}</td>
                                                    <td>{{ trans('dashboard.order.order_types.'.$order->order_type) }}</td>
                                                    <td>
                                                        {!! trans('dashboard.order.statuses.'.$order->order_status) !!}
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-success badge-md mr-1 mb-1">{{ $order->total_price }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-violet badge-md mr-1 mb-1">{{ $order->created_at->format("Y-m-d") }}</div>
                                                    </td>
                                                    <td class="product-action text-center font-medium-3">
                                                        <a href="{!! route('dashboard.order.show',$order->id) !!}" class="text-primary mr-2">
                                                            <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $orders->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="health" aria-labelledby="health-tab">
                            <div class="card border-info">
                                <div class="card-header">
                                    <div class="card-title">{{ trans('dashboard.user.health_status') }}</div>

                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2">{{ trans('dashboard.user.is_infected') }}</label>
                                        <div class="col-md-3 position-relative has-icon-left">
                                            <input type="text" value="{{ $client->is_infected ? trans('dashboard.user.infected') : trans('dashboard.user.not_infected') }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-heart"></i>
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-3">{{ trans('dashboard.user.is_with_special_needs') }}</label>
                                        <div class="col-md-4 position-relative has-icon-left" id="health_status">
                                            <input type="text" name="is_with_special_needs" value="{{ $client->is_with_special_needs ? trans('dashboard.user.with_special_needs') : trans('dashboard.user.not_with_special_needs') }}" class="form-control" readonly>
                                            <div class="form-control-position">
                                                <i class="feather icon-help-circle"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>{!! trans('dashboard.user.admin_accept_health_status') !!}</p>

                                        </div>
                                        <div class="col-md-8 mb-1">
                                            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                                                <button onclick="acceptDriverHealthData('{{ $client->id }}')" {{  $client->is_with_special_needs ? 'disabled' : null }}
                                                    class="btn btn-primary font-small-3 text-bold-600 accept_health_btn_{{ $client->id }}">{{ trans('dashboard.driver.accept_data') }}</button>
                                                <button onclick="openRefuseDriverHealthData('{{ $client->id }}')" {{ !  $client->is_with_special_needs ? 'disabled' : null }}
                                                    class="btn btn-danger font-small-3 text-bold-600 refuse_health_btn_{{ $client->id }}">{{ trans('dashboard.driver.refuse_data') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            @if ($client->health_certificate_type == 'image')
                                                <a href="{{ $client->health_certificate }}" data-fancybox="gallery">
                                                    <img src="{{ $client->health_certificate }}" alt="" style="width:400px; height:300px;" class="img-preview rounded">
                                                </a>
                                            @elseif ($client->health_certificate_type == 'file')
                                                <object data="{{ $client->health_certificate }}" type="application/pdf" width="300" height="200">
                                                    <a href="{{ $client->health_certificate }}">{{ str_after($client->health_certificate,'___file_') }}</a>
                                                </object>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="financial" aria-labelledby="financial-tab">
                            <div class="card border-info">
                                <div class="card-header">
                                    <div class="card-title">
                                        {{ trans('dashboard.user.financial_record') }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <table>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.finished_orders',['count' => $finished_orders->count(),'total_price' => $finished_orders->sum('total_price')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.cash_finished_orders', ['count' => $finished_orders->where('pay_type','cash')->count(), 'total_price' => $finished_orders->where('pay_type','cash')->sum('total_price')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.wallet_finished_orders', ['count' => $finished_orders->where('pay_type','wallet')->count(), 'total_price' => $finished_orders->where('pay_type','wallet')->sum('total_price')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.balance_lucky_box', ['count' => $client->luckyBoxes->where('gift_type','balance')->count(), 'total_price' => $client->luckyBoxes()->where('gift_type','balance')->sum('balance')]) !!}
                                                </tr>

                                            </table>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <table>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.points_lucky_box', ['count' => $client->luckyBoxes->where('gift_type','points')->count(), 'total_price' => $client->luckyBoxes()->where('gift_type','points')->sum('points')]) !!}
                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.balance_withdrawal', [
                                                        'count' => $client->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->count(),
                                                        'total_price' => $client->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->transfered()->sum('amount')]) !!}

                                                </tr>
                                                <tr>
                                                    {!! trans('dashboard.financial_record.balance_point_package', [
                                                        'count' => $client->walletTransactions()->where(['transaction_type' => 'charge', 'app_typeable_type' => 'App\Models\PointPackage'])->count(),
                                                        'total_price' => $client->walletTransactions()->where(['transaction_type' => 'charge', 'app_typeable_type' => 'App\Models\PointPackage'])->sum('amount')]) !!}

                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="wallet_transfers" aria-labelledby="wallet_transfers-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transfers->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.trans_num') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.transfer_from') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.transfer_to') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.amount') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.wallet_before_transfer') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.wallet_after_transfer') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transfer.transfer_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($wallet_transfers as $wallet_transfer)
                                                    <tr class="{{ $wallet_transfer->id }} text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $wallet_transfer->id }}</td>
                                                        <td>
                                                            @if ($wallet_transfer->transfer_from_id != $client->id)
                                                                <a href="{{ route('dashboard.'.optional($wallet_transfer->transferFrom)->user_type.'.show',$wallet_transfer->transfer_from_id) }}">
                                                                    {{ optional($wallet_transfer->transferFrom)->fullname }}
                                                                </a>
                                                            @else
                                                                {{ optional($wallet_transfer->transferFrom)->fullname }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($wallet_transfer->transfer_to_id != $client->id)
                                                                <a href="{{ route('dashboard.'.optional($wallet_transfer->transferTo)->user_type.'.show',$wallet_transfer->transfer_to_id) }}">
                                                                    {{ optional($wallet_transfer->transferTo)->fullname }}
                                                                </a>
                                                            @else
                                                                {{ optional($wallet_transfer->transferTo)->fullname }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-info text-bold-700 badge-md mr-1 mb-1">{{ $wallet_transfer->amount }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transfer->wallet_before }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transfer->wallet_after }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ optional($wallet_transfer->created_at)->format("Y-m-d") }}</div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transfers->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="points" aria-labelledby="points-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $points->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.point.creator') !!}</th>
                                                    <th>{!! trans('dashboard.point.amount') !!}</th>
                                                    <th>{!! trans('dashboard.point.points') !!}</th>
                                                    <th>{!! trans('dashboard.point.point_status') !!}</th>
                                                    <th>{!! trans('dashboard.point.used_status') !!}</th>
                                                    <th>{!! trans('dashboard.point.used_type') !!}</th>
                                                    <th>{!! trans('dashboard.general.added_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($points as $point)
                                                    <tr class="{{ $point->id }} text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ optional($point->creator)->fullname }}
                                                        </td>

                                                        <td>
                                                            {{ $point->amount }}
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md text-bold-700 text-white mr-1 mb-1">{{ $point->points }}</div>
                                                        </td>
                                                        <td>
                                                            {{ trans('dashboard.point.point_statuses.'.$point->status) }}
                                                        </td>
                                                        <td>
                                                            {{ trans('dashboard.point.used_statuses.'.$point->is_used) }}
                                                        </td>
                                                        <td>
                                                            {{ trans('dashboard.point.reasons.'.$point->reason) }}
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $point->created_at->format("Y-m-d") }}</div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $points->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="wallet_transactions" aria-labelledby="wallet_transfers-tab">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transactions->links() !!}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transaction_number') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transfer_to') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transfer_from') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transaction_type') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.amount') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.wallet_before') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.wallet_after') !!}</th>
                                                    <th>{!! trans('dashboard.wallet_transaction.transaction_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($wallet_transactions as $wallet_transaction)
                                                    <tr class="{{ $wallet_transaction->id }} text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $wallet_transaction->id }}</td>
                                                        <td>
                                                            @if ($wallet_transaction->user_id != $client->id && !in_array($wallet_transaction->user->user_type ,['admin','superadmin']))
                                                                <a href="{{ route('dashboard.'.$wallet_transaction->user->user_type.'.show',$wallet_transaction->user_id) }}">
                                                                    {{ optional($wallet_transaction->user)->fullname }}
                                                                </a>
                                                            @else
                                                                {{ optional($wallet_transaction->user)->fullname }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($wallet_transaction->added_by_id != $client->id && !in_array(@$wallet_transaction->addedBy->user_type ,['admin','superadmin',null]))
                                                                <a href="{{ route('dashboard.'.$wallet_transaction->addedBy->user_type.'.show',$wallet_transaction->added_by_id) }}">
                                                                    {{ optional($wallet_transaction->addedBy)->fullname }}
                                                                </a>
                                                            @else
                                                                {{ optional($wallet_transaction->addedBy)->fullname ?? trans('dashboard.wallet_transaction.system') }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="badge {{ $wallet_transaction->transaction_type == 'withdrawal' ? 'badge-danger' : 'badge-info' }} text-bold-700 badge-md mr-1 mb-1">
                                                                {{ trans('dashboard.wallet_transaction.transaction_types.'.$wallet_transaction->transaction_type) }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-info text-bold-700 badge-md mr-1 mb-1">{{ $wallet_transaction->amount }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transaction->wallet_before }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $wallet_transaction->wallet_after }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ optional($wallet_transaction->created_at)->format("Y-m-d") }}</div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $wallet_transactions->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">

                <div class="card border-info">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('dashboard.user.wallet') !!}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-12">
                            <label>
                                {{ trans('dashboard.user.user_dept_to_app') }}
                            </label>
                            <div class="position-relative has-icon-left input-group form-group">
                                {!! Form::text("user_dept_to_app", $client->user_dept_to_app , ['class'=>"form-control form-control-sm user_dept_to_app",'aria-describedby' => "button-addon1" ,'placeholder'=>trans('dashboard.user.user_dept_to_app')]) !!}
                                <div class="form-control-position">
                                    <i class="feather icon-dollar-sign pt-3 text-primary"></i>
                                </div>
                                @if (auth()->user()->hasPermissions('client','wallet'))
                                <div class="input-group-append" id="button-addon1">
                                    <a href="javascript:void(0)" onclick="updateUserDept('{{ $client->id }}')" class="btn btn-primary btn-sm btn_change_dept d-flex align-items-center"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-12">
                            <label>
                                {{ trans('dashboard.user.wallet_value') }}
                            </label>
                            <div class="position-relative has-icon-left input-group form-group">
                                {!! Form::text("wallet", $client->wallet , ['class'=>"form-control form-control-sm user_wallet",'aria-describedby' => "button-addon2" ,'placeholder'=>trans('dashboard.user.wallet_value')]) !!}
                                <div class="form-control-position">
                                    <i class="feather icon-credit-card pt-3 text-primary"></i>
                                </div>
                                @if (auth()->user()->hasPermissions('client','wallet'))
                                <div class="input-group-append" id="button-addon2">
                                    <a href="javascript:void(0)" onclick="updateUserWallet('{{ $client->id }}')" class="btn btn-primary btn-sm btn_change_wallet d-flex align-items-center"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent comments -->
            <div class="card border-info">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="card-title font-weight-semibold">{!! trans('dashboard.client.other_clients') !!}</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="media-list media-bordered">
                        @forelse ($other_clients as $other_client)
                        <div class="media">
                            <a class="media-left" href="{!! route('dashboard.client.show',$other_client->id) !!}">
                                <div class="avatar">
                                    <img class="rounded-circle" src="{{ $other_client->avatar }}" alt="{{ $other_client->fullname }}" height="40" width="40">
                                    <span class="avatar-status-busy avatar-status-md" id="online_{{ $other_client->id }}"></span>
                                </div>
                            </a>
                            <div class="media-body text-left font-small-1">
                                <h5 class="media-heading">{{ $other_client->fullname }}</h5>
                                {{ $other_client->phone }}
                            </div>

                        </div>

                        @empty
                        <div class="media font-weight-semibold border-0 py-2 justify-content-center">{!! trans('dashboard.client.no_clients') !!}</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- /recent comments -->
    </section>

</div>

@include('dashboard.client.refuse_health_data_modal')
@include('dashboard.layout.notify_modal')
@endsection
@section('vendor_styles')

<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">

@endsection
@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/users.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/data-list-view.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/knowledge-base.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>

@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/user-profile.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/navs/navs.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/faq-kb.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>

// Health Status
    function acceptDriverHealthData(client_id) {
        var accept_btn = $('.accept_health_btn_' + client_id);
        var refuse_btn = $('.refuse_health_btn_' + client_id);
        var input_text = $('#health_status input[name=is_with_special_needs]');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/user_health_status_data') }}/" + client_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                } else {
                    toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                }
                input_text.val(data.text);
                accept_btn.attr('disabled', data.accept_btn);
                refuse_btn.attr('disabled', data.refuse_btn);
            }
        });
    }



    function openRefuseDriverHealthData(client_id) {
        var client_id = $('#refuse_health_reason_modal input[name=client_id]').val(client_id);
        $('#refuse_health_data_modal').modal('show');
    }

    function refuseUserHealthStatus() {
        var client_id = $('#refuse_health_reason_modal input[name=client_id]').val();
        var refuse_reason = $('#refuse_health_reason_modal textarea[name=refuse_health_reason]');
        var refuse_reason_val = refuse_reason.val();
        var accept_btn = $('.accept_health_btn_' + client_id);
        var refuse_btn = $('.refuse_health_btn_' + client_id);
        var input_text = $('#health_status input[name=is_with_special_needs]');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/user_health_status_data') }}/" + client_id,
            method: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}',
                refuse_reason: refuse_reason_val
            },
            success: function(data) {
                if (data['value'] == 1) {
                    toastr.success('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                } else {
                    toastr.danger('{{ trans('dashboard.messages.success_update') }}', '', {
                            "progressBar": true
                        });
                }
                $('#refuse_health_data_modal').modal('hide');
                input_text.val(data.text);
                accept_btn.attr('disabled', data.accept_btn);
                refuse_btn.attr('disabled', data.refuse_btn);
                refuse_reason.val('')
            }
        });
    }

    function updateUserWallet(userId) {
        var wallet = $('.user_wallet').val();
        var btn = $('.btn_change_wallet');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/update_user_wallet') }}/" + userId,
            method: "POST",
            dataType: "json",
            global: false,
            data: {
                wallet: wallet,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function(xhr) {
                btn.html('<div class="spinner-border text-success spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');
            },
            success: function(data) {
                if (data['value'] == 1) {
                    btn.html('<i class="feather icon-refresh-cw"></i>');
                    toastr.success(data['message'], '', {
                        "progressBar": true
                    });
                } else {
                    btn.html('<i class="feather icon-refresh-cw"></i>');
                    toastr.danger(data['message'], '', {
                        "progressBar": true
                    });
                }
            }
        }).fail(function(data) {
            btn.html('<i class="feather icon-refresh-cw"></i>');
            $.each(data.responseJSON.errors, function(index, val) {
                toastr.error(val, '', {
                    "progressBar": true
                });
            });
        });
    }

    function updateUserDept(userId) {
        var dept = $('.user_dept_to_app').val();
        var btn = $('.btn_change_dept');
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/update_user_dept') }}/" + userId,
            method: "POST",
            dataType: "json",
            global: false,
            data: {
                dept: dept,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function(xhr) {
                btn.html('<div class="spinner-border text-success spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');
            },
            success: function(data) {
                if (data['value'] == 1) {
                    btn.html('<i class="feather icon-refresh-cw"></i>');
                    toastr.success(data['message'], '', {
                        "progressBar": true
                    });
                } else {
                    btn.html('<i class="feather icon-refresh-cw"></i>');
                    toastr.danger(data['message'], '', {
                        "progressBar": true
                    });
                }
            }
        }).fail(function(data) {
            btn.html('<i class="feather icon-refresh-cw"></i>');
            $.each(data.responseJSON.errors, function(index, val) {
                toastr.error(val, '', {
                    "progressBar": true
                });
            });
        });
    }
</script>
@endsection

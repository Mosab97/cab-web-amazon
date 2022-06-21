@extends('dashboard.layout.layout')
{{-- @section('body','content-left-sidebar chat-application')
@section('body_col','content-left-sidebar') --}}
@section('content')


<!-- Basic initialization -->
<div class="card border-info">
    <div class="card-header pb-1">
        <h5 class="card-title">
            {{ trans('dashboard.order.order_number') }} : {{ $order->id }}
        </h5>
        <div class="heading-elements">
            <div class="badge badge-primary block badge-md mr-1 mb-1">
                {{ trans('dashboard.order.expected_time') }} : {{ number_format($order->expected_time/60,2) }} {!! trans('dashboard.dates.minute') !!}
            </div>
            <div class="badge badge-success block badge-md mr-1 mb-1">
                {{ trans('dashboard.order.actual_time') }} : {{ number_format(($order->actual_time ?? $order->expected_time/60) ,2) }} {!! trans('dashboard.dates.minute') !!}
            </div>
        </div>
    </div>
    <div class="card-body ">
        <div class="list-feed">
            <div class="list-feed-item border-info-400">
                {{ trans('dashboard.order.start_location') }} : {{ $order->start_location_data['location'] }}
            </div>

            <div class="list-feed-item border-success-400">
                {{ trans('dashboard.order.arrive_location') }} : {{ $order->end_location_data['location'] }}
            </div>

            <div class="list-feed-item border-success-400">
                {{ trans('dashboard.order.distance') }} : {{ number_format($order->distance/1000,2) }} {!! trans('dashboard.distances.km') !!}
            </div>
            <div class="list-feed-item border-success-400">
                {{ trans('dashboard.order.pay_type') }} : {{ trans('dashboard.order.pay_types.'.$order->pay_type) }}
            </div>
            <div class="list-feed-item border-success-400">
                {{ trans('dashboard.order.order_type') }} : {{ trans('dashboard.order.order_types.'.$order->order_type) }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card border-info bg-transparent">
            <div class="card-content">
                <div class="card-body">
                    <div id="map" class="height-400"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card border-info bg-transparent">
            <div class="card-header pb-1 d-flex justify-content-between align-center">
                <h6 class="panel-title">{{ trans('dashboard.client.client') }}</h6>
                <div class="float-right">

                    <a href="{{ route('dashboard.client.edit',$order->client_id) }}" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                        <i class="feather icon-edit-2"></i>
                    </a>
                    <a href="{{ route('dashboard.client.show',$order->client_id) }}" class="btn btn-icon btn-icon rounded-circle btn-success mr-1">
                        <i class="feather icon-airplay"></i>
                    </a>
                </div>
            </div>
            <div class="card-body d-flex">
                <div>
                    <a href="#">
                        <img src="{{ asset(optional($order->client)->avatar) }}" style="width: 80px; height: 80px;" class="img-square" alt="">
                    </a>
                </div>
                <div class="ml-2">
                    <p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-user text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3">{{ optional($order->client)->fullname }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-phone text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3">{{ optional($order->client)->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-shopping-cart text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3">{!! trans('dashboard.order.order_count') !!} : {{ $order->client->clientOrders->count() }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-info bg-transparent">
            <div class="card-header pb-1 d-flex justify-content-between align-center">
                <h6 class="panel-title">{{ trans('dashboard.driver.driver') }}</h6>
                @if ($order->driver_id)
                <div class="float-right driver_card_link">

                    <a href="{{ route('dashboard.driver.edit',$order->driver_id) }}" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                        <i class="feather icon-edit-2"></i>
                    </a>
                    <a href="{{ route('dashboard.driver.show',$order->driver_id) }}" class="btn btn-icon btn-icon rounded-circle btn-success mr-1">
                        <i class="feather icon-airplay"></i>
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body d-flex driver_card_data">
                @if ($order->driver_id)
                <div>
                    <a href="{!! route('dashboard.driver.show',$order->driver_id) !!}">
                        <img src="{{ optional($order->driver)->avatar }}" style="width: 80px; height: 80px;" class="img-square" alt="">
                    </a>
                </div>
                <div class="ml-2">

                    <p>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-target text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3"> {{ optional($order->driver)->fullname }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="chip chip-success mr-1">
                                    <div class="chip-body">
                                        <div class="avatar">
                                            <i class="feather icon-phone text-bold font-small-3"></i>
                                        </div>
                                        <span class="chip-text text-white text-bold font-small-3"> {{ optional($order->driver)->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="chip chip-success mr-1">
                                <div class="chip-body">
                                    <div class="avatar">
                                        <i class="feather icon-flag text-bold font-small-3"></i>
                                    </div>
                                    <span class="chip-text text-white text-bold font-small-3">{!! trans('dashboard.order.order_count') !!} : {{ $order->driver->driverOrders->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </p>
                </div>
                @else
                <div class="col-md-12">
                    <div class="alert alert-info alert-styled-left alert-dismissible text-center">
                        {{ trans('dashboard.driver.no_drivers') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-9">
        <div class="card border-info bg-transparent">
            <div class="card-header pb-1 header-elements-inline">
                <h6 class="card-title">{!! trans('dashboard.order.order_detail') !!}</h6>
                <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                    <li class="nav-item"><a href="#bill" class="nav-link active" data-toggle="tab">{!! trans('dashboard.order.bill') !!}</a></li>
                    <li class="nav-item"><a href="#notified" class="nav-link " data-toggle="tab">{!! trans('dashboard.order.notified_drivers') !!} <span class="badge badge-pill badge-danger font-small-2 badge-sm">{{ $order->driverNotifiedOrders->count() }}</span></a></li>
                    <li class="nav-item"><a href="#offer" class="nav-link " data-toggle="tab">{!! trans('dashboard.order.offers') !!} <span class="badge badge-pill badge-danger font-small-2 badge-sm">{{ $offers->count() }}</span></a></li>
                    <li class="nav-item"><a href="#chat" class="nav-link" data-toggle="tab">{!! trans('dashboard.chat.chats') !!}</a></li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div id="notified" class="tab-pane fade">
                        <div class="card border-info text-center bg-transparent">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <div class="row" style="overflow-y: scroll;height: 500px;">
                                        @forelse ($order->driverNotifiedOrders as $notified)
                                        <div class="col-md-6 col-sm-12 profile-card-2">
                                            <div class="card" style="height: 329.188px;">
                                                <div class="card-header mx-auto pb-0">
                                                    <div class="row m-0">
                                                        <div class="col-sm-12 text-center">
                                                            <h4>{{ $notified->fullname }}</h4>
                                                        </div>
                                                        <div class="col-sm-12 text-center">
                                                            <p class=""><a href="tel:{{ $notified->phone }}">{{ $notified->phone }}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body text-center mx-auto">
                                                        <div class="avatar avatar-xl">
                                                            <a href="{!! $notified->id ? route('dashboard.driver.show',$notified->id) : '#' !!}">
                                                                <img class="img-fluid" src="{{ $notified->avatar }}" alt="{{ $notified->fullname }}">
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <div class="uploads">
                                                                <p class="font-weight-bold font-medium-2 mb-0">{{ optional(@$notified->driverOrders)->count() }}</p>
                                                                <span class="">{{ trans('dashboard.order.order_count') }}</span>
                                                            </div>
                                                            <div class="following">
                                                                <p class="font-weight-bold font-medium-2 mb-0">(<i class="feather icon-star text-warning mr-50"></i> {{ $notified->rate_avg }})</p>
                                                                <span class="">{!! trans('dashboard.user.rating') !!}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty

                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-styled-left alert-dismissible">
                                                {{ trans('dashboard.order.no_notified_drivers') }}
                                            </div>

                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="offer" class="tab-pane fade">
                        <div class="card border-info text-center bg-transparent">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <div class="row">
                                        @forelse ($offers as $offer)
                                        <div class="col-md-6 col-sm-12 profile-card-2">
                                            <div class="card" style="height: 329.188px;">
                                                <div class="card-header mx-auto pb-0">
                                                    <div class="row m-0">
                                                        <div class="col-sm-12 text-center">
                                                            <h4>{{ optional($offer->driver)->fullname }}</h4>
                                                        </div>
                                                        <div class="col-sm-12 text-center">
                                                            <p class=""><a href="tel:{{ optional($offer->driver)->phone }}">{{ optional($offer->driver)->phone }}</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body text-center mx-auto">
                                                        <div class="avatar avatar-xl">
                                                            <a href="{!! $offer->driver_id ? route('dashboard.driver.show',$offer->driver_id) : '#' !!}">
                                                                <img class="img-fluid" src="{{ optional($offer->driver)->avatar }}" alt="{{ optional($offer->driver)->fullname }}">
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <div class="uploads">
                                                                <p class="font-weight-bold font-medium-2 mb-0">{{ $offer->offer_price }}</p>
                                                                <span class="">{!! trans('dashboard.offer.offer_price') !!}</span>
                                                            </div>
                                                            <div class="followers">
                                                                <p class="font-weight-bold font-medium-2 mb-0">{{ optional(@$offer->driver->driverOrders)->count() }}</p>
                                                                <span class="">{{ trans('dashboard.order.order_count') }}</span>
                                                            </div>
                                                            <div class="following">
                                                                <p class="font-weight-bold font-medium-2 mb-0">(<i class="feather icon-star text-warning mr-50"></i> {{ optional($offer->driver)->rate_avg }})</p>
                                                                <span class="">{!! trans('dashboard.user.rating') !!}</span>
                                                            </div>
                                                        </div>
                                                        <div class="badge badge-lg block {{ $offer->price_offer_status_css }} mt-3">
                                                            <span>
                                                                {!! trans('dashboard.offer.offer_statuses.'.$offer->price_offer_status) !!}
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty

                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-styled-left alert-dismissible">
                                                {{ trans('dashboard.order.no_offer_used') }}
                                            </div>

                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="chat" class="tab-pane fade">
                        <div class="card border-info text-center bg-transparent chat-application">

                            <div class="chat-app-window mt-1">
                                <div class="user-chats scrolled_div">
                                    <div class="chats chat_list">
                                        <div class="ajax-message-load text-center" style="display:none">
                                            <div class="spinner-border text-success" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        @forelse ($messages->reverse() as $message)
                                        @if ($message->created_at->format("Y-m-d") != $format )
                                        @php
                                        $format= $message->created_at->format("Y-m-d");
                                        @endphp
                                        <div class="divider">
                                            <div class="divider-text">{{ $format }}</div>
                                        </div>
                                        @endif

                                        @if ($message->sender_id != $order->client_id)
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{ $message->sender->avatar }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                @if ($message->message_type == 'image')
                                                <div class="chat-content-media">
                                                    <a href="{{ $message->message }}" data-fancybox="gallery">
                                                        <img src="{{ $message->message }}" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: left;margin-left: 18px;">
                                                    </a>
                                                </div>
                                            @elseif ($message->message_type == 'location')
                                                <div class="chat-content-media">
                                                    <a href="//www.google.com/maps/place/{{ $message->message }}" target="_blank">
                                                        <img src="{{ asset('dashboardAssets') }}/images/icons/chat_map.jpg" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: left;margin-left: 18px;">
                                                    </a>
                                                </div>
                                                @else
                                                <div class="chat-content">
                                                    <p style="font-size: 1.1em;">{!! $message->message !!}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="chat chat-left">
                                            <div class="chat-avatar mt-50">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{ $message->sender->avatar }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                @if ($message->message_type == 'image')
                                                <div class="chat-content-media">
                                                    <a href="{{ $message->message }}" data-fancybox="gallery">
                                                        <img src="{{ $message->message }}" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: right;margin-right: 18px;">
                                                    </a>
                                                </div>
                                            @elseif ($message->message_type == 'location')
                                                    <div class="chat-content-media">
                                                        <a href="//www.google.com/maps/place/{{ $message->message }}" target="_blank">
                                                            <img src="{{ asset('dashboardAssets') }}/images/icons/chat_map.jpg" class="img-thumbnail chat-image mb-2" alt="" style="width: auto;height: 120px;float: right;margin-right: 18px;">
                                                        </a>
                                                    </div>
                                                @else
                                                <div class="chat-content">
                                                    <p style="color: #0d4e79; font-size: 1.1em;">{!! $message->message !!}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        @empty
                                        <h3 class="d-flex justify-content-center no_message">
                                            {!! trans('dashboard.chat.no_messages') !!}
                                        </h3>
                                        @endforelse
                                        <div class="typing-part">
                                            <div class="chat chat-left whisper chat_sender_right d-none">
                                                <div class="chat-avatar">
                                                    <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                        {{-- <img src="{{ $client->avatar }}" alt="avatar" height="40" width="40"> --}}
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content">
                                                        <img src="{{ asset('dashboardAssets') }}/global/images/icons/typing.gif">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="chat whisper chat_sender_left d-none">
                                                <div class="chat-avatar">
                                                    <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                        {{-- <img src="{{ $chat->receiver_id == $client->id ? $chat->sender->avatar : $chat->receiver->avatar }}" alt="avatar" height="40" width="40"> --}}
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content">
                                                        <img src="{{ asset('dashboardAssets') }}/global/images/icons/typing.gif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="bill" class="tab-pane fade active show">
                        <!-- Invoice template -->

                        <div class="card border-info bg-transparent">
                            <div class="card-header pb-1 border-info bg-transparent header-elements-inline">
                                <h6 class="card-title mb-1">{!! trans('dashboard.order.invoice') !!}</h6>
                                <div class="header-elements mb-1">

                                    <button type="button" onclick="printDiv('print_invoice')" class="btn btn-primary mb-1 mb-md-0 ml-3"><i class="feather icon-printer mr-2"></i> {!! trans('dashboard.general.print') !!}</button>
                                </div>
                            </div>
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <div id="print_invoice">
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <div class="invoice-details mt-2">
                                                    <h6>{!! trans('dashboard.order.invoice_num',['number' => $order->id]) !!}.</h6>
                                                    <h6 class="mt-2">
                                                        {!! trans('dashboard.order.order_type') !!} :
                                                        <small>
                                                            {{ trans('dashboard.order.order_types.'.$order->order_type) }}
                                                        </small>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="invoice-details mt-2">
                                                    <h6 class="mt-2">
                                                        {!! trans('dashboard.order.order_date') !!} : <small>{{ $order->created_at->isoFormat("D MMMM , Y ( h:mm a )") }}</small>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Invoice Recipient Details -->
                                        <div id="invoice-customer-details" class="row pt-2">
                                            <div class="col-sm-6 col-12 text-left">
                                                <div class="recipient-info my-2">
                                                    <small>
                                                        {!! trans('dashboard.order.from_location') !!} : {{ $order->start_location_data['location'] }}
                                                    </small>
                                                </div>
                                                <h5>{!! trans('dashboard.client.client') !!} : <small>{{ optional($order->client)->fullname }}</small></h5>
                                                <div class="recipient-contact pb-2">
                                                    <p>
                                                        <i class="feather icon-mail"></i>
                                                        {{ optional($order->client)->email }}
                                                    </p>
                                                    <p>
                                                        <i class="feather icon-phone"></i>
                                                        {{ optional($order->client)->phone }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 text-left">
                                                <div class="company-info my-2">
                                                    <small>
                                                        {!! trans('dashboard.order.to_location') !!} : {{ $order->end_location_data['location'] }}
                                                    </small>
                                                </div>
                                                <h5>{{ trans('dashboard.driver.driver') }} : <small>{{ optional($order->driver)->fullname }}</small></h5>
                                                <div class="company-contact">
                                                    <p>
                                                        <i class="feather icon-mail"></i>
                                                        {{ optional($order->driver)->email }}
                                                    </p>
                                                    <p>
                                                        <i class="feather icon-phone"></i>
                                                        {{ optional($order->driver)->phone }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="invoice-total-details" class="invoice-total-table">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="text-muted">{!! trans('dashboard.setting.app_data') !!}:</span>
                                                    <div class="d-flex flex-wrap wmin-md-400">
                                                        <ul class="list list-unstyled mb-0">
                                                            <li>
                                                                <h5 class="my-2">
                                                                    {!! trans('dashboard.setting.project_name') !!} :
                                                                </h5>
                                                            </li>
                                                            <li>{!! trans('dashboard.general.email') !!}:</li>
                                                            <li>{!! trans('dashboard.social.facebook') !!}:</li>
                                                            <li>{!! trans('dashboard.social.twitter') !!}:</li>
                                                            <li>{!! trans('dashboard.social.instagram') !!}:</li>
                                                            <li>{!! trans('dashboard.setting.phone_numbers') !!}:</li>
                                                        </ul>

                                                        <ul class="list list-unstyled text-right mb-0 ml-auto">
                                                            <li>
                                                                <h5 class="font-weight-semibold my-2">{{ setting('project_name') }}</h5>
                                                            </li>
                                                            <li>{{ setting('email') }}</li>
                                                            <li>{{ setting('facebook') }}</li>
                                                            <li>{{ setting('twitter') }}</li>
                                                            <li>{{ setting('instagram') }}</li>
                                                            <li>{{ optional(setting('phones')) ? setting('phones') : setting('phone') }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="mb-3">{!! trans('dashboard.order.invoice_detail') !!}</h6>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th>
                                                                        {!! trans('dashboard.order.budget') !!} :
                                                                    </th>
                                                                    <td class="text-right">
                                                                        {{ $order->budget }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        {!! trans('dashboard.order.offer_price') !!} :
                                                                    </th>
                                                                    <td class="text-right">{{ optional($order->acceptedOffer)->offer_price }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{!! trans('dashboard.order.total_price') !!}:</th>
                                                                    <td class="text-right text-primary">
                                                                        <h5 class="font-weight-semibold">{{ $order->total_price ? number_format($order->total_price,2) : '0.0' }}</h5>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="invoice-footer" class="pt-3">
                                            <p class="text-muted">{{ optional($order->acceptedOffer)->cost_reason }}</p>
                                        </div>
                                        <!--/ Invoice Recipient Details -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /invoice template -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-12 col-lg-3">


        <div class="card border-info bg-transparent" id="order_statuses_{{ $order->id }}">
            <div class="card-header pb-1">
                <h4 class="card-title"> {{ trans('dashboard.order.order_status') }}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <ul class="activity-timeline timeline-left list-unstyled">
                        <li class="" id="pending">
                            <div class="timeline-icon {!! optional($order->order_status_times)->pending || empty($order->order_status_times) ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->pending || empty($order->order_status_times) ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->pending || empty($order->order_status_times) ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.pending') }}</p>
                            </div>
                            <small class="time">{{ $order->created_at->format("Y-m-d H:i") }}</small>
                        </li>

                        <li class="" id="client_recieve_offers">
                            <div class="timeline-icon {!! optional($order->order_status_times)->client_recieve_offers ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->client_recieve_offers ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->client_recieve_offers ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.client_recieve_offers') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->client_recieve_offers ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="shipped">
                            <div class="timeline-icon {!! optional($order->order_status_times)->shipped ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->shipped ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->shipped ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.shipped') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->shipped ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="start_trip">
                            <div class="timeline-icon {!! optional($order->order_status_times)->start_trip ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->start_trip ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->start_trip ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.start_trip') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->start_trip ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="client_cancel">
                            <div class="timeline-icon {!! optional($order->order_status_times)->client_cancel ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->client_cancel ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->client_cancel ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.client_cancel') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->client_cancel ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="driver_cancel">
                            <div class="timeline-icon {!! optional($order->order_status_times)->driver_cancel ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->driver_cancel ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->driver_cancel ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.driver_cancel') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->driver_cancel ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="admin_cancel">
                            <div class="timeline-icon {!! optional($order->order_status_times)->admin_cancel ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->admin_cancel ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->admin_cancel ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.admin_cancel') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->admin_cancel ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="client_finish">
                            <div class="timeline-icon {!! optional($order->order_status_times)->client_finish ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->client_finish ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->client_finish ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.client_finish') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->client_finish ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="driver_finish">
                            <div class="timeline-icon {!! optional($order->order_status_times)->driver_finish ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->driver_finish ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->driver_finish ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.driver_finish') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->driver_finish ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                        <li class="" id="admin_finish">
                            <div class="timeline-icon {!! optional($order->order_status_times)->admin_finish ? 'bg-success' : 'bg-danger' !!}">
                                <i class="feather {!! optional($order->order_status_times)->admin_finish ? 'icon-check' : 'icon-help-circle' !!} font-medium-2"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold {!! optional($order->order_status_times)->admin_finish ? 'text-success' : 'text-danger' !!}">{{ trans('dashboard.order.statuses.admin_finish') }}</p>

                            </div>
                            <small class="time">{!! optional($order->order_status_times)->admin_finish ?? "<i class='feather icon-clock font-medium-1'></i>" !!}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic initialization -->
</div>

@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/invoice.css">

<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/dashboard-ecommerce.css">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/card-analytics.css"> --}}
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/global/css/custom/listorders.css">
@endsection
@section('vendor_scripts')
    <script src="{{ asset('dashboardAssets') }}/vendors/js/charts/apexcharts.min.js"></script>
@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/dashboard-ecommerce.js"></script>
<script src="{{ asset('dashboardAssets') }}/global/js/custom/easing.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/invoice.js"></script>
@include('dashboard.order.map')
@include('dashboard.order.chat_scripts')
@endsection

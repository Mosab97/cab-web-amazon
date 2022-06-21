<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<!-- BEGIN: Head-->

<head>
    @include('dashboard.layout.meta')
    <title>{!! trans('dashboard.general.cpanel',['title' => $title?? '']) !!}</title>
    <link rel="apple-touch-icon" href="{{ asset('dashboardAssets') }}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboardAssets') }}/images/cover/cover_sm_bg.png">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    @include('dashboard.layout.style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout  navbar-floating footer-static  @yield('body','2-columns')" data-open="click" data-menu="vertical-menu-modern" data-col="@yield('body_col','2-columns')" data-layout="dark-layout">

    @include('dashboard.layout.navbar')
    @include('dashboard.layout.sidebar')
    @include('dashboard.layout.alert')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                @yield('content_header')
            </div>
            <div class="content-body">
                @yield('content')
            </div>

            <div class="content-area-wrapper">
                @yield('content_area')
            </div>

        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('dashboard.layout.customize')
    @include('dashboard.layout.footer')

    @include('dashboard.layout.script')
    @yield('notify')
    <div class="model"></div>
    <script>
       window.Data = {!! json_encode([
            'user_id' => auth()->check() ? auth()->id() : null,
            'notification' => asset('audio/notification.mp3'),
            'message' => asset('audio/message.mp3'),
            'user_type' => auth()->check() ? auth()->user()->user_type : null,
            'client_id' => isset($client) ? $client->id : null,
            'driver_id' => isset($driver) ? $driver->id : null,
            'chat_id' => isset($order) ? @$order->chats()->first()->id : null,
            'order_id' => isset($order) ? $order->id : null,
            'order_client_id' => isset($order) ? $order->client_id : null,
            'order_status' => isset($order) ? $order->order_status : null,
            'last_message_sender' => null,
        ]) !!};
    </script>

    {{-- <script src="//{{ Request::getHost() }}:6009/socket.io/socket.io.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.4/socket.io.js"></script>
    <script>
      // const io = require('socket.io-client');
       // or with import syntax
       // const io = require('socket.io-client')
       // var socket = io("https://caberz-apps.com:3002");
   //  var socket = io.connect("https://caberz-apps.com:3002");
       //   io.on('connect', function() {
           // socket.on('connection',function(){
           // io.on('update_location',function(){
               // var i = 0;
               // var locations = {lat: -34, lng: 151, driver_id: 10, speed: 55, angle: 1};
               // console.log(locations);
               // socket.emit('update_location',locations);
               // var x= setInterval(function(){
               //     consol.log('ggggg');
               //     socket.emit('update_location',locations[i]);
               //     i++;
               // },2000);
                   // socket.emit('update_location',locations[]);
               // for (var i = 100 - 1; i >= 0; i--) {
               //     data = {lat:data.lat+0.03,lng:data.lng+0.03,driver_id:56};
               // });
       // console.log(data)

           // });
   </script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
    var i=0.0001;
    // $(function(){
    //     setInterval(isTyping, 3000);
    // })
    function isTyping(){
            window.Echo.private('caberz-update-location.driver')
              .whisper('moving', {
                  lat : 31.1 + i,
                  lng : 32.1 + i,
                  angle : 35 + i,
                  speed : "35",
                  driver_id : 4,
              });
              i++;
            }
    </script>
</body>
<!-- END: Body-->

</html>

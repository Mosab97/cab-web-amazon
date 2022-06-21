<!DOCTYPE html>
<html lang="en" data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ setting('project_name') }}</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/libs/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/libs/bootstrap-rtl.css" />
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/libs/animate.css" />
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/libs/all.css" />
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/toastr.min.css">
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/css/{{ LaravelLocalization::getCurrentLocaleDirection() }}/plugins/extensions/ext-component-toastr.min.css">
    <script>
        window.isRtl = document.getElementsByTagName("HTML")[0].getAttribute("data-textdirection") === 'rtl' ;
    </script>
</head>

<body>
    <div class="homePage">
        @include('site.layout.header')
        @include('site.layout.alert')
        @yield('content')
        @include('site.layout.footer')

    </div>
    <div id="scroll-top">
        <i class="fas fa-angle-up"></i>
    </div>

   <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> -->
   <script src="{{ asset('landingAssets') }}/js/libs/jquery.min.js"></script>
   <script src="{{ asset('landingAssets') }}/js/libs/bootstrap.min.js"></script>
   <script src="{{ asset('landingAssets') }}/js/libs/wow.min.js"></script>
   <script src="{{ asset('landingAssets') }}/js/libs/popper.min.js"></script>
   <script src="{{ asset('landingAssets') }}/js/main.js"></script>
   <script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/toastr.min.js"></script>

   @yield('scripts')
   <script src="{{ asset('dashboardAssets') }}/js/scripts/extensions/ext-component-toastr.js"></script>
   @yield('notify')

   <script>
       new WOW().init();
   </script>
</body>

</html>

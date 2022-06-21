<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--favicon icon-->
    <link rel="icon" href="{{ asset('landingAssets') }}/assets/img/logo%20color.png" type="image/png" sizes="16x16">

    <!--title-->
    <title>caberz</title>

    <!--build:css-->
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/assets/css/main.css">
    <!-- endbuild -->
</head>

<body>

    @include('site.layout.header')
    @yield('content')
    @include('site.layout.footer')


    <!--scroll bottom to top button start-->
    <div class="scroll-top scroll-to-target primary-bg text-white" data-target="html">
        <span class="fas fa-hand-point-up"></span>
    </div>
    <!--scroll bottom to top button end-->
    <!--build:js-->
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/popper.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/bootstrap.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/jquery.easing.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/owl.carousel.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/countdown.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/jquery.waypoints.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/jquery.rcounterup.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/magnific-popup.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/vendors/validator.min.js"></script>
    <script src="{{ asset('landingAssets') }}/assets/js/app.js"></script>
    <!--endbuild-->
</body>


</html>

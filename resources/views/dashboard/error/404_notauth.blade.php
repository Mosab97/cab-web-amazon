<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{ setting('desc_'.app()->getLocale()) }}">
    <meta name="keywords" content="{{ setting('desc_'.app()->getLocale()) }}">
    <meta name="author" content="PIXINVENT">
    <title>Error 404 - {{ setting('project_name') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('dashboardAssets') }}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboardAssets') }}/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/vendors-rtl.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/themes/semi-dark-layout.css">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/error.css">
    <!-- END: Page CSS-->

    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/custom_assets/css/style-rtl.css">
    @else
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/custom_assets/css/style.css">

    @endif

    <style media="screen">
    * {
        font-family: 'Cairo', sans-serif;
        font-weight: normal;
        font-style: normal;
        /* font-size: 14px; */
    }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- error 404 -->
                <section class="row flexbox-container">
                    <div class="col-xl-7 col-md-8 col-12 d-flex justify-content-center">
                        <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <img src="{{ asset('dashboardAssets') }}/images/pages/404.png" class="img-fluid align-self-center" alt="branding logo">
                                    <h1 class="font-large-2 my-1">404 - {!! trans('dashboard.error.404_msg') !!}</h1>
                                    {{-- @if (auth()->check() && in_array(auth()->user()->user_type,['admin','superadmin'])) --}}
                                        {{-- <a class="btn btn-primary btn-lg mt-2" href="{!! route('dashboard.home') !!}">{!! trans('dashboard.general.go_back_to_home') !!}</a> --}}

                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- error 404 end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboardAssets') }}/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('dashboardAssets') }}/js/core/app-menu.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/core/app.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>

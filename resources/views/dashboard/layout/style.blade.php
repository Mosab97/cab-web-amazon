@if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/vendors-rtl.min.css">
@else
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/vendors.min.css">
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/toastr.css">

@yield('vendor_styles')

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/colors.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/components.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/themes/semi-dark-layout.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/plugins/extensions/toastr.css">
@yield('page_styles')

@if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/custom-rtl.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/custom_assets/css/style-rtl.css">

<style>
    body.vertical-layout.vertical-menu-modern.menu-expanded .main-menu .navigation li.has-sub>a:not(.mm-next):after {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    body.vertical-layout.vertical-menu-modern.menu-expanded .main-menu .navigation li.open>a:not(.mm-next):after {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
    }
</style>
@else
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/custom_assets/css/style.css">

@endif
<style>
    * {
        font-family: 'Cairo', sans-serif;
        font-weight: normal;
        font-style: normal;
        /* font-size: 14px; */
    }

    .main-menu .navbar-header .navbar-brand .brand-logo {
        background: url('{{ asset('dashboardAssets') }}/images/cover/cover_sm_bg.png') no-repeat;
        background-position: center !important;
        background-position: center !important;
        background-size: 41px 31px;
        height: 30px;
        width: 43px;
    }
    .model {
       background: rgba( 255, 255, 255, .4 ) url("{{ asset('dashboardAssets') }}/global/images/loader/loader.gif")
       50% 50%
       no-repeat;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/global/css/custom/styles.css">

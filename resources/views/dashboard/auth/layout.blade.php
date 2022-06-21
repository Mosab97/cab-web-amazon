<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<!-- BEGIN: Head-->

<head>
	@include('dashboard.auth.meta')
	<title>{!! trans('dashboard.auth.login') !!}</title>
	<link rel="apple-touch-icon" href="{{ asset('dashboardAssets') }}/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboardAssets') }}/images/cover/cover_sm_bg.png">
	<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

	@include('dashboard.auth.style')
	<style media="screen">
		* {
			font-family: 'Cairo', sans-serif;
			font-weight: normal;
			font-style: normal;
			/* font-size: 14px; */
		}

		html body.bg-full-screen-image {
			background: url('{{ asset('dashboardAssets') }}/images/cover/cover_login9.jpeg') no-repeat center center;
			-webkit-background-size: cover;
	        -moz-background-size: cover;
	        -o-background-size: cover;
	        background-size: cover;
		}

		.login-form{
		  opacity: .9
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
				@include('dashboard.layout.alert')
				@yield('content')
			</div>
		</div>
	</div>

	<div class="sidenav-overlay"></div>
	<div class="drag-target"></div>

	@include('dashboard.auth.script')
	@yield('notify')

</body>
<!-- END: Body-->

</html>

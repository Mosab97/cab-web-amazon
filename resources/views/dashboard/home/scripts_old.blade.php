@section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/extensions/shepherd-theme-default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">

@endsection

@section('page_styles')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/dashboard-analytics.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/card-analytics.css">

    <link rel="stylesheet" href="{{ asset('dashboardAssets') }}/global/css/custom/listorders.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection

@section('vendor_scripts')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('dashboardAssets') }}/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/tether.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/extensions/shepherd.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/charts/echarts/echarts.min.js"></script>

<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
<!-- END: Page Vendor JS-->
@endsection

@section('page_scripts')
<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('dashboardAssets') }}/js/scripts/cards/card-statistics.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/charts/chart-apex.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/charts/chart-echart.js"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
{{-- @include('dashboard.home.chart.client') --}}
{{-- @include('dashboard.home.chart.order_chart') --}}
<!-- END: Page JS-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ClientChart.init();
});

$(function(){
    $('.expire_date').pickadate({
        format: 'mm/dd/yyyy'
    });
});



</script>
@endsection

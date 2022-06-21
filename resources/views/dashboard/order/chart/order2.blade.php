<script>
/*=========================================================================================
    File Name: chart-apex.js
    Description: Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {

  var $primary = '#7367F0',
    $success = '#28C76F',
    $danger = '#EA5455',
    $warning = '#FF9F43',
    $info = '#00cfe8',
    $label_color_light = '#dae1e7';

  var themeColors = [$primary, $success, $danger, $warning, $info];

  // RTL Support
  var yaxis_opposite = false;
  // if($('html').data('textdirection') == 'rtl'){
  //   yaxis_opposite = true;
  // }
  // Mixed Chart
  // -----------------------------
  var order_chart_elementOptions = {
    chart: {
      height: 450,
      type: 'line',
      stacked: false,
      fontFamily: 'Cairo',
      fontSize: 13
    },
    colors: themeColors,
    stroke: {
      width: [0, 2, 5],
      curve: 'smooth'
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: 'rounded',
        columnWidth: '25%'
      }
    },
    // colors: ['#3A5794', '#A5C351', '#E14A84'],
    series: [{
      name: '{{ trans('dashboard.order.orders') }}',
      type: 'column',
      data: [
          {{ $order_analytics[now()->subMonths(11)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(10)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(9)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(8)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(7)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(6)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(5)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(4)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(3)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(2)->format('Y-m')] }},
          {{ $order_analytics[now()->subMonths(1)->format('Y-m')] }},
          {{ $order_analytics[now()->format('Y-m')] }}
      ]
    }, {
      name: '{{ trans('dashboard.order.finished_orders') }}',
      type: 'area',
      data: [
          {{ $finished_orders_analytics[now()->subMonths(11)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(10)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(9)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(8)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(7)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(6)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(5)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(4)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(3)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(2)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->subMonths(1)->format('Y-m')] }},
          {{ $finished_orders_analytics[now()->format('Y-m')] }}
      ]
    }, {
      name: '{{ trans('dashboard.order.pending_orders') }}',
      type: 'line',
      data: [
          {{ $pending_orders_analytics[now()->subMonths(11)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(10)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(9)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(8)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(7)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(6)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(5)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(4)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(3)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(2)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->subMonths(1)->format('Y-m')] }},
          {{ $pending_orders_analytics[now()->format('Y-m')] }}
      ]
    }],
    fill: {
      opacity: [0.85, 0.25, 1],
      gradient: {
        inverseColors: false,
        shade: 'light',
        type: "vertical",
        opacityFrom: 0.85,
        opacityTo: 0.55,
        stops: [0, 100, 100, 100]
      }
    },
    labels: [
        "{{ now()->subMonths(11)->format('Y-m') }}",
        "{{ now()->subMonths(10)->format('Y-m') }}",
        "{{ now()->subMonths(9)->format('Y-m') }}",
        "{{ now()->subMonths(8)->format('Y-m') }}",
        "{{ now()->subMonths(7)->format('Y-m') }}",
        "{{ now()->subMonths(6)->format('Y-m') }}",
        "{{ now()->subMonths(5)->format('Y-m') }}",
        "{{ now()->subMonths(4)->format('Y-m') }}",
        "{{ now()->subMonths(3)->format('Y-m') }}",
        "{{ now()->subMonths(2)->format('Y-m') }}",
        "{{ now()->subMonths(1)->format('Y-m') }}",
        "{{ now()->format('Y-m') }}"
    ],
    markers: {
      size: 0
    },
    legend: {
      offsetY: -10
    },
    xaxis: {
      type: 'datetime',
      min: `{{ now()->subMonths(11)->format('Y-m') }}`,
      max:`{{ now()->format('Y-m') }}`
    },
    yaxis: {
      min: 0,
      tickAmount: 5,
      // title: {
      //   text: '{{ trans('dashboard.general.counter') }}'
      // },
      opposite: yaxis_opposite
    },
    tooltip: {
      shared: true,
      intersect: false,
      x: {
        format: 'MM/yy'
      },
      y: {
        formatter: function (value) {
            return Math.abs(value) > 999 ? Math.sign(value)*((Math.abs(value)/1000).toFixed(1)) + 'k' : Math.sign(value)*Math.abs(value)
        }
      }
    }
  }
  var order_chart_element = new ApexCharts(
    document.querySelector("#order_chart"),
    order_chart_elementOptions
  );
  order_chart_element.render();

});

</script>

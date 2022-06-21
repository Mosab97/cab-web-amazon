<script>
    var OrderChart = function() {
        var _componentEcharts = function() {
            if (typeof echarts == 'undefined') {
                console.warn('Warning - echarts.min.js is not loaded.');
                return;
            }
            // Define elements
            var order_chart_element = document.getElementById('order_chart');
            // Weekly statistics chart config
            if (order_chart_element) {
                // Initialize chart
                var order_chart = echarts.init(order_chart_element);
                // Options
                order_chart.setOption({
                    // Define colors
                    color: ['#EF5350', '#03A9F4' , '#4eeF24' , '#3c28b2' , '#ff6600', '#3cc4a2', '#cc33ff'],
                    // Global text styles
                    textStyle: {
                        fontFamily: 'Cairo',
                        fontSize: 14
                    },
                    // Chart animation duration
                    animationDuration: 750,
                    // Setup grid
                    grid: {
                        left: 0,
                        right: 10,
                        top: 35,
                        bottom: 0,
                        containLabel: true
                    },
                    // Add legend
                    legend: {
                        data: [`{{ trans('dashboard.order.orders') }}`,`{{ trans('dashboard.setting.app_commission') }}` , `{{ trans('dashboard.order.total_sale') }}`],
                        itemHeight: 8,
                        itemGap: 20,
                        textStyle: {
                            padding: [0, 5]
                        }
                    },
                    // Add tooltip
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        padding: [10, 15],
                        textStyle: {
                            fontSize: 13,
                            fontFamily: 'Cairo'
                        },
                        axisPointer: {
                            type: 'shadow',
                            shadowStyle: {
                                color: 'rgba(0,0,0,0.025)'
                            }
                        }
                    },

                    // Horizontal axis
                    xAxis: [{
                        type: 'category',
                        data: [
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
                            "{{ now()->format('Y-m') }}",
                        ],
                        axisLabel: {
                            color: '#333'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#999'
                            }
                        },
                        splitLine: {
                            show: true,
                            lineStyle: {
                                color: '#eee',
                                type: 'dashed'
                            }
                        }
                    }],

                    // Vertical axis
                    yAxis: [
                        {
                            type: 'value',
                            name: '{{ trans('dashboard.general.counter') }}',
                            axisTick: {
                                show: false
                            },
                            axisLabel: {
                                color: '#333',
                                formatter: function (value, index) {
                                          return Math.abs(value) > 999 ? Math.sign(value)*((Math.abs(value)/1000).toFixed(1)) + 'k' : Math.sign(value)*Math.abs(value)
                                      },
                            },
                            axisLine: {
                                lineStyle: {
                                    color: '#999'
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: ['#eee']
                                }
                            },
                            splitArea: {
                                show: true,
                                areaStyle: {
                                    color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                                }
                            }
                        }
                    ],

                    // Add series
                    series: [
                        {
                            name: `{{ trans('dashboard.order.orders') }}`,
                            type: 'bar',
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
                            ],
                            itemStyle: {
                                normal: {
                                    borderWidth: 2
                                }
                            }
                        },
                        {
                            name: `{{ trans('dashboard.setting.app_commission') }}`,
                            type: 'bar',
                            data: [
                                {{ $app_commission_analytics[now()->subMonths(11)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(10)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(9)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(8)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(7)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(6)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(5)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(4)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(3)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(2)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->subMonths(1)->format('Y-m')] }},
                                {{ $app_commission_analytics[now()->format('Y-m')] }}
                            ]
                        },
                        {
                            name: `{{ trans('dashboard.order.total_sale') }}`,
                            type: 'line',
                            smooth: true,
                            symbolSize: 12,
                            data: [
                                {{ $sale_total_analytics[now()->subMonths(11)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(10)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(9)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(8)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(7)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(6)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(5)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(4)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(3)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(2)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->subMonths(1)->format('Y-m')] }},
                                {{ $sale_total_analytics[now()->format('Y-m')] }}
                            ]
                        }
                    ]
                });

                //order_chart.on('click', function (e) {
                // printing data name in console
                //});
            }


            //
            // Resize order
            //

            // Resize function
            var triggerChartResize = function() {
                order_chart_element && order_chart.resize();
            };

            // On sidebar width change
            $(document).on('click', '.sidebar-control', function() {
                setTimeout(function () {
                    triggerChartResize();
                }, 0);
            });

            // On window resize
            var resizeCharts;
            window.onresize = function () {
                clearTimeout(resizeCharts);
                resizeCharts = setTimeout(function () {
                    triggerChartResize();
                }, 200);
            };
        };
        return {
            init: function() {
                _componentEcharts();
            }
        }
    }();

</script>

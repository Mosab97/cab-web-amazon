<script>
    var OrderChart = function() {
        var _componentEcharts = function() {
            if (typeof echarts == 'undefined') {
                console.warn('Warning - echarts.min.js is not loaded.');
                return;
            }
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
                    fontSize: 13,
                    color:"#EF5350"
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 40,
                    top: 35,
                    bottom: 60,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: [`{{ trans('dashboard.order.orders') }}`,`{{ trans('dashboard.setting.app_commission_with_value',['value' => setting('app_commission')]) }}` , `{{ trans('dashboard.order.total_sale') }}`],
                    itemHeight: 8,
                    itemGap: 20,
                    textStyle: {
                        padding: [0, 5],
                        color:"#4eeF24"
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontFamily: 'Cairo',
                        fontSize: 14
                    },
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    axisLabel: {
                        color: '#4eeF24'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#4eeF24'
                        }
                    },
                    data: ["{{ now()->subMonths(11)->format('Y-m') }}",
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
                            "{{ now()->format('Y-m') }}",]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                      formatter: function (value, index) {
                                return Math.abs(value) > 999 ? Math.sign(value)*((Math.abs(value)/1000).toFixed(1)) + 'k' : Math.sign(value)*Math.abs(value)
                            },
                        color: '#4eeF24'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#4eeF24'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#ff6600']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,200,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Zoom control
                dataZoom: [
                    {
                        type: 'inside',
                        start: 60,
                        end: 100
                    },
                    {
                        show: true,
                        type: 'slider',
                        start: 30,
                        end: 70,
                        height: 40,
                        bottom: 0,
                        borderColor: '#ff6600',
                        fillerColor: 'rgba(0,0,0,0.05)',
                        handleStyle: {
                            color: '#ff6600'
                        }
                    }
                ],

                // Add series
                series: [
                    {
                        name: "{{ trans('dashboard.order.orders') }}",
                        type: 'line',
                        smooth: true,
                        symbolSize: 6,
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        },
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
                    },
                    {
                        name: "{{ trans('dashboard.setting.app_commission_with_value' , ['value' => setting('app_commission')]) }}",
                        type: 'line',
                        smooth: true,
                        symbolSize: 6,
                        color: '#ff6600',
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        },
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
                        name: "{{ trans('dashboard.order.total_sale') }}",
                        type: 'line',
                        smooth: true,
                        symbolSize: 6,
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        },
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
        }


            //
            // Resize charts
            //

            // Resize function
            var triggerChartResize = function() {
                order_chart && order_chart_element.resize();
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

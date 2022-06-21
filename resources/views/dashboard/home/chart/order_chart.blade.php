<script>
    $(window).on("load", function() {

        var $primary = '#7367F0';
        var $danger = '#EA5455';
        var $warning = '#FF9F43';
        var $info = '#0DCCE1';
        var $primary_light = '#8F80F9';
        var $warning_light = '#FFC085';
        var $danger_light = '#f29292';
        var $info_light = '#1edec5';
        var $strok_color = '#b9c3cd';
        var $label_color = '#e7eef7';
        var $white = '#fff';


        var supportChartoptions = {
            chart: {
                height: 270,
                type: 'radialBar',
                fontFamily: 'Roboto, sans-serif'
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    startAngle: -150,
                    endAngle: 150,
                    offsetY: 20,
                    hollow: {
                        size: '65%',
                    },
                    track: {
                        background: $white,
                        strokeWidth: '100%',

                    },
                    dataLabels: {
                        value: {
                            offsetY: 30,
                            color: '#99a2ac',
                            fontSize: '2rem',
                        },

                    }
                },
            },
            colors: [$danger],
            fill: {
                type: 'gradient',
                gradient: {
                    enabled: true,
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: [$primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                },
            },
            stroke: {
                dashArray: 8
            },
            // legend: {
            //     show: false,
            //     formatter: function(val, opt) { return opt.w.globals.labels[opt.dataPointIndex] + ': ' + val }
            // },
            series: ['{{ $finished_orders_percent }}'],
            labels: ['Finished Orders'],

        }

        var supportChart = new ApexCharts(
            document.querySelector("#support-tracker-chart"),
            supportChartoptions
        );
        supportChart.render();
    });
</script>

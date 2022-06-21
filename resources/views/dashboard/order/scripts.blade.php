@section('vendor_styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/pickers/pickadate/pickadate.css">

@endsection
@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/card-analytics.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/data-list-view.css">

    <link rel="stylesheet" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/custom/datetimepicker.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

@endsection
@section('vendor_scripts')
    <script src="{{ asset('dashboardAssets') }}/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/charts/echarts/echarts.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>

    <script src="{{ asset('dashboardAssets') }}/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>

@endsection
@section('page_scripts')
    <script src="{{ asset('dashboardAssets') }}/js/scripts/forms/select/form-select2.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/scripts/cards/card-statistics.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/scripts/charts/chart-apex.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/scripts/charts/chart-echart.js"></script>
    {{-- <script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    @include('dashboard.order.chart.order2')
    <script>
        function changeOrderStatus(order_status,order_id) {
            $.ajax({
    			url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/update_order_status') }}/" + order_id,
    			method: "POST",
    			dataType: "json",
    			data: {order_status : order_status,_token : "{{ csrf_token() }}"},
    			success: function(data) {
    				if (data['value'] == 1) {
    					toastr.success(data['message'], '', { "progressBar": true });
    				}else{
                        toastr.danger(data['message'], '', { "progressBar": true });
                    }
    			}
    		});
        }
    </script>

    <script>
        $(function() {
            $('.picker_date').pickadate({
                format: 'mm/dd/yyyy'
            });


            $(".datatable-new-ajax").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.order.index') }}?"+$.param(@json(request()->query())),
                    type: 'GET',
                    dataSrc: 'data'
                },
                lengthMenu: [[10,25, 100, -1], [10,25, 100, "All"]],
                pageLength: 10,
                order : [[ 6 , "desc" ]],
                columns: [{
                        data: function ( data, type, full, meta ) {
                            return  meta.row + 1;
                        }
                    },
                    {
                        data : "id"
                    },
                    {
                        data: function(info) {
                            return info.client;
                        }
                    },
                    {
                        data: function(info) {
                            return info.driver;
                        }
                    },
                    {
                        data: function(info) {
                            return info.order_type;
                        }
                    },
                    {
                        data: function(info) {
                            return info.order_statuses;
                        }
                    },
                    {
                        data: function(info) {
                            return `<div class="badge badge-violet badge-md mr-1 mb-1">${info.created_at}</div>`;
                        }
                    },
                    {
                        class : "text-center font-medium-3",
                        data: function(data) {
                            return `<a href="${data.show_link}" class="text-info">
                                            <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                                        </a>`;
                        }
                    }
                ],

                dom: 'Blfrtip',
                buttons:{
                    buttons:[{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, ':visible']
                            }
                        },
                        // {
                        //     extend: 'pdfHtml5',
                        //     exportOptions: {
                        //         columns: ':visible'
                        //     }
                        // },

                        {
                            extend: 'excelHtml5',
                            text: 'EXCEL',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            text: 'JSON',
                            action: function ( e, dt, button, config ) {
                                var data = dt.buttons.exportData();

                                $.fn.dataTable.fileSave(
                                    new Blob( [ JSON.stringify( data ) ] ),
                                    'Export.json'
                                );
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ]
                },

                createdRow: function(row, data) {
                    $(row).addClass(`${data.id}`);
                    $('a.fancybox', row).fancybox();
                }
            })
        });
    </script>
@endsection

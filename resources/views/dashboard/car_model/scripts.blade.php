@section('vendor_scripts')
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
@endsection
@section('page_scripts')
    {{-- <script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script>
        $(function() {
            $(".datatable-new-ajax").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.car_model.index') }}?"+$.param(@json(request()->query())),
                    type: 'GET',
                    dataSrc: 'data'
                },
                columns: [{
                        data: function ( data, type, full, meta ) {
                            return  meta.row + 1;
                        }
                    },

                    {
                        data: "name"
                    },
                    {
                        data: "brand_id"
                    },
                    {
                        data: "cars_count"
                    },
                    {
                        data: function(info) {
                            return `<div class="badge badge-violet badge-md mr-1 mb-1">${info.created_at}</div>`;
                        }
                    },
                    {
                        class : "text-center",
                        data: function(data) {
                            return `<a onclick="deleteItem(${data.id} , '${data.destroy_link}')" class="text-danger">
                                            <i class="feather icon-trash-2 font-medium-3" title="{!! trans('dashboard.general.delete') !!}"></i>
                                        </a>

                                        <a href="${data.edit_link}" class="text-primary">
                                            <i class="feather icon-edit font-medium-3" title="{!! trans('dashboard.general.edit') !!}"></i>
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
                lengthMenu: [[10,25, 100, -1], [10,25, 100, "All"]],
                pageLength: 10,
                createdRow: function(row, data) {
                    $(row).addClass(`${data.id}`);
                    $('a.fancybox', row).fancybox();
                }
            })
        });
    </script>

@endsection

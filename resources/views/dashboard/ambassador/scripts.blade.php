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
            getData();
        });
        function getData() {
            $(".datatable-new-ajax").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.ambassador.index') }}?"+$.param(@json(request()->query())),
                    type: 'GET',
                    dataSrc: 'data'
                },
                columns: [{
                    data: function ( data, type, full, meta ) {
                        return  meta.row + 1;
                    }
                },
                {
                    class : "product-img sorting_1",
                    data: function(info) {
                        return `<a href="${ info.avatar }" data-fancybox="gallery">
                        <div class="avatar">
                        <img src="${ info.avatar }" alt="" style="width:60px; height:60px;" class="img-thumbnail rounded">
                        <span class="avatar-status-busy avatar-status-md" id="online_${ info.id }"></span>
                        </div>
                        </a>`;
                    }
                },
                {
                    data: "fullname"
                },
                {
                    data: "email"
                },
                {
                    data: "phone"
                },
                {
                    data: "referral_code"
                },
                {
                    data: function(info) {
                        return `<div class="badge badge-success font-medium-1 badge-md mr-1 mb-1">${info.referral_code_count}</div>`;
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
                        return `<a class="text-success" onclick="notify(${data.id},'${data.notify_link}','{{ request('user_type') }}')">
                            <i class="feather icon-bell" title="{!! trans('dashboard.general.notify') !!}"></i>
                        </a>
                        <a href="${data.show_link}" class="text-info">
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
                lengthMenu: [[10,25, 100, -1], [10,25, 100, "All"]],
                pageLength: 10,
                createdRow: function(row, data) {
                    $(row).addClass(`${data.id}`);
                    $('a.fancybox', row).fancybox();
                }
            })

        }


    </script>
@endsection

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
    <script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script>
    <script src="{{ asset('dashboardAssets') }}/js/scripts/cards/card-statistics.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


    <script>
        $(function() {
            $('.picker_date').pickadate({
                format: 'mm/dd/yyyy'
            });
        });
    </script>
    <script>
        function updateUserDept(userId) {
            var dept = $('.user_dept_to_app').val();
            var btn = $('.btn_change_dept');
            $.ajax({
                url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/update_user_dept')}}/" + userId,
                method: "POST",
                dataType: "json",
                global: false,
                data: {
                    dept: dept,
                    _token:  "{{ csrf_token() }}"
                },
                beforeSend: function(xhr) {
                    btn.html('<div class="spinner-border text-success spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');
                },
                success: function(data) {
                    if (data['value'] == 1) {
                        btn.html('<i class="feather icon-refresh-cw"></i>');
                        toastr.success(data['message'], '', {
                            "progressBar": true
                        });
                    } else {
                        btn.html('<i class="feather icon-refresh-cw"></i>');
                        toastr.danger(data['message'], '', {
                            "progressBar": true
                        });
                    }
                }
            }).fail(function(data) {
                btn.html('<i class="feather icon-refresh-cw"></i>');
                $.each(data.responseJSON.errors, function(index, val) {
                    toastr.error(val, '', {
                        "progressBar": true
                    });
                });
            });
        }
    </script>
@endsection

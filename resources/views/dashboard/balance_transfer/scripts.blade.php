@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection
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
    <script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script>

    <script>
    function changeTransferStatus(transfer_status,order_id) {
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('dashboard/ajax/update_wallet_transfer_status') }}/" + order_id,
            method: "POST",
            dataType: "json",
            data: {transfer_status : transfer_status,_token : "{{ csrf_token() }}"},
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
@endsection

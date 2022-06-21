<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center font-medium-2">{!! request('custom_date_type') == 'day_month_year' ? trans('dashboard.report.day_report',['day' => request('specicified_date')]) : trans('dashboard.report.'.request('get_date').'_report') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">
                                    {{ trans('dashboard.report.number_of_transactions') }}
                                </td>
                                <td>{{ $flatten_transactions->count() }}</td>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.amount_of_transactions') !!}
                                </td>
                                <td>{{ number_format($flatten_transactions->sum('amount'),2) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.number_of_charge_transactions') !!}
                                </td>
                                <td>{{ $flatten_transactions->where('transaction_type','charge')->count() }}</td>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.amount_of_charge_transactions') !!}
                                </td>
                                <td>{{ number_format($flatten_transactions->where('transaction_type','charge')->sum('amount'),2) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.number_of_withdrawal_transactions') !!}
                                </td>
                                <td>{{ $flatten_transactions->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->count() }}</td>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.amount_of_withdrawal_transactions') !!}
                                </td>
                                <td>{{ number_format($flatten_transactions->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->sum('amount'),2) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.number_of_charge_by_admin_transactions') !!}
                                </td>
                                <td>{{ $flatten_transactions->where('transaction_type','charge')->whereNull('transaction_id')->count() }}</td>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.amount_of_charge_by_admin_transactions') !!}
                                </td>
                                <td>{{ number_format($flatten_transactions->where('transaction_type','charge')->whereNull('transaction_id')->sum('amount'),2) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.number_of_charge_by_api_transactions') !!}
                                </td>
                                <td>{{ $flatten_transactions->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->count() }}</td>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.amount_of_charge_by_api_transactions') !!}
                                </td>
                                <td>{{ number_format($flatten_transactions->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->sum('amount'),2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

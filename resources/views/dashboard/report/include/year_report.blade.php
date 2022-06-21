<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center font-medium-2">{!! request('custom_date_type') == 'year' ? trans('dashboard.report.year_report',['year' => request('specicified_year')]) : trans('dashboard.report.duration_report',['from_date' => request('from_date'),'to_date' => request('to_date')]) !!}</th>
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
                                <td>{{ $flatten_transactions->where('transaction_type','withdrawal')->whereNotNull('iban_number')->count() }}</td>
                                <td class="font-weight-bold">
                                    {!! trans('dashboard.report.amount_of_withdrawal_transactions') !!}
                                </td>
                                <td>{{ number_format($flatten_transactions->where('transaction_type','withdrawal')->whereNotNull('iban_number')->sum('amount'),2) }}</td>
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
@foreach ($transactions->chunk(2) as $chunk)
@foreach ($chunk as $key => $month)
<div class="accordion" id="accordion_{{ $key }}">
    <div class="collapse-margin border-info rounded">
        <div class="card-header {{ !$loop->first ? 'collapsed' : null }}" id="headingOne" data-toggle="collapse" role="button" data-target="#collapse_{{ $key }}" aria-expanded="{{ $loop->first ? true : false }}" aria-controls="collapse_{{ $key }}">
            <span class="lead collapse-title">
                {!! trans('dashboard.report.month',['month' => $key]) !!}
            </span>
        </div>

        <div id="collapse_{{ $key }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_{{ $key }}">
            <div class="card-body">
                @include('dashboard.report.include.month_report',['transactions' => $month, 'flatten_transactions' => $flatten_transactions])
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach

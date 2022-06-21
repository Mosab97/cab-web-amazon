@if (request('custom_date_type') == 'month_year' || request('get_date') == 'this_month')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center font-medium-2">{!! trans('dashboard.report.month_report',['month' => request('specicified_month')]) !!}</th>
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
@endif
<div class="row">
    @foreach ($transactions->chunk(4) as $chunk)
        @foreach ($chunk as $key => $week)

    <div class="col-sm-6 col-12">
        <div class="card border-info">
            <div class="card-header">
                <h4 class="card-title">{!! trans('dashboard.report.weeks',['week' => weekOfMonth(str_after($key,'week'),str_before($key,'week')),'month' => str_before($key,'week')]) !!}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-25">
                        <div class="browser-info">
                            <p class="mb-25">{!! trans('dashboard.report.number_of_transactions') !!}</p>
                            <h4>{!! number_format(($week->count()*100)/$flatten_transactions->count(),3) !!} %</h4>
                        </div>
                        <div class="stastics-info text-right">
                            <span>{{ $week->count() }} <i class="feather icon-hash text-primary"></i></span>
                            <span class="text-muted d-block">{{ number_format($week->sum('amount'),2) }} <i class="feather icon-dollar-sign text-primary"></i></span>
                        </div>
                    </div>
                    <div class="progress progress-bar-primary mb-2">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{!! number_format(($week->count()*100)/$flatten_transactions->count(),3) !!}"
                            aria-valuemin="{!! number_format(($week->count()*100)/$flatten_transactions->count(),3) !!}" aria-valuemax="100" style="width:{!! number_format(($week->count()*100)/$flatten_transactions->count(),3) !!}%"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-25">
                        <div class="browser-info">
                            <p class="mb-25">{!! trans('dashboard.report.number_of_charge_transactions') !!}</p>
                            <h4>{!! number_format(($week->where('transaction_type','charge')->count()*100)/$flatten_transactions->count(),3) !!} %</h4>
                        </div>
                        <div class="stastics-info text-right">
                            <span>{{ $week->where('transaction_type','charge')->count() }} <i class="feather icon-hash text-success"></i></span>
                            <span class="text-muted d-block">{{ number_format($week->where('transaction_type','charge')->sum('amount'),2) }} <i class="feather icon-dollar-sign text-success"></i></span>
                        </div>
                    </div>
                    <div class="progress progress-bar-success mb-2">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{!! number_format(($week->where('transaction_type','charge')->count()*100)/$flatten_transactions->count(),3) !!}"
                            aria-valuemin="{!! number_format(($week->where('transaction_type','charge')->count()*100)/$flatten_transactions->count(),3) !!}" aria-valuemax="100"
                            style="width:{!! number_format(($week->where('transaction_type','charge')->count()*100)/$flatten_transactions->count(),3) !!}%"></div>
                    </div>


                    <div class="d-flex justify-content-between mb-25">
                        <div class="browser-info">
                            <p class="mb-25">{!! trans('dashboard.report.number_of_withdrawal_transactions') !!}</p>
                            <h4>{!! number_format(($week->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->count()*100)/$flatten_transactions->count(),3) !!} %</h4>
                        </div>
                        <div class="stastics-info text-right">
                            <span>{{ $week->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->count() }} <i class="feather icon-hash text-warning"></i></span>
                            <span class="text-muted d-block">{{ number_format($week->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->sum('amount'),2) }} <i class="feather icon-dollar-sign text-warning"></i></span>
                        </div>
                    </div>
                    <div class="progress progress-bar-warning mb-2">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{!! number_format(($week->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->count()*100)/$flatten_transactions->count(),3) !!}"
                            aria-valuemin="{!! number_format(($week->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->count()*100)/$flatten_transactions->count(),3) !!}" aria-valuemax="100"
                            style="width:{!! number_format(($week->where('transaction_type','withdrawal')->where('transfer_status' , 'transfered')->whereNotNull('iban_number')->count()*100)/$flatten_transactions->count(),3) !!}%"></div>
                    </div>

                    {{-- Charge By Admin --}}
                    <div class="d-flex justify-content-between mb-25">
                        <div class="browser-info">
                            <p class="mb-25">{!! trans('dashboard.report.number_of_charge_by_admin_transactions') !!}</p>
                            <h4>{!! number_format(($week->where('transaction_type','charge')->whereNull('transaction_id')->count()*100)/$flatten_transactions->count(),3) !!} %</h4>
                        </div>
                        <div class="stastics-info text-right">
                            <span>{{ $week->where('transaction_type','charge')->whereNull('transaction_id')->count() }} <i class="feather icon-hash text-danger"></i></span>
                            <span class="text-muted d-block">{{ number_format($week->where('transaction_type','charge')->whereNull('transaction_id')->sum('amount'),2) }} <i class="feather icon-dollar-sign text-danger"></i></span>
                        </div>
                    </div>
                    <div class="progress progress-bar-danger mb-2">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{!! number_format(($week->where('transaction_type','charge')->whereNull('transaction_id')->count()*100)/$flatten_transactions->count(),3) !!}"
                            aria-valuemin="{!! number_format(($week->where('transaction_type','charge')->whereNull('transaction_id')->count()*100)/$flatten_transactions->count(),3) !!}" aria-valuemax="100"
                            style="width:{!! number_format(($week->where('transaction_type','charge')->whereNull('transaction_id')->count()*100)/$flatten_transactions->count(),3) !!}%"></div>
                    </div>
                    {{-- Charge By API --}}
                    <div class="d-flex justify-content-between mb-25">
                        <div class="browser-info">
                            <p class="mb-25">{!! trans('dashboard.report.number_of_charge_by_api_transactions') !!}</p>
                            <h4>{!! number_format(($week->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->count()*100)/$flatten_transactions->count(),3) !!} %</h4>
                        </div>
                        <div class="stastics-info text-right">
                            <span>{{ $week->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->count() }} <i class="feather icon-hash text-info"></i></span>
                            <span class="text-muted d-block">{{ number_format($week->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->sum('amount'),2) }} <i class="feather icon-dollar-sign text-info"></i></span>
                        </div>
                    </div>
                    <div class="progress progress-bar-info mb-2">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{!! number_format(($week->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->count()*100)/$flatten_transactions->count(),3) !!}"
                            aria-valuemin="{!! number_format(($week->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->count()*100)/$flatten_transactions->count(),3) !!}" aria-valuemax="100"
                            style="width:{!! number_format(($week->where('transaction_type','charge')->whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->count()*100)/$flatten_transactions->count(),3) !!}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endforeach
</div>

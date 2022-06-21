@extends('dashboard.layout.layout')
@section('content')
<!-- Basic datatable -->
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline pb-1">
        <h5 class="card-title">{!! trans('dashboard.balance_transfer.balance_transfers') !!}</h5>
    </div>
    <div class="card-body border-info bg-transparent">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex py-75 active" id="account-pill-pending" data-toggle="pill" href="#pending" aria-expanded="true">
                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                            {!! trans('dashboard.balance_transfer.pendingWithdrawal') !!}
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex py-75" id="account-pill-transfered" data-toggle="pill" href="#transfered" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            {!! trans('dashboard.balance_transfer.transferedWithdrawal') !!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-refused" data-toggle="pill" href="#refused" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            {!! trans('dashboard.balance_transfer.refusedWithdrawal') !!}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="tab-content">


                    <div role="tabpanel" class="tab-pane active" id="pending" aria-labelledby="account-pill-pending" aria-expanded="true">
                        <div class="d-flex justify-content-center">
                            {!! $pendingWithdrawals->links() !!}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dataex-html5-selectors">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>
                                            @lang('dashboard.driver.driver')
                                        </th>

                                        <th>
                                            @lang('dashboard.balance_transfer.amount_to_be_transferred')
                                        </th>

                                        <th>
                                            @lang('dashboard.balance_transfer.iban_number')
                                        </th>
                                        <th>
                                            @lang('dashboard.balance_transfer.added_date')
                                        </th>
                                        <th class="text-center">
                                            @lang('dashboard.balance_transfer.transfer_status')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingWithdrawals as $pendingWithdrawal)
                                    <tr class="{{ $pendingWithdrawal->id }} text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('dashboard.driver.show',$pendingWithdrawal->user_id) }}">{{ $pendingWithdrawal->user->fullname }}</a></td>
                                        <td>
                                            {{ $pendingWithdrawal->amount }}
                                        </td>
                                        <td>{{ $pendingWithdrawal->iban_number }}</td>
                                        <td>
                                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                                {{ $pendingWithdrawal->created_at->format("Y-m-d") }}
                                            </div>
                                        </td>
                                        <td>
                                            {!! Form::select("transfer_status",$transfer_statuses , $pendingWithdrawal->transfer_status , ['class' => 'select2 form-control', 'onchange' => "changeTransferStatus(this.value,'". $pendingWithdrawal->id ."')"]) !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="transfered" role="tabpanel" aria-labelledby="account-pill-transfered" aria-expanded="false">
                        <div class="d-flex justify-content-center">
                            {!! $transferedWithdrawals->links() !!}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dataex-html5-selectors">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>
                                            @lang('dashboard.driver.driver')
                                        </th>

                                        <th>
                                            @lang('dashboard.balance_transfer.amount_to_be_transferred')
                                        </th>

                                        <th>
                                            @lang('dashboard.balance_transfer.iban_number')
                                        </th>
                                        <th>
                                            @lang('dashboard.balance_transfer.added_date')
                                        </th>
                                        <th>
                                            @lang('dashboard.balance_transfer.transfer_date')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferedWithdrawals as $transferedWithdrawal)
                                    <tr class="{{ $transferedWithdrawal->id }} text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('dashboard.driver.show',$transferedWithdrawal->user_id) }}">{{ $transferedWithdrawal->user->fullname }}</a></td>
                                        <td>
                                            {{ $transferedWithdrawal->amount }}
                                        </td>
                                        <td>{{ $transferedWithdrawal->iban_number }}</td>
                                        <td>
                                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                                {{ $transferedWithdrawal->created_at->format("Y-m-d") }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                                {{ $transferedWithdrawal->transfer_at->format("Y-m-d") }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade " id="refused" role="tabpanel" aria-labelledby="account-pill-refused" aria-expanded="false">
                        <div class="d-flex justify-content-center">
                            {!! $refusedWithdrawals->links() !!}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dataex-html5-selectors">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>
                                            @lang('dashboard.driver.driver')
                                        </th>

                                        <th>
                                            @lang('dashboard.balance_transfer.amount_to_be_transferred')
                                        </th>

                                        <th>
                                            @lang('dashboard.balance_transfer.iban_number')
                                        </th>
                                        <th>
                                            @lang('dashboard.balance_transfer.added_date')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($refusedWithdrawals as $refusedWithdrawal)
                                    <tr class="{{ $refusedWithdrawal->id }} text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ $refusedWithdrawal->user_id ? route('dashboard.driver.show',$refusedWithdrawal->user_id) : '#' }}">{{ @$refusedWithdrawal->user->fullname }}</a></td>
                                        <td>
                                            {{ $refusedWithdrawal->amount }}
                                        </td>
                                        <td>{{ $refusedWithdrawal->iban_number }}</td>
                                        <td>
                                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                                {{ $refusedWithdrawal->created_at->format("Y-m-d") }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /basic datatable -->


@include('dashboard.layout.delete_modal')

@endsection

@include('dashboard.balance_transfer.scripts')

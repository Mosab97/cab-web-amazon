@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title mb-1">{!! trans('dashboard.renew_subscribtion_request.renew_subscribtion_requests') !!}</h5>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $renew_subscribtion_requests->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.driver.driver') !!}</th>
                        <th>{!! trans('dashboard.driver.driver_wallet') !!}</th>
                        <th>{!! trans('dashboard.package.package') !!}</th>
                        <th>{!! trans('dashboard.package.package_price') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($renew_subscribtion_requests as $renew_subscribtion_request)
                    <tr class="{{ $renew_subscribtion_request->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{!! route('dashboard.driver.show',$renew_subscribtion_request->driver_id) !!}">
                                {{ $renew_subscribtion_request->driver->fullname }}
                            </a>
                        </td>
                        <td>{{ (float)$renew_subscribtion_request->driver->wallet }}</td>
                        <td>{{ optional($renew_subscribtion_request->package)->name }}</td>
                        <td>{{ optional($renew_subscribtion_request->package)->package_price }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $renew_subscribtion_request->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center">
                            {!! Form::model($renew_subscribtion_request,['route' => ['dashboard.renew_subscribtion_request.update',$renew_subscribtion_request->id] , 'method' => 'PUT' , 'id' => 'renew_form_'.$renew_subscribtion_request->id]) !!}
                            <input type="hidden" name="renew_status" value="accepted">
                            <a class="text-success font-medium-3" onclick="document.getElementById('renew_form_{{ $renew_subscribtion_request->id }}').submit();">
                                <i class="feather icon-check-circle" title="{!! trans('dashboard.renew_subscribtion_request.accept_request') !!}"></i>
                            </a>
                            {!! Form::close() !!}

                            <a class="text-danger font-medium-3" onclick="openRefuseModel('{{ route('dashboard.renew_subscribtion_request.update',$renew_subscribtion_request->id) }}')"><i class="feather icon-x-circle" title="{!! trans('dashboard.update_request.refuse_update') !!}"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $renew_subscribtion_requests->links() !!}
        </div>
    </div>
</div>
@include('dashboard.renew_subscribtion_request.refuse_modal')
@endsection

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@include('dashboard.renew_subscribtion_request.scripts')

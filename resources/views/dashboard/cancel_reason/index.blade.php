@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.cancel_reason.cancel_reasons') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.cancel_reason.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.cancel_reason.add_cancel_reason') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $cancel_reasons->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.cancel_reason.user_type') !!}</th>
                        <th>{!! trans('dashboard.order.order_count') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cancel_reasons as $cancel_reason)
                    <tr class="{{ $cancel_reason->id }} text-center">
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $cancel_reason->name }}</td>
                        <td>{{ trans('dashboard.cancel_reason.user_types.'.$cancel_reason->user_type) }}</td>
                        <td>{{ @$cancel_reason->orders->count() }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $cancel_reason->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $cancel_reason->id }} , '{{ route('dashboard.cancel_reason.destroy',$cancel_reason->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.cancel_reason.edit',$cancel_reason->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $cancel_reasons->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.delete_modal')
@endsection

@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@include('dashboard.cancel_reason.scripts')

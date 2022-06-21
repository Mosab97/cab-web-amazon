@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title mb-1">{!! trans('dashboard.update_request.update_requests') !!}</h5>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $update_requests->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.update_request.update_type') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($update_requests as $update_request)
                    <tr class="{{ $update_request->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $update_request->user->fullname }}</td>
                        <td>{{ trans('dashboard.update_request.update_types.'.$update_request->update_type) }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $update_request->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center">
                            <a href="{!! route('dashboard.update_request.show',$update_request->id) !!}" class="text-primary font-medium-3">
                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $update_requests->links() !!}
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
@include('dashboard.update_request.scripts')

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_offer.point_offers') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.point_offer.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.point_offer.add_point_offer') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $point_offers->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.point_offer.user_type') !!}</th>
                        <th>{!! trans('dashboard.point_offer.points') !!}</th>
                        <th>{!! trans('dashboard.point_offer.number_of_orders') !!}</th>
                        <th>{!! trans('dashboard.point_offer.start_at') !!}</th>
                        <th>{!! trans('dashboard.point_offer.end_at') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($point_offers as $point_offer)
                    <tr class="{{ $point_offer->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ trans('dashboard.cancel_reason.user_types.'.$point_offer->user_type) }}</td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $point_offer->points }}</div>
                        </td>
                        <td>
                            <div class="badge badge-primary badge-md mr-1 mb-1">{{ $point_offer->number_of_orders }}</div>
                        </td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $point_offer->start_at->format("Y-m-d") }}</div>
                        </td>
                        <td>
                            <div class="badge badge-primary badge-md mr-1 mb-1">{{ $point_offer->end_at->format("Y-m-d") }}</div>
                        </td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $point_offer->created_at->format("Y-m-d") }}</div>
                        </td>

                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $point_offer->id }} , '{{ route('dashboard.point_offer.destroy',$point_offer->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.point_offer.edit',$point_offer->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $point_offers->links() !!}
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
@include('dashboard.point_offer.scripts')

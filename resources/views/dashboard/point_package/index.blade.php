@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_package.point_packages') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.point_package.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.point_package.add_point_package') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $point_packages->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.point_package.user_type') !!}</th>
                        <th>{!! trans('dashboard.point_package.transfer_type') !!}</th>
                        <th>{!! trans('dashboard.point_package.points') !!}</th>
                        <th>{!! trans('dashboard.point_package.amount') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($point_packages as $point_package)
                    <tr class="{{ $point_package->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $point_package->image }}" data-fancybox="gallery">
                                <img src="{{ $point_package->image }}" alt="" style="width:60px; height:60px;" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $point_package->name }}</td>
                        <td>{{ trans('dashboard.cancel_reason.user_types.'.$point_package->user_type) }}</td>
                        <td>{{ trans('dashboard.point_package.transfer_types.'.$point_package->transfer_type) }}</td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $point_package->points }}</div>
                        </td>
                        <td>
                            <div class="badge badge-info badge-md mr-1 mb-1">{{ $point_package->amount }}</div>
                        </td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $point_package->created_at->format("Y-m-d") }}</div>
                        </td>

                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $point_package->id }} , '{{ route('dashboard.point_package.destroy',$point_package->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.point_package.edit',$point_package->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $point_packages->links() !!}
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
@include('dashboard.point_package.scripts')

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.car_type.car_types') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.car_type.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.car_type.add_car_type') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $car_types->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.car.car_count') !!}</th>
                        <th>{!! trans('dashboard.car.counter_open') !!}</th>
                        <th>{!! trans('dashboard.car.kilo_price') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($car_types as $car_type)
                    <tr class="{{ $car_type->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $car_type->image }}" data-fancybox="gallery">
                                <img src="{{ $car_type->image }}" alt="" style="width:95px; height:60px;" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $car_type->name }}</td>
                        <td>{{ @$car_type->cars->count() }}</td>
                        <td>{{ $car_type->counter_open }}</td>
                        <td>{{ $car_type->kilo_price }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $car_type->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $car_type->id }} , '{{ route('dashboard.car_type.destroy',$car_type->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.car_type.edit',$car_type->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $car_types->links() !!}
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
@include('dashboard.car_type.scripts')

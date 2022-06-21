@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.lucky_box.lucky_boxes') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.lucky_box.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.lucky_box.add_lucky_box') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $lucky_boxes->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.lucky_box.user_type') !!}</th>
                        <th>{!! trans('dashboard.user.user_count') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lucky_boxes as $lucky_box)
                    <tr class="{{ $lucky_box->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $lucky_box->image }}" data-fancybox="gallery">
                                <img src="{{ $lucky_box->image }}" alt="" style="width:60px; height:60px;" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $lucky_box->name }}</td>
                        <td>{{ trans('dashboard.lucky_box.user_types.'.$lucky_box->user_type) }}</td>
                        <td>{{ @$lucky_box->users->count() }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $lucky_box->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $lucky_box->id }} , '{{ route('dashboard.lucky_box.destroy',$lucky_box->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.lucky_box.show',$lucky_box->id) !!}" class="text-success">
                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.lucky_box.edit',$lucky_box->id) !!}" class="text-primary">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $lucky_boxes->links() !!}
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
@include('dashboard.lucky_box.scripts')

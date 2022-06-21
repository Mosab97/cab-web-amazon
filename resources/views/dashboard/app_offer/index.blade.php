@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.app_offer.app_offers') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.app_offer.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.app_offer.add_app_offer') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $app_offers->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.app_offer.user_type') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($app_offers as $app_offer)
                    <tr class="{{ $app_offer->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $app_offer->image_ar }}" data-fancybox="gallery">
                                <img src="{{ $app_offer->image_ar }}" alt="" style="width:60px; height:60px;" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $app_offer->name }}</td>
                        <td>{{ trans('dashboard.app_offer.user_types.'.$app_offer->user_type) }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $app_offer->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $app_offer->id }} , '{{ route('dashboard.app_offer.destroy',$app_offer->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.app_offer.edit',$app_offer->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $app_offers->links() !!}
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
@include('dashboard.brand.scripts')

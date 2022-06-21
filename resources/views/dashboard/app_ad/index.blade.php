@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.app_ad.app_ads') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.app_ad.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.app_ad.add_app_ad') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $app_ads->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{{ trans('dashboard.package.active_state') }}</th>

                        <th>{{ trans('dashboard.app_ad.start_at') }}</th>
                        <th>{{ trans('dashboard.app_ad.end_at') }}</th>

                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($app_ads as $app_ad)
                    <tr class="{{ $app_ad->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $app_ad->image }}" data-fancybox="gallery">
                                <img src="{{ $app_ad->image }}" alt="" style="width:60px; height:60px;" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $app_ad->name }}</td>
                        <td>
                            <div class="custom-control toggle-switch custom-switch custom-switch-success mr-2 mb-1">
                                <input id="check_active_{{ $loop->index }}" {{ $app_ad->is_active ? 'checked' : '' }} class="custom-control-input" onchange="toggleActive('{{ $app_ad->id }}')" type="checkbox">
                                <label for="check_active_{{ $loop->index }}"></label>
                                <label class="custom-control-label" for="check_active_{{ $loop->index }}">
                                    <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                    <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ optional($app_ad->start_at)->format("Y-m-d") }}</div>
                        </td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ optional($app_ad->end_at)->format("Y-m-d") }}</div>
                        </td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $app_ad->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $app_ad->id }} , '{{ route('dashboard.app_ad.destroy',$app_ad->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.app_ad.edit',$app_ad->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $app_ads->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.delete_modal')
@endsection


@include('dashboard.app_ad.scripts')

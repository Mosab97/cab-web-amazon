@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.slider.slider') !!}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.slider.create') }}">
                    <i class="feather icon-plus"></i>
                    {{ trans('dashboard.slider.add_slider') }}
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $sliders->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.user.active_state') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                    <tr class="{{ $slider->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $slider->image }}" data-fancybox="gallery">
                                <img src="{{ $slider->image }}" alt=""style="width:90px; height:80px;" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $slider->name }}</td>
                        <td>
                            <div class="badge {{ $slider->is_active ? 'badge-success' : 'badge-danger' }} badge-md mr-1 mb-1">
                                {{ $slider->is_active ? trans('dashboard.user.active') : trans('dashboard.user.not_active') }}
                            </div>
                        </td>
                        <td><div class="badge badge-violet badge-md mr-1 mb-1">{{ $slider->created_at->format("Y-m-d") }}</div> </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $slider->id }} , '{{ route('dashboard.slider.destroy',$slider->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.slider.edit',$slider->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $sliders->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.delete_modal')
@endsection


@include('dashboard.slider.scripts')

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.manager.managers') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.manager.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.manager.add_manager') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $managers->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.email') !!}</th>
                        <th>{!! trans('dashboard.role.role') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($managers as $manager)
                    <tr class="{{ $manager->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $manager->avatar }}" data-fancybox="gallery">
                                <div class="avatar">
                                    <img src="{{ $manager->avatar }}" alt="" style="width:60px; height:60px;" class="img-thumbnail rounded">
                                <span class="avatar-status-busy avatar-status-md" id="online_{{ $manager->id }}"></span>
                            </div>
                            </a>
                        </td>
                        <td>{{ $manager->fullname }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>{{ optional($manager->role)->name }}</td>
                        <td><div class="badge badge-violet badge-md mr-1 mb-1">{{ $manager->created_at->format("Y-m-d") }}</div> </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $manager->id }} , '{{ route('dashboard.manager.destroy',$manager->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.manager.edit',$manager->id) !!}" class="text-primary mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $managers->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.delete_modal')
@endsection
@section('current',trans('dashboard.manager.managers'))
@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('page_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@include('dashboard.manager.scripts')

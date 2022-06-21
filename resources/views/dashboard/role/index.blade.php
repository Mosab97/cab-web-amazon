@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.role.roles') !!}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.role.create') }}">
                    <i class="feather icon-plus"></i>
                    {{ trans('dashboard.role.add_role') }}
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $roles->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        @foreach (config('translatable.locales') as $locale)
                        <th>{!! trans('dashboard.'.$locale.'.name') !!}</th>
                        @endforeach
                        <th>{!! trans('dashboard.role.manager_count') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr class="{{ $role->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        @foreach (config('translatable.locales') as $locale)
                        <td>{{ $role->translate($locale)->name }}</td>
                        @endforeach
                        <td>{{ $role->users->count() }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $role->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center">
                            <a onclick="deleteItem({{ $role->id }} , '{{ route('dashboard.role.destroy',$role->id) }}')" class="text-danger font-medium-3">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.role.edit',$role->id) !!}" class="text-default font-medium-3 mr-2">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $roles->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.delete_modal')
@endsection
@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection
@include('dashboard.role.scripts')

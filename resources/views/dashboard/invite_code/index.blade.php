@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.invite_code.invite_codes') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.invite_code.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.invite_code.add_invite_code') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $invite_codes->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors table-hover-animation">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.invite_code.invite_code') !!}</th>
                        <th>{!! trans('dashboard.invite_code.points') !!}</th>
                        {{-- <th>{!! trans('dashboard.invite_code.invite_code_count') !!}</th> --}}
                        <th>{!! trans('dashboard.invite_code.user_count') !!}</th>
                        <th>{!! trans('dashboard.invite_code.driver_count') !!}</th>
                        <th>{!! trans('dashboard.invite_code.client_count') !!}</th>
                        <th>{!! trans('dashboard.invite_code.active_status') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invite_codes as $invite_code)
                    <tr class="{{ $invite_code->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $invite_code->code }}</td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">
                                {{ $invite_code->points }}
                            </div>
                        </td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">
                                {{ $invite_code->users->count() }}
                            </div>
                        </td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">
                                {{ $invite_code->users()->where('user_type','driver')->count() }}
                            </div>
                        </td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">
                                {{ $invite_code->users()->where('user_type','client')->count() }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-control toggle-switch custom-switch custom-switch-success mr-2 mb-1">
                                <input id="check_active_{{ $loop->index }}" {{ $invite_code->is_active ? 'checked' : '' }} class="custom-control-input" onchange="toggleActive('{{ $invite_code->id }}')" type="checkbox">
                                <label for="check_active_{{ $loop->index }}"></label>
                                <label class="custom-control-label" for="check_active_{{ $loop->index }}">
                                    <span class="switch-icon-left">
                                        <i class="feather icon-check"></i>
                                    </span>
                                    <span class="switch-icon-right">
                                        <i class="feather icon-x"></i>
                                    </span>
                                </label>
                            </div>
                        </td>

                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">
                                {{ $invite_code->created_at->format("Y-m-d") }}
                            </div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $invite_code->id }},'{{ route('dashboard.invite_code.destroy',$invite_code->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.invite_code.show',$invite_code->id) !!}" class="text-info">
                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.invite_code.edit',$invite_code->id) !!}" class="text-primary">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $invite_codes->links() !!}
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
@include('dashboard.invite_code.scripts')

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.package.packages') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.package.create') }}">
            <i class="feather icon-plus"></i>
            {{ trans('dashboard.package.add_package') }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $packages->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ trans('dashboard.general.name') }}</th>
                        <th>{{ trans('dashboard.package.package_price') }}</th>
                        <th>{{ trans('dashboard.package.duration') }}</th>
                        <th>{{ trans('dashboard.package.free_duration') }}</th>
                        <th>{{ trans('dashboard.package.commission') }}</th>
                        <th>{{ trans('dashboard.package.active_state') }}</th>
                        <th>{{ trans('dashboard.package.subscribers') }}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                    <tr class="{{ $package->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->package_price }}</td>
                        <td>{{ $package->duration }}</td>
                        <td>{{ $package->free_duration }}</td>
                        <td>{{ $package->commission }}</td>
                        <td>
                            <div class="custom-control toggle-switch custom-switch custom-switch-success mr-2 mb-1">
                                <input id="check_active_{{ $loop->index }}" {{ $package->is_active ? 'checked' : '' }} class="custom-control-input" onchange="toggleActive('{{ $package->id }}')" type="checkbox">
                                <label for="check_active_{{ $loop->index }}"></label>
                                <label class="custom-control-label" for="check_active_{{ $loop->index }}">
                                    <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                    <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                </label>
                            </div>

                        </td>
                        <td>{{ $package->subscribers()->current()->distinct('driver_id')->count() }}</td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $package->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a onclick="deleteItem({{ $package->id }} , '{{ route('dashboard.package.destroy',$package->id) }}')" class="text-danger">
                                <i class="feather icon-trash-2" title="{!! trans('dashboard.general.delete') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.package.edit',$package->id) !!}" class="text-primary font-medium-3">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $packages->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.delete_modal')
@endsection

@include('dashboard.package.scripts')

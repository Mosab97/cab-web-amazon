@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.ambassador.my_referrals') !!}</h5>
        <a class="btn btn-primary mr-1 mb-1 waves-effect waves-light" href="{{ route('dashboard.'.$user->user_type.'.show',$user->id) }}">
            <i class="feather icon-monitor"></i>
            {{ $user->fullname ?? $user->phone }}
        </a>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.image') !!}</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.email') !!}</th>
                        <th>{!! trans('dashboard.user.user_type') !!}</th>
                        <th>{!! trans('dashboard.point.point_count') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                        <th>{!! trans('dashboard.general.control') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="{{ $user->user->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="product-img sorting_1">
                            <a href="{{ $user->user->avatar }}" data-fancybox="gallery">
                                <div class="avatar">
                                    <img src="{{ $user->user->avatar }}" alt="" style="width:60px; height:60px;" class="img-thumbnail rounded">
                                <span class="avatar-status-busy avatar-status-md" id="online_{{ $user->user->id }}"></span>
                            </div>
                            </a>
                        </td>
                        <td>{{ $user->user->fullname }}</td>
                        <td>{{ $user->user->email }}</td>
                        <td>{{ trans('dashboard.user.user_types.'.$user->user->user_type) }}</td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $user->points }}</div>
                        </td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $user->user->created_at->format("Y-m-d") }}</div>
                        </td>
                        <td class="text-center font-medium-3">
                            <a href="{!! route('dashboard.'.$user->user->user_type.'.edit',$user->user->id) !!}" class="text-primary">
                                <i class="feather icon-edit" title="{!! trans('dashboard.general.edit') !!}"></i>
                            </a>
                            <a href="{!! route('dashboard.'.$user->user->user_type.'.show',$user->user->id) !!}" class="text-info">
                                <i class="feather icon-monitor" title="{!! trans('dashboard.general.show') !!}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    </div>
</div>
@endsection
@section('vendor_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/vendors/css/tables/datatable/datatables.min.css">

@endsection
@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/users.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/data-list-view.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboardAssets') }}/{{ LaravelLocalization::getCurrentLocaleDirection() }}/css/pages/knowledge-base.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@section('vendor_scripts')
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{ asset('dashboardAssets') }}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>

@endsection
@section('page_scripts')
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/user-profile.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/datatables/datatable.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/navs/navs.js"></script>
<script src="{{ asset('dashboardAssets') }}/js/scripts/pages/faq-kb.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
@endsection

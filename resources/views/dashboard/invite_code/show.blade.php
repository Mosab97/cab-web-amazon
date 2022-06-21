@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title mb-2">{!! trans('dashboard.invite_code.invite_code') !!} : {{ $invite_code->code }}</h5>

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
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.email') !!}</th>
                        <th>{!! trans('dashboard.user.user_type') !!}</th>
                        <th>{!! trans('dashboard.point.point_count') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class=" text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('dashboard.'.$user->user_type.'.show',$user->id) }}">{{ $user->fullname ?? $user->phone }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ trans('dashboard.user.user_types.'.$user->user_type) }}</td>
                        <td>
                            <div class="badge badge-success badge-md mr-1 mb-1">{{ $user->pivot->points }}</div>
                        </td>
                        <td>
                            <div class="badge badge-violet badge-md mr-1 mb-1">{{ $user->pivot->created_at->format("Y-m-d") }}</div>
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

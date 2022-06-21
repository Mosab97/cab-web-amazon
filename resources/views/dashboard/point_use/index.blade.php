@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_use.'.request('user_type').'_point_use') !!}</h5>
    </div>

    <div class="card-body">
        @include('dashboard.point_use.filter')
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>

        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.phone') !!}</th>
                        <th>{!! trans('dashboard.point.points_current_count') !!}</th>
                        <th>{!! trans('dashboard.point.points_used_count') !!}</th>
                        <th>{!! trans('dashboard.point.replace_amount') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                    @foreach($user->userPoints->unique('user_id') as $point)
                        <tr class="{{ $user->id }} text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('dashboard.'.$user->user_type.'.show', $user->id) }}">
                                    {{ $user->fullname }}
                                </a>
                            </td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->points}}</td>
                            <td>{{$point->sum('points')}}</td>
                            <td>{{$point->sum('amount')}}</td>
                            <td>
                                <div class="badge badge-violet badge-md mr-1 mb-1">{{ $point->created_at->format("Y-m-d") }}</div>
                            </td>

                        </tr>
                    @endforeach
                    @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.notify_modal')
@endsection

@include('dashboard.point_use.scripts')

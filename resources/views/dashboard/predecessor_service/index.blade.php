@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info bg-transparent">
    <div class="card-header header-elements-inline" style="padding: 15px;">
        <h5 class="card-title">{!! trans('dashboard.predecessor_service.'.request('user_type').'_predecessor_service') !!}</h5>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
    <div class="col-md-4 col-12 mt-3" >
        <div class="card border-info bg-transparent">
            <div class="card-header rounded d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-500 mb-0">{{$total_amount . '  '. trans('dashboard.currency.rs')}} </h2>
                    <p>{{ trans('dashboard.predecessor_service.total_amount') }}</p>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-4"></div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
        @include('dashboard.predecessor_service.filter')

        <div class="table-responsive">
            <table class="table table-bordered dataex-html5-selectors">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{!! trans('dashboard.general.name') !!}</th>
                        <th>{!! trans('dashboard.general.phone') !!}</th>
{{--                        <th>{{ trans('dashboard.user.user_dept_to_app') }}</th>--}}
                        <th>{!! trans('dashboard.predecessor_service.amount') !!}</th>
                        <th>{!! trans('dashboard.predecessor_service.paid_at') !!}</th>
                        <th>{!! trans('dashboard.general.added_date') !!}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                @foreach ($users as $user)
                    @foreach($user->salfnyLogs as $slafny)
                    <tr class="{{ $user->id }} text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('dashboard.'.$user->user_type.'.show', $user->id) }}">
                                {{ $user->fullname }}
                            </a>
                           </td>
                        <td>{{ $user->phone }}</td>
{{--                        <td>--}}
{{--                            <div class="position-relative has-icon-left input-group form-group">--}}
{{--                                {!! Form::text("user_dept_to_app", $user->user_dept_to_app , ['class'=>"form-control form-control-sm user_dept_to_app",'aria-describedby' => "button-addon1" ,'placeholder'=>trans('dashboard.user.user_dept_to_app')]) !!}--}}
{{--                                <div class="form-control-position">--}}
{{--                                    <i class="feather icon-dollar-sign pt-3 text-primary"></i>--}}
{{--                                </div>--}}
{{--                                    <div class="input-group-append" id="button-addon1">--}}
{{--                                        <a href="javascript:void(0)" onclick="updateUserDept('{{ $user->id }}')" class="btn btn-primary btn-sm btn_change_dept d-flex align-items-center"><i class="feather icon-refresh-cw"></i></a>--}}
{{--                                    </div>--}}

{{--                            </div>--}}
{{--                        </td>--}}
                        <td>{{$slafny->amount}}</td>
                        <td>{{$slafny->paid_at?$slafny->paid_at->format("Y-m-d"):trans('dashboard.predecessor_service.not_paid')}}</td>
                        <td><div class="badge badge-violet badge-md mr-1 mb-1">{{ $slafny->created_at->format("Y-m-d") }}</div> </td>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    </div>
</div>
@include('dashboard.layout.notify_modal')
@endsection

@include('dashboard.predecessor_service.scripts')

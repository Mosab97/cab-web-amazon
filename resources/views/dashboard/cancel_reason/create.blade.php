@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.cancel_reason.add_cancel_reason') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.cancel_reason.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.cancel_reason.form',['current' => trans('dashboard.cancel_reason.add_cancel_reason')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

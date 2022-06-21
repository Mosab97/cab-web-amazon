@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.cancel_reason.edit_cancel_reason') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($cancel_reason,['route' => ['dashboard.cancel_reason.update',$cancel_reason->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.cancel_reason.form',['current' => trans('dashboard.cancel_reason.edit_cancel_reason')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

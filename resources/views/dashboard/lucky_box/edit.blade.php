@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.lucky_box.edit_lucky_box') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($lucky_box,['route' => ['dashboard.lucky_box.update',$lucky_box->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.lucky_box.form',['current' => trans('dashboard.lucky_box.edit_lucky_box')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

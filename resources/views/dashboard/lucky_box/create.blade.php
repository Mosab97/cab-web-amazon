@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.lucky_box.add_lucky_box') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.lucky_box.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.lucky_box.form',['current' => trans('dashboard.lucky_box.add_lucky_box')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

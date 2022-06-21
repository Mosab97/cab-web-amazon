@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.car.add_car') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.car.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.car.form',['current' => trans('dashboard.car.add_car')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

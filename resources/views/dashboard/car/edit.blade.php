@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.car.edit_car') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($car,['route' => ['dashboard.car.update',$car->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.car.form',['current' => trans('dashboard.car.edit_car')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

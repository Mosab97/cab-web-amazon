@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.car_model.edit_car_model') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($car_model,['route' => ['dashboard.car_model.update',$car_model->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.car_model.form',['current' => trans('dashboard.car_model.edit_car_model')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

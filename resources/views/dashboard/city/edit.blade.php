@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.city.edit_city') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($city,['route' => ['dashboard.city.update',$city->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.city.form',['current' => trans('dashboard.city.edit_city')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

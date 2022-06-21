@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.country.edit_country') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($country,['route' => ['dashboard.country.update',$country->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.country.form',['current' => trans('dashboard.country.edit_country')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

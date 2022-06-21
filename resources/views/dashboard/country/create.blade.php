@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.country.add_country') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.country.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.country.form',['current' => trans('dashboard.country.add_country')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

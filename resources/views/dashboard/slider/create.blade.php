@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.slider.add_slider') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.slider.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.slider.form',['current' => trans('dashboard.slider.add_slider')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

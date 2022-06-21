@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.slider.edit_slider') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($slider,['route' => ['dashboard.slider.update',$slider->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.slider.form',['current' => trans('dashboard.slider.edit_slider')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

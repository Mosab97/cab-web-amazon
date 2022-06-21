@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_package.add_point_package') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.point_package.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.point_package.form',['current' => trans('dashboard.point_package.add_point_package')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

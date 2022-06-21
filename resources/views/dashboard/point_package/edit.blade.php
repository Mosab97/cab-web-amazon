@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_package.edit_point_package') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($point_package,['route' => ['dashboard.point_package.update',$point_package->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.point_package.form',['current' => trans('dashboard.point_package.edit_point_package')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

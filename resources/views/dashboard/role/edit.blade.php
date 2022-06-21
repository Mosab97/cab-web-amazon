@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.role.edit_role') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($role,['route' => ['dashboard.role.update',$role->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.role.form',['current' => trans('dashboard.role.edit_role')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

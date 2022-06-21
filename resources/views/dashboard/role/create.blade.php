@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.role.add_role') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.role.store' , 'method' => 'POST' , 'files' => true , 'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.role.form',['current' => trans('dashboard.role.add_role')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

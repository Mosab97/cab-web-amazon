@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.invite_code.edit_invite_code') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($invite_code,['route' => ['dashboard.invite_code.update',$invite_code->id] , 'method' => 'PUT' , 'files' => true]) !!}
         @include('dashboard.invite_code.form',['btnSubmit' => trans('dashboard.general.edit')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

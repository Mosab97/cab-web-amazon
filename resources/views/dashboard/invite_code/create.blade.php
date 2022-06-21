@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.invite_code.add_invite_code') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.invite_code.store' , 'method' => 'POST' , 'files' => true]) !!}
         @include('dashboard.invite_code.form',['btnSubmit' => trans('dashboard.general.save')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

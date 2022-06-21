@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.driver.add_driver') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.driver.store' , 'method' => 'POST' , 'files' => true ]) !!}
         @include('dashboard.driver.form',['btnSubmit' => trans('dashboard.general.save'),'current' => trans('dashboard.driver.add_driver')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

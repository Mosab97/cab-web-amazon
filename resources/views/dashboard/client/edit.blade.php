@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.client.edit_client') !!}</h5>

    </div>
    <div class="card-body">
      {!! Form::model($client,['route' => ['dashboard.client.update',$client->id] , 'method' => 'PUT' , 'files' => true ]) !!}
         @include('dashboard.client.form',['btnSubmit' => trans('dashboard.general.save'),'current' => trans('dashboard.client.add_client')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.manager.edit_manager') !!}</h5>

    </div>
    <div class="card-body">
      {!! Form::model($manager,['route' => ['dashboard.manager.update',$manager->id] , 'method' => 'PUT' , 'files' => true ]) !!}
         @include('dashboard.manager.form',['btnSubmit' => trans('dashboard.general.save'),'current' => trans('dashboard.manager.add_manager')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.package.edit_package') !!}</h5>

    </div>
    <div class="card-body">
      {!! Form::model($package,['route' => ['dashboard.package.update',$package->id] , 'method' => 'PUT' , 'files' => true,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.package.form',['btnSubmit' => trans('dashboard.general.save'),'current' => trans('dashboard.package.add_package')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

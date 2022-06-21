@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.app_ad.edit_app_ad') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($app_ad,['route' => ['dashboard.app_ad.update',$app_ad->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.app_ad.form',['current' => trans('dashboard.app_ad.edit_app_ad')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.app_offer.edit_app_offer') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($app_offer,['route' => ['dashboard.app_offer.update',$app_offer->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.app_offer.form',['current' => trans('dashboard.app_offer.edit_app_offer')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

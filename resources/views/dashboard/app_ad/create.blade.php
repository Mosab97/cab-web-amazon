@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.app_ad.add_app_ad') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.app_ad.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.app_ad.form',['current' => trans('dashboard.app_ad.add_app_ad')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

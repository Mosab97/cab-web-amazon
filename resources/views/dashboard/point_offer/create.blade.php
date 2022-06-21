@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_offer.add_point_offer') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.point_offer.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.point_offer.form',['btnSubmit' => trans('dashboard.general.save')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

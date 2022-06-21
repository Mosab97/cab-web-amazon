@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.point_offer.edit_point_offer') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($point_offer,['route' => ['dashboard.point_offer.update',$point_offer->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.point_offer.form',['btnSubmit' => trans('dashboard.general.edit')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

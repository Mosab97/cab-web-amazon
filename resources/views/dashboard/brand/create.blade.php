@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.brand.add_brand') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.brand.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.brand.form',['current' => trans('dashboard.brand.add_brand')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

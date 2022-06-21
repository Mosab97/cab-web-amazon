@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.brand.edit_brand') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($brand,['route' => ['dashboard.brand.update',$brand->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.brand.form',['current' => trans('dashboard.brand.edit_brand')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

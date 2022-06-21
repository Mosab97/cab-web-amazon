@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.faq.edit_faq') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::model($faq,['route' => ['dashboard.faq.update',$faq->id] , 'method' => 'PUT' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale() ]) !!}
         @include('dashboard.faq.form',['current' => trans('dashboard.faq.edit_faq')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

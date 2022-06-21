@extends('dashboard.layout.layout')

@section('content')
<div class="card border-info">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{!! trans('dashboard.faq.add_faq') !!}</h5>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'dashboard.faq.store' , 'method' => 'POST' , 'files' => true ,'class' => 'steps-validation wizard-circle','data-locale' => app()->getLocale()]) !!}
         @include('dashboard.faq.form',['current' => trans('dashboard.faq.add_faq')])
      {!! Form::close() !!}
    </div>

</div>
@endsection

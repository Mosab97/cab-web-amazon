@extends('site.layout.layout')

@section('content')
    <section class="always-caberz mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="image">
                        <img src="{{ asset('landingAssets') }}/assets/always-caberz.png" alt="caberz">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="terms">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12">
                       <div class="bigTitle page-auto">
                           <div class="content">
                               <h2 class="text">{!! trans('land.header.terms') !!}</h2>
                           </div>
                       </div>
                       <div class="all-text">
                           <div class="content">
                               {!! setting('terms_'.app()->getLocale()) !!}
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>

@endsection

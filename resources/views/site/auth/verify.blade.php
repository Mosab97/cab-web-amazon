@extends('site.layout.layout')

@section('content')
    <!--Page Title-->
    <section class="page-title">
        <div id="particles-js" class="particles-pattern"></div>
        <div class="auto-container">
            <!-- Section Icons -->
            <div class="section-icons">
                <!-- Icon One -->
                <div class="icon-one" style="background-image:url({{ asset('landingAssets') }}/images/icons/icon-6.png)"></div>
                <!-- Icon Two -->
                <div class="icon-two" style="background-image:url({{ asset('landingAssets') }}/images/icons/icon-7.png)"></div>
                <!-- Icon Three -->
                <div class="icon-three" style="background-image:url({{ asset('landingAssets') }}/images/icons/icon-8.png)"></div>
                <!-- Icon Four -->
                <div class="icon-four" style="background-image:url({{ asset('landingAssets') }}/images/icons/icon-9.png)"></div>
                <!-- Icon Five -->
                <div class="icon-five" style="background-image:url({{ asset('landingAssets') }}/images/icons/icon-10.png)"></div>
                <!-- Icon Six -->
                <div class="icon-six" style="background-image:url({{ asset('landingAssets') }}/images/icons/icon-6.png)"></div>
            </div>
            <div class="inner-container clearfix">
                <div class="pull-right">
                    <h2>التسجيل كشريك</h2>
                </div>
                <div class="pull-left">
                    <ul class="bread-crumb clearfix">
                        <li><a href="{!! route('site.home') !!}">{!! trans('landing.main') !!}</a></li>
                        <li>التسجيل كشريك</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Waves Container-->
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->
    </section>
    <!--End Page Title-->

    <!-- Services Section Three -->
    <section class="contact-page-section">
      <div class="auto-container">
        <div class="sec-title centered">
            <h2>تسجيل كشريك</h2>
            <div class="box-loader">
              <span></span>
              <span></span>
              <span></span>
            </div>
        </div>

        <div class="inner-container">
            <!-- Contact Form -->
            <div class="contact-form">
                {!! Form::open(['route' => ['site.auth.send_code',$provider_id],'id' => 'resend_code_form','class' => 'mb-5','method' => 'POST']) !!}
                <div class="row">
                    <div class="col-8 offset-md-2 d-flex justify-content-between">
                        <span>{{ trans('landing.auth.resend_code_qestion') }}</span>
                        <a onclick="document.getElementById('resend_code_form').submit();" class="">
                            <u>{{ trans('landing.auth.resend_code') }}</u>
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(['route' => ['site.auth.verify_store',$provider_id],'method' => 'POST','id' => 'example-form', 'novalidate' => 'novalidate']) !!}
                <div class="row clearfix">
                    <div class="col-sm-6 offset-md-3">
                        <div class="row justify-content-between">
                            <div class="col-sm-3">
                                {!! Form::text('verify_code[]', null, ['class' => 'form-control form-control-lg rounded text-center' ,"maxLength" => "1",'autocomplete' => "off", 'style' => 'border: 1px solid #43a355;']) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('verify_code[]', null, ['class' => 'form-control form-control-lg rounded text-center' ,"maxLength" => "1",'autocomplete' => "off", 'style' => 'border: 1px solid #43a355;']) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('verify_code[]', null, ['class' => 'form-control form-control-lg rounded text-center' ,"maxLength" => "1",'autocomplete' => "off", 'style' => 'border: 1px solid #43a355;']) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('verify_code[]', null, ['class' => 'form-control form-control-lg rounded text-center' ,"maxLength" => "1",'autocomplete' => "off", 'style' => 'border: 1px solid #43a355;']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 text-center form-group mt-5">
                        <button class="theme-btn btn-style-two" type="submit"><span class="txt">تفعيل الحساب</span></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
   </section>
    <!-- End Services Section Three -->
@endsection

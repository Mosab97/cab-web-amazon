@extends('site.layout.layout')

@section('content')
    <!--Page Title-->
    <div class="success-page d-flex justify-content-center clearfix">

    <div class="container">

        <div class="success-content">

            <h1><i class="fa fa-check"></i></h1>

            <p>{!! trans('landing.auth.welcome_title') !!}</p>

            <p>{!! trans('landing.auth.welcome_body') !!}</p>

        </div>

    </div>



</div>
    <!-- End Services Section Three -->
@endsection
@section('styles')
    <style>

    .success-page {
        height: 80vh;
        padding-top: 20vh;
        align-items: center;
        text-align: center;
    }

    .success-page .success-content h1{
       font-size: 6rem;
       background-color: #43a355;
       width: 150px;
       height: 150px;
       border-radius: 50%;
       display: flex;

       justify-content: center;

       align-items: center;

       color: #fff;

       margin: 0 auto;

       margin-bottom: 50px;

    }

    .success-page .success-content p{

        color: #43a355;

        font-weight: 600;

        font-size: 18px;

        width: 85%;

        margin: 15px auto;

    }

</style>
@endsection

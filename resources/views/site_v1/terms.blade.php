@extends('site.layout.layout')

@section('content')

    <div class="main">

        <section class="terms">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="top-tit">
                            <h3>الشروط والاحكام</h3>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        {!! setting('terms_'.app()->getLocale()) !!}
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

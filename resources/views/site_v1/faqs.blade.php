
@extends('site.layout.layout')

@section('content')
    <div class="main">

        <section class="terms">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="top-tit">
                            <h3> الأسئلة الشائعة </h3>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-5">
                        <div id="accordion">
                            @foreach($faqs as $index => $faq)
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $index }}">
                                            {{$faq->name}}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-{{ $index }}" class="panel-collapse collapse in">
                                    <div class="card-body">
                                        <p>{{$faq->desc}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>

@endsection

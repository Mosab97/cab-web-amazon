
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
                                <h2 class="text">{!! trans('land.header.faqs') !!}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="accordion">
                            @foreach($faqs as $index => $faq)
                          <div class="card">
                            <div class="card-header" id="heading_{{ $index }}">
                              <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{ $index }}" aria-expanded="{{ $loop->first ? true : false }}" aria-controls="collapse_{{ $index }}">
                                  {{ $faq->name }}
                                </button>
                              </h5>
                          </div>
                          <div id="collapse_{{ $index }}" class="collapse {{ $loop->first ? 'show' : null }}" aria-labelledby="heading_{{ $index }}" data-parent="#accordion">
                              <div class="card-body">
                                    {{ $faq->desc }}
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

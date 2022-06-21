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
                        <li><a href="{!! route('site.home') !!}">الرئيسية</a></li>
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
                    {!! Form::open(['route' => 'site.register.store','method' => 'POST','files' => true,'id' => 'example-form', 'novalidate' => 'novalidate']) !!}
                    <div class="row clearfix">
                			@foreach (array_chunk(config('translatable.locales'),1) as $chunk)
                			<div class="col-lg-6 col-md-6 col-sm-12 form-group">
                				@foreach ($chunk as $locale)
                                    <div class="form-group">
                				        {!! Form::text("store[$locale][name]", null, ['class' => 'form-control rounded','placeholder' => trans('dashboard.'.$locale.'.store')]) !!}
                                    </div>

                                    <div class="form-group">
                				        {!! Form::text("store[$locale][cuisine_type]", null, ['class' => 'form-control rounded','placeholder' => trans('dashboard.'.$locale.'.cuisine_type')]) !!}
                                    </div>
                				@endforeach
                			</div>
                			@endforeach
                		</div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                            {!! Form::select('store[country_id]', $countries, null , ['class' => 'select2 w-100 rounded' , 'placeholder' => trans('dashboard.country.country') ,'onchange' => 'getRegion(this.value)']) !!}
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 form-group region">

                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 form-group city">

                        </div>

                        <div class="col-md-6">
                            <div class="file-upload">
                                <div class="file-upload-select">
                                    <div class="file-select-button" >اختر ملف  ..</div>
                                <div class="file-select-name">اختر ملف السجل التجاري ..</div>
                                <input type="file" name="store[commercial_registeration]" id="file-upload-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            {!! Form::select('store[category_id]', $categories, null , ['class' => 'select2 w-100 rounded', 'placeholder' => trans('dashboard.store_category.store_category')]) !!}
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            {!! Form::text('store[number_of_branches]', null, ['placeholder' => trans('dashboard.store.number_of_branches'),'class' => 'form-control rounded']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            {!! Form::text('store[website_url]', null, ['placeholder' => trans('dashboard.store.website_url'),'class' => 'form-control rounded']) !!}
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex radio_awady">
                                <div class="text-qu">
                                    <p class="text">{!! trans('dashboard.store.part_of_franchise') !!}</p>
                                </div>
                                <div class="d-flex">
                                    <div class="form-check">
                                        {!! Form::radio('store[part_of_franchise]', 1, null, ["class" => "custom-control-input",'id' => 'part_of_franchise_yes']) !!}
                                        <label class="custom-control-label" for="part_of_franchise_yes">
                                        نعم
                                      </label>
                                    </div>
                                    <div class="form-check">
                                        {!! Form::radio('store[part_of_franchise]', 0, null, ["class" => "custom-control-input",'id' => 'part_of_franchise_no']) !!}
                                        <label class="custom-control-label" for="part_of_franchise_no">
                                        لا
                                      </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex radio_awady">
                                <div class="text-qu">
                                    <p class="text">{!! trans('dashboard.store.provide_delivery_service') !!} </p>
                                </div>
                                <div class="d-flex">
                                    <div class="form-check">
                                        {!! Form::radio('store[provide_delivery_service]', 1, null, ["class" => "custom-control-input",'id' => 'provide_delivery_service_yes']) !!}
                                        <label class="custom-control-label" for="provide_delivery_service_yes">
                                        نعم
                                      </label>
                                    </div>
                                    <div class="form-check">
                                        {!! Form::radio('store[provide_delivery_service]', 0, null, ["class" => "custom-control-input",'id' => 'provide_delivery_service_no']) !!}
                                        <label class="custom-control-label" for="provide_delivery_service_no">
                                        لا
                                      </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex radio_awady">
                                <div class="text-qu">
                                    <p class="text">{!! trans('dashboard.store.on_another_delivery_app') !!}</p>
                                </div>
                                <div class="d-flex">
                                    <div class="form-check">
                                      {!! Form::radio('store[on_another_delivery_app]', 1, null, ["class" => "custom-control-input",'id' => 'on_another_delivery_app_yes']) !!}
                                      <label class="custom-control-label" for="on_another_delivery_app_yes">
                                        نعم
                                      </label>
                                    </div>
                                    <div class="form-check">
                                        {!! Form::radio('store[on_another_delivery_app]', 0, null, ["class" => "custom-control-input",'id' => 'on_another_delivery_app_no']) !!}
                                        <label class="custom-control-label" for="on_another_delivery_app_no">
                                        لا
                                      </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 form-group">
            				{!! Form::text('store[lat]', null, ['id' => 'lat', 'class' => 'form-control','readonly']) !!}
            			</div>
                        <div class="col-md-6 col-12 form-group">
            				{!! Form::text('store[lng]', null , ['id' => 'lng', 'class' => 'form-control','readonly']) !!}
            			</div>

                		<div class="col-md-6 col-12 form-group">
            				{!! Form::text('store[location]', null , [ 'class' => "form-control" ,'id' => "searchBox" , 'placeholder' => trans('dashboard.map.write_your_location_address')]) !!}
                		</div>

                        <div class="col-12 form-group">
                            <div class="height-400 mb-2" id="map" style="height:400px;"></div>
                        </div>


                        <div class="col-lg-12">
                            <div class="sec-title centered">
                                <h2>أدخل بيانات التواصل</h2>
                                <div class="box-loader">
                                  <span></span>
                                  <span></span>
                                  <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                            {!! Form::text('seller[fullname]', null, ['class' => 'form-control rounded','placeholder' => trans('dashboard.user.fullname')]) !!}
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                            {!! Form::text('seller[email]', null, ['class' => 'form-control rounded','placeholder' => trans('dashboard.general.email')]) !!}
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                            {!! Form::text('seller[phone]', null, ['class' => 'form-control rounded','placeholder' => trans('dashboard.general.phone')]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 text-center form-group">
                            <button class="theme-btn btn-style-two" type="submit" name="submit-form"><span class="txt">تسجيل الان</span></button>
                        </div>

                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
   </section>
    <!-- End Services Section Three -->
@endsection
@section('scripts')
    @include('site.auth.form_map')
    <script>
        let fileInput = document.getElementById("file-upload-input");
        let fileSelect = document.getElementsByClassName("file-upload-select")[0];
        fileSelect.onclick = function() {
            fileInput.click();
        }
        fileInput.onchange = function() {
        let filename = fileInput.files[0].name;
        let selectName = document.getElementsByClassName("file-select-name")[0];
        selectName.innerText = filename;
    }
    function getRegion(countryId) {
        $('.region').html(``);
        $('.city').html(``);
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('ajax/get_regions_or_cities_by_country') }}/" + countryId,
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data['value'] == 1) {
                    $('.region').html(data['view']);
                }
            }
        });
    }

    function getCity(regionId) {
        $('.city').html(``);
        $.ajax({
            url: "{{ LaravelLocalization::localizeUrl('ajax/get_cities_by_region') }}/" + regionId,
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data['value'] == 1) {
                    $('.city').html(data['view']);
                }
            }
        });
    }
    </script>
@endsection

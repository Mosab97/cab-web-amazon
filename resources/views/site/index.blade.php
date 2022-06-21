@extends('site.layout.layout')

@section('content')
@include('site.slider')
      <!-- always caberz-->
      <section class="always-caberz">
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

      <!-- Header -->
      <div class="header"></div>

      <!-- Screens -->
      <section class="screens">

          <!--app screen-->
          <div class="app-screen" id="app-screen">
              <div class="bigTitle screen-tit">
                  <div class="content">
                      <h2 class="text">شاشات التطبيق</h2>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="screen-item wow fadeInDown" data-wow-delay="0.3s" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/screen3.png">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="screen-item wow fadeInDown" data-wow-delay="0.6s" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/screen1.png">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="screen-item wow fadeInDown" data-wow-delay="0.9s" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/screen2.png">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="screen-item wow fadeInDown" data-wow-delay="1.2s" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/screen4.png">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="screen-item wow fadeInDown" data-wow-delay="1.5s" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/screen5.png">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="screen-item wow fadeInDown" data-wow-delay="1.8s" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/screen6.png">
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- More Info -->
          <section class="sub_sction">
              <div class="bigTitle">
                  <div class="content">
                      <h2 class="text">معلومات أكثر عن | كاب</h2>
                  </div>
              </div>

              <p class="para">تعرف علي شروط الاشتراك في تطبيق كاب</p>

              <div class="container">
                  <div class="row justify-content-between">
                      <div class="col-lg-5">
                          <div class="screen wow fadeInRight" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/pic1.png">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>

                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('landingAssets') }}/assets/pic2.png">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>

                      <div class="col-lg-5">
                          <div class="screen wow fadeInRight" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image1.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>

                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image2.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>
                      
                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image3.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>
                      
                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image4.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>
                      
                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image5.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>
                      
                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image6.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>
                      
                      <div class="col-lg-5">
                          <div class="screen wow fadeInLeft" data-wow-duration="1s">
                              <img src="{{ asset('storage/images/website/image15.jpeg') }}">
                              {{-- <div class="descreption">
                                  <p class="para thin">نص افتراضي توضيحي</p>
                              </div> --}}
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Media -->
          <section class="sub_sction">
              <div class="bigTitle">
                  <div class="content">
                      <h2 class="text">ميديا كاب</h2>
                  </div>
              </div>

              <p class="para">شروط استخدام التطبيق والاعلانات</p>

              <div class="container">
                  <div class="row justify-content-between">
                      <div class="col-lg-5">
                          <div class="screen wow bounceInRight" data-wow-duration="1s">
                              <div class="video">
                                  <!--<img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                                  <video class="videoToPlay" src="{{ asset('storage/files/website/video1.mp4') }}" controls>
                  Your browser does not support the video tag.
                </video>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-5">
                          <div class="screen wow bounceInLeft" data-wow-duration="1s">
                              <div class="video">
                                  <!--<img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                                  <video class="videoToPlay" src="{{ asset('storage/files/website/website.mp4') }}" controls>
                  Your browser does not support the video tag.
                </video>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-5">
                          <div class="screen wow bounceInLeft" data-wow-duration="1s">
                              <div class="video">
                                  <!--<img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                                  <video class="videoToPlay" src="{{ asset('storage/files/website/website4.mp4') }}" controls>
                  Your browser does not support the video tag.
                </video>
                              </div>
                          </div>
                      </div>
                <!--      <div class="col-lg-5">-->
                <!--          <div class="screen wow bounceInLeft" data-wow-duration="1s">-->
                <!--              <div class="video">-->
                                  <!--<img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                <!--                  <video class="videoToPlay" src="{{ asset('storage/files/website/video2.mp4') }}" controls>-->
                <!--  Your browser does not support the video tag.-->
                <!--</video>-->
                <!--              </div>-->
                <!--          </div>-->
                <!--      </div>-->
                <!--      <div class="col-lg-5">-->
                <!--          <div class="screen wow bounceInRight" data-wow-duration="1s">-->
                <!--              <div class="video">-->
                <!--                  <img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                <!--                  <video class="videoToPlay" src="{{ asset('landingAssets') }}/assets/screen_4.mp4" controls>-->
                <!--  Your browser does not support the video tag.-->
                <!--</video>-->
                <!--              </div>-->
                <!--          </div>-->
                <!--      </div>-->
                <!--      <div class="col-lg-5">-->
                <!--          <div class="screen wow bounceInLeft" data-wow-duration="1s">-->
                <!--              <div class="video">-->
                <!--                  <img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                <!--                  <video class="videoToPlay" src="{{ asset('landingAssets') }}/assets/screen_4.mp4" controls>-->
                <!--  Your browser does not support the video tag.-->
                <!--</video>-->
                <!--              </div>-->
                <!--          </div>-->
                <!--      </div>-->
                <!--      <div class="col-lg-5">-->
                <!--          <div class="screen wow bounceInRight" data-wow-duration="1s">-->
                <!--              <div class="video">-->
                <!--                  <img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                <!--                  <video class="videoToPlay" src="{{ asset('landingAssets') }}/assets/screen_4.mp4" controls>-->
                <!--  Your browser does not support the video tag.-->
                <!--</video>-->
                <!--              </div>-->
                <!--          </div>-->
                <!--      </div>-->
                <!--      <div class="col-lg-5">-->
                <!--          <div class="screen wow bounceInLeft" data-wow-duration="1s">-->
                <!--              <div class="video">-->
                <!--                  <img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                <!--                  <video class="videoToPlay" src="{{ asset('landingAssets') }}/assets/screen_4.mp4" controls>-->
                <!--  Your browser does not support the video tag.-->
                <!--</video>-->
                <!--              </div>-->
                <!--          </div>-->
                <!--      </div>-->
                  </div>
              </div>
          </section>
      </section>

      <!-- Who Are We -->
      <section class="whoAreWe">
          <div class="whoAreWe_skew">
              <div class="row">
                  <div class="col-md-6 col-12">
                      <div class="item">
                          <div class="big_circle">
                              <div class="small_circle">
                                  <div class="text">من نحن</div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6 d-md-block d-none">
                      <div class="item">
                          <img src="{{ asset('landingAssets') }}/assets/screen_last.png" alt="">
                      </div>
                  </div>
              </div>
          </div>

          <div class="anouncment">
              <p>بداية نحمد الله عزوجّل </p>
              <p>أن منحنا الهام وفكر ومميزات قد تكون هي أهم مكاسبنا</p>
              <p>في تطبيق كاب فالمكسب الحقيقي هو ان نكون اول من </p>
              <p>من يتخذ تلك المميزات والمبادرات في تطبيقات التوصـــيل</p>
          </div>

          <ul>
              <li>
                  <img src="{{ asset('landingAssets') }}/assets/dot.png">
                  <p>اول تطبيق سعودي 100% يهتم بمراعاة وضع المعيشة وزيادة فرص الدخل ويهدف الى كون تطبيق كيبـرز مصدر دخل ثابت لا غناه عنه وخاصة في ضل ارتفاع الأسعار في الوقت الراهن حيث انه يعد اول تطبيق يلغي مفهوم النسبة نهائيا ويساعد على استفادة فئة عالية
                      جدا من خدمات التطبيق مقابل مبلغ اشتراك شهري رمزي بل ولم يقف الى هذا الحد فقط بل أيضا راعي ظروف مستخدمين برامج التوصيل وساعدهم على حل اكبر هاجس واكبر تخوف كان لديهم وهو عدم معرفتهم بأسعار رحلاتهم مما جعل البعض منهم يمر ويكون في
                      أوضاع حرجه وذلك بسبب عدم المامه بقيمة رحلته حيث يتفاجأمن سعر قيمة رحلته حتى يصل الحالفي بعض الأحيان ان يكون المبلغ الذي بحوزته لا يكفي لقيمة رحلته مما يجعله في موقف حرج جدا لذلك اهتم تطبيق كاب في هذه الحالة جدا وكما قام بتيسير
                      الأمور على الكباتن أيضا لم ينسى فئة مستخدمين برامج التوصيل بل ساعدهم أيضا على معرفة قيمةرحلاتهم وذلك بان يقوم الراكب بتحديد قيمة رحلته حسب ما يراه مناسب له وحسب ما يكون مناسب لميزانية الراكب وباتفاق بين اطراف الرحلة الكابتن والراكب
                      وبذلك يكون تطبيق كيبـرز قد انصف جميع الأطراف وهو متقيد بمبدأ ثابت فقط الا وهو ( قليل دائم ولا كثيرا منقطع ) </p>
              </li>

              <li>
                  <img src="{{ asset('landingAssets') }}/assets/dot.png">
                  <p>اول تطبيق سعودي اهتم بفئه قد تكون همشت تماما ومنعت من حقها في العمل في مجال تطبيقات التوصيل او الاستفادة منها وهي ذوي الاحتياجات الخاصة فقد منحهم تطبيق كاب الاشتراك اما كابتن بدون رسوم مجانا مدى الحياة او راكب وذلك بمنحهم رصيد مجاني
                      بمبلغ (30) ريال شهريا تضاف لهم في محافظهم)
                  </p>
              </li>

              <li>
                  <img src="{{ asset('landingAssets') }}/assets/dot.png">
                  <p>اول تطبيق سعودي يهتم بمعرفه الحالة الصحية للكباتن والركاب وتلزمهم بذكر الحالة الصحية واثباتها عن طريق تطبيق (توكلنا) سواء الكابتن او الراكب في ضل الظروف الراهنة </p>
              </li>
          </ul>
      </section>


      <!-- how To Use -->
      <section class="howToUse">
          <div class="big_circle">
              <div class="small_circle">
                  <div class="text">طريقة الاستخدام</div>
              </div>
          </div>


          <div class="screens_inside">
              <div class="screen">
                  <img class="icon" src="{{ asset('landingAssets') }}/assets/use_1.png">
                  <div class="video">
                      <!--<img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                      <video class="videoToPlay" src="{{ asset('storage/files/website/video3.mp4') }}" controls>
            Your browser does not support the video tag.
          </video>
                  </div>
              </div>

              <img class="cut" src="{{ asset('landingAssets') }}/assets/cut.png">

              <div class="screen">
                  <img class="icon" src="{{ asset('landingAssets') }}/assets/use_2.png">
                  <div class="video">
                      <!--<img class="preview" src="{{ asset('landingAssets') }}/assets/screen_1.jpg">-->
                      <video class="videoToPlay" src="{{ asset('storage/files/website/video4.mp4') }}" controls>
            Your browser does not support the video tag.
          </video>
                  </div>
              </div>
          </div>
      </section>

      <!-- Contact -->
      <section class="contact" id="contact-us">
          <ul>
              <li>
                  <span><img src="{{ asset('landingAssets') }}/assets/location.png"></span>
                  <div class="text">
                      <p>العنوان |</p>
                      <p>المملكة العربية السعودية</p>
                  </div>
              </li>
              <li>
                  <span><img src="{{ asset('landingAssets') }}/assets/location.png"></span>
                  <div class="text">
                      <p>البريد الالكتروني |</p>
                      <p>{{ setting('email') }}</p>
                  </div>
              </li>
              <li>
                  <span><img src="{{ asset('landingAssets') }}/assets/location.png"></span>
                  <div class="text">
                      <p>الهاتف |</p>
                      <p>{{ setting('phone') }}</p>
                  </div>
              </li>
          </ul>
      </section>
@endsection

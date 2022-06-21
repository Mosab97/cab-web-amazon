@extends('site.layout.layout')

@section('content')

<div class="main">

    <!--hero section start-->
    <section class="ptb-100 bg-image overflow-hidden" image-overlay="8">
        <div class="background-image-wraper" style="background: url('{{ asset('landingAssets') }}/assets/img/cta-bg.png'); opacity: 1;"></div>
        <div class="hero-bottom-shape-two" style="background: url('{{ asset('landingAssets') }}/assets/img/wave-shap.svg')no-repeat bottom center"></div>
        <div class="effect-1 opacity-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 361.1 384.8" style="enable-background:new 0 0 361.1 384.8;" xml:space="preserve"
                class="injected-svg svg_img dark-color">
                <path d="M53.1,266.7C19.3,178-41,79.1,41.6,50.1S287.7-59.6,293.8,77.5c6.1,137.1,137.8,238,15.6,288.9 S86.8,355.4,53.1,266.7z"></path>
            </svg>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-lg-between justify-content-md-center justify-content-sm-center">
                <div class="col-md-12 col-lg-6">
                    <div class="hero-slider-content text-white py-5">
                        <h1 class="text-white">الوصول إلى أي مكان بسهولة </h1>
                        <p class="lead">{{ setting('about_'.app()->getLocale()) }}</p>

                        <div class="action-btns mt-4">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ setting('app_store_app') }}" class="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                        <span class="fab fa-apple icon-size-sm ml-3"></span>
                                        <div class="download-text text-right">
                                            <small>تحميل عبر</small>
                                            <h5 class="mb-0">متجر ابل</h5>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ setting('g_play_app') }}" class="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                        <span class="fab fa-google-play icon-size-sm ml-3"></span>
                                        <div class="download-text text-right">
                                            <small>عبر تحميل</small>
                                            <h5 class="mb-0">متجر جوجل</h5>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ setting('huawei_store_app') }}" class="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                        {{-- <span class="fab fa-google-play icon-size-sm ml-3"></span> --}}
                                        <img src="{{ asset('dashboardAssets') }}/images/icons/huawei_logo.png" class="ml-2" style="width: 30px;" alt="huawei_logo">

                                        <div class="download-text text-right">
                                            <small>عبر تحميل</small>
                                            <h5 class="mb-0">متجر هواوي</h5>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <div class="img-wrap">
                        <img src="{{ asset('landingAssets') }}/assets/img/hero5-app.png" alt="app image" class="img-fluid">
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
            <div class="logoo">
                <img src="{{ asset('storage/images/website/caberz-logo.jpeg') }}">
            </div>
    </section>
    <!--hero section end-->
    
    <!--info caberz-->
    
    <section class="promo-section ptb-100 position-relative overflow-hidden">
        <div class="effect-2 opacity-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 463.6 616" style="enable-background:new 0 0 463.6 616;" xml:space="preserve"
                class="injected-svg svg_img dark-color">
                <path d="M148.4,608.3C25.7,572.5-3.5,442.2,0.3,375.8s24.8-117,124.8-166.5s125.7-77.4,165-129.6 c43.2-57.4,96.5-94.4,127.9-73c63,43,53.9,280,14,358s-68.9,75.5-98.9,118.7S271,644,148.4,608.3z"></path>
            </svg>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <div class="section-heading">
                        <h4>معلومات اكثر عن كاب</h4>
                        <p>تعرف على شروط الاشتراك في تطبيق كاب </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="info-caberz">
                        <img src="{{ asset('storage/images/website/img1.jpeg') }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="info-caberz">
                        <img src="{{ asset('storage/images/website/img2.jpeg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>    
    
    <!--info caberz-->
    
    <!--media caberz-->
    
    <section class="promo-section ptb-100 position-relative overflow-hidden">
        <div class="effect-2 opacity-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 463.6 616" style="enable-background:new 0 0 463.6 616;" xml:space="preserve"
                class="injected-svg svg_img dark-color">
                <path d="M148.4,608.3C25.7,572.5-3.5,442.2,0.3,375.8s24.8-117,124.8-166.5s125.7-77.4,165-129.6 c43.2-57.4,96.5-94.4,127.9-73c63,43,53.9,280,14,358s-68.9,75.5-98.9,118.7S271,644,148.4,608.3z"></path>
            </svg>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <div class="section-heading">
                        <h4>ميديا تطبيق كاب</h4>
                        <p>تعرف على عروض وطريقة استخدام تطبيق كاب </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/luck.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/luck.mp4') }}" type="video/ogg">
                        </video>
                        <h5>عجله الحظ والنصيب تحمل جوائز للجميع بعد انهاء الرحلات</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/competion.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/competion.mp4') }}" type="video/ogg">
                        </video>
                        <h5>كاب # يطلق اضخم مسابقات تطبيقات التوصيل للكباتن والركاب</h5>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/handcap.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/handcap.mp4') }}" type="video/ogg">
                        </video>
                        <h5>مبادرات تطبيق كاب لذوي الاحتياجات الخاصه</h5>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/ambassdor.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/ambassdor.mp4') }}" type="video/ogg">
                        </video>
                        <h5>خلك سفير كاب واحصل على دخل اضافي شهريا</h5>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/ambassdor.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/ambassdor.mp4') }}" type="video/ogg">
                        </video>
                        <h5>الان يمكنك الاعلان مع # كاب</h5>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/about-captin.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/about-captin.mp4') }}" type="video/ogg">
                        </video>
                        <h5>نبذه عن تطبيق كاب ومميزاته للكباتن</h5>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/about-user.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/about-user.mp4') }}" type="video/ogg">
                        </video>
                        <h5>نبذه عن فكره تطبيق كاب ومميزاته للعملاء</h5>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="media-caberz">
                        <video controls>
                          <source src="{{ asset('storage/files/website/info.mp4') }}" type="video/mp4">
                          <source src="{{ asset('storage/files/website/info.mp4') }}" type="video/ogg">
                        </video>
                        <h5>مميزات تطبيق كاب (1)</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--media caberz-->

    <!--promo section start-->
    <!--<section class="promo-section ptb-100 position-relative overflow-hidden">-->
    <!--    <div class="effect-2 opacity-1">-->
    <!--        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 463.6 616" style="enable-background:new 0 0 463.6 616;" xml:space="preserve"-->
    <!--            class="injected-svg svg_img dark-color">-->
    <!--            <path d="M148.4,608.3C25.7,572.5-3.5,442.2,0.3,375.8s24.8-117,124.8-166.5s125.7-77.4,165-129.6 c43.2-57.4,96.5-94.4,127.9-73c63,43,53.9,280,14,358s-68.9,75.5-98.9,118.7S271,644,148.4,608.3z"></path>-->
    <!--        </svg>-->
    <!--    </div>-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-7 col-md-10">-->
    <!--                <div class="section-heading">-->
    <!--                    <h2>سنساعدك على بناء تطبيق جميل</h2>-->
    <!--                    <p>الوصول إلى أي مكان بسهولة </p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-6 col-lg-3">-->
    <!--                <div class="card border-0 single-promo-card single-promo-hover-2 p-2 mt-4">-->
    <!--                    <div class="card-body">-->
    <!--                        <div class="pb-2">-->
    <!--                            <span class="fas fa-concierge-bell icon-size-md color-secondary"></span>-->
    <!--                        </div>-->
    <!--                        <div class="pt-2 pb-3">-->
    <!--                            <h5></h5>-->
    <!--                            <p class="mb-0">تم تصميم جميع المكونات لاستخدامها معًا.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-6 col-lg-3">-->
    <!--                <div class="card border-0 single-promo-card single-promo-hover-2 p-2 mt-4">-->
    <!--                    <div class="card-body">-->
    <!--                        <div class="pb-2">-->
    <!--                            <span class="fas fa-window-restore icon-size-md color-secondary"></span>-->
    <!--                        </div>-->
    <!--                        <div class="pt-2 pb-3">-->
    <!--                            <h5></h5>-->
    <!--                            <p class="mb-0">تم تحسين التطبيق للعمل مع معظم الأجهزة.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-6 col-lg-3">-->
    <!--                <div class="card border-0 single-promo-card single-promo-hover-2 p-2 mt-4">-->
    <!--                    <div class="card-body">-->
    <!--                        <div class="pb-2">-->
    <!--                            <span class="fas fa-sync-alt icon-size-md color-secondary"></span>-->
    <!--                        </div>-->
    <!--                        <div class="pt-2 pb-3">-->
    <!--                            <h5></h5>-->
    <!--                            <p class="mb-0">حافظ على الاتساق أثناء تطوير الميزات الجديدة.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-6 col-lg-3">-->
    <!--                <div class="card border-0 single-promo-card single-promo-hover-2 p-2 mt-4">-->
    <!--                    <div class="card-body">-->
    <!--                        <div class="pb-2">-->
    <!--                            <span class="fas fa-bezier-curve icon-size-md color-secondary"></span>-->
    <!--                        </div>-->
    <!--                        <div class="pt-2 pb-3">-->
    <!--                            <h5></h5>-->
    <!--                            <p class="mb-0">تغيير بعض المتغيرات والتكيف مع الموضوع بأكمله.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--promo section end-->

    <!--about us section start-->
    <section id="about" class="about-us ptb-100 position-relative gray-light-bg">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between justify-content-md-center">
                <div class="col-md-5 col-lg-4">
                    <div class="about-content-right">
                        <img src="{{ asset('landingAssets') }}/assets/img/app-mobile-image-2.png" alt="about us" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-12 col-lg-7">
                    <div class="about-content-left section-heading">
                        <h2>من نحن.</h2>

                        <ul class="check-list-wrap pt-3">
                            <li><strong> </strong>((بدايتا نحمد المولى عز وجل ان منحنا الهام وفكر ومميزات قد تكون هي اهم مكاسبنا في تطبيق كاب فالمكسب الحقيقي هو ان نكون اول من يتخذ تلك المميزات والمبادرات في تطبيقات التوصيل بشكل كامل وهي: –</li>
                            <li><strong> </strong> اول تطبيق سعودي 100% يهتم بمراعاة وضع المعيشة وزيادة فرص الدخل ويهدف الى كون تطبيق كيبـرز مصدر دخل ثابت لا غناه عنه وخاصة في ضل ارتفاع الأسعار في الوقت الراهن حيث انه يعد اول تطبيق يلغي مفهوم النسبة
                                نهائيا ويساعد على استفادة فئة عالية جدا من خدمات التطبيق مقابل مبلغ اشتراك شهري رمزي
                                بل ولم يقف الى هذا الحد فقط بل أيضا راعي ظروف مستخدمين برامج التوصيل وساعدهم على حل اكبر هاجس واكبر تخوف كان لديهم وهو عدم معرفتهم بأسعار رحلاتهم مما جعل البعض منهم يمر ويكون في أوضاع حرجه وذلك بسبب عدم المامه بقيمة
                                رحلته حيث يتفاجأ من سعر قيمة رحلته حتى يصل الحال في بعض الأحيان ان يكون المبلغ الذي بحوزته لا يكفي لقيمة رحلته مما يجعله في موقف حرج جدا لذلك اهتم تطبيق كاب في هذه الحالة جدا وكما قام بتيسير الأمور على الكباتن أيضا
                                لم ينسى فئة مستخدمين برامج التوصيل بل ساعدهم أيضا على معرفة قيمة رحلاتهم وذلك بان يقوم الراكب بتحديد قيمة رحلته حسب ما يراه مناسب له وحسب ما يكون مناسب لميزانية الراكب وباتفاق بين اطراف الرحلة الكابتن والراكب وبذلك
                                يكون تطبيق كيبـرز قد انصف جميع الأطراف وهو متقيد بمبدأ ثابت فقط الا وهو ( قليل دائم ولا كثيرا منقطع )
                                – </li>
                            <li><strong> </strong>اول تطبيق سعودي يهتم بمعرفه الحالة الصحية للكباتن والركاب وتلزمهم بذكر الحالة الصحية واثباتها عن طريق تطبيق (توكلنا) سواء الكابتن او الراكب في ضل الظروف الراهنة. – </li>
                            <li><strong> </strong>اول تطبيق سعودي اهتم بفئه قد تكون همشت تماما ومنعت من حقها في العمل في مجال تطبيقات التوصيل او الاستفادة منها وهي ذوي الاحتياجات الخاصة فقد منحهم تطبيق كاب الاشتراك اما كابتن بدون رسوم مجانا مدى
                                الحياة او راكب وذلك بمنحهم رصيد مجاني بمبلغ (30) ريال شهريا تضاف لهم في محافظهم)) – </li>
                        </ul>
                        <!--<div class="action-btns mt-4">-->
                        <!--    <a href="#" class="btn btn-brand-02 mr-3">ابدأ الان</a>-->
                        <!--    <a href="#" class="btn btn-outline-brand-02">تعلم المزيد</a>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--about us section end-->

    <!--features section start-->
    <!--<section id="features" class="feature-section ptb-100 gray-light-bg">-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-md-9 col-lg-8">-->
    <!--                <div class="section-heading text-center mb-5">-->
    <!--                    <h2>مميزات التطبيق</h2>-->
    <!--                    <p class="text-muted para-desc mb-0 mx-auto">ابدأ العمل مع ذلك يمكن أن يوفر كل ما تحتاجه لتوليد الوعي ، وزيادة حركة المرور ، والاتصال. تحويل القيمة الدقيقة بكفاءة مع المحتوى الذي يركز على العميل. إعادة تعريف السوق بشكل نشيط.-->
    <!--                    </p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            end col-->
    <!--        </div>-->
    <!--        end row-->

    <!--        <div class="row align-items-center">-->
    <!--            <div class="col-lg-8 col-md-12">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-md-6 col-12">-->
    <!--                        <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">-->
    <!--                            <span class="ti-layout p-3 ml-4 mt-1 rounded-circle float-right"></span>-->
    <!--                            <div class="features-single-content d-block overflow-hidden">-->
    <!--                                <h5 class="mb-2">اتاحة خدمة سلفني والتي لم يسبق ان وجدت هذه الخدمة في التطبيقات الأخرى وهي كالتالي:</h5>-->
    <!--                                <p>عندك رحلة وما معك قيمتها او رصيدك 5 ريال او اقل روح للمحفظة الخاصة فيك واضغط على زر سلفني وراح تنضاف لك 15 ريال وروح رحلتك ومتى ما رجعتها تقدر تستخدم سلفني مرة ثانيه يعني سددها وخذها ثاني في رحلتك </p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="col-md-6 col-12">-->
    <!--                        <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">-->
    <!--                            <span class="ti-themify-favicon-alt p-3 ml-4 mt-1 rounded-circle float-right"></span>-->
    <!--                            <div class="features-single-content d-block overflow-hidden">-->
    <!--                                <h5 class="mb-2">اتاحة خدمة حولي وهي كالتالي:</h5>-->
    <!--                                <p>عندك رحلة وناقصك فلوس او فلوسك ما تكفي قيمة الرحلة اطلب من أحد زملائك يحولك رصيد وروح رحلتك </p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="col-md-6 col-12">-->
    <!--                        <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">-->
    <!--                            <span class="ti-eye p-3 ml-4 mt-1 rounded-circle float-right"></span>-->
    <!--                            <div class="features-single-content d-block overflow-hidden">-->
    <!--                                <h5 class="mb-2">عندك رحلة وناقصك فلوس او فلوسك ما تكفي قيمة الرحلة اطلب من أحد زملائك يحولك رصيد وروح رحلتك </h5>-->
    <!--                                <p>عندك رحلة وفلوسك ما تكفي تقدر تستبدل نقاطك برصيد في محفظتك وكمل رحلتك لان أي رحلة تقومون فيها راح تنضاف لكم فيها نقاط</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="col-md-6 col-12">-->
    <!--                        <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">-->
    <!--                            <span class="ti-thumb-up p-3 ml-4 mt-1 rounded-circle float-right"></span>-->
    <!--                            <div class="features-single-content d-block overflow-hidden">-->
    <!--                                <h5 class="mb-2">كود صالح</h5>-->
    <!--                                <p>خليك سفير معنا وأرسل كود الدعوة الخاص بك وذلك عن طريق دعوة صديق-->
    <!--                                    ادخل على حسابي ثم دعوة صديق ثم قم بنسخ الكود او الرسالة عن طريق الواتس-->
    <!--                                    واحصل على رصيد مالي في محفظتك يمكنك الاستفادة منه كما تريد-->
    <!--                                    ** عند تسجيل أي كابتن بالكود الخاص بك ستحصل على رصيد بقيمة (10) ريال-->
    <!--                                    ** عند تسجيل أي عميل بالكود الخاص بك ستحصل على رصيد بقيمة (3) ريال-->
    <!--                                </p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="col-md-6 col-12">-->
    <!--                        <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">-->
    <!--                            <span class="ti-mobile p-3 ml-4 mt-1 rounded-circle float-right"></span>-->
    <!--                            <div class="features-single-content d-block overflow-hidden">-->
    <!--                                <h5 class="mb-2">مكافاتك كاب للنقاط بالنسبة للراكب وهي كالتالي</h5>-->
    <!--                                <p>** عند تجميع العميل للنقاط سواء من كود الدعوة او من خلال الرحلات التي قام بها اومن خلال عمليات الشحن التي قام بها يستطيع حينها ان يستبدل نقاطة برصيد مبلغ مالي في المحفظة الخاصة به يستطيع من خلاله العميل عمل رحله-->
    <!--                                    او سداد سلفني او تحويل رصيد لزملائه.</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="col-md-6 col-12">-->
    <!--                        <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">-->
    <!--                            <span class="ti-world p-3 ml-4 mt-1 rounded-circle float-right"></span>-->
    <!--                            <div class="features-single-content d-block overflow-hidden">-->
    <!--                                <h5 class="mb-2">مكافاتك كاب للنقاط بالنسبة للكباتن وهي كالتالي:</h5>-->
    <!--                                <p>عند تجميع الكابتن للنقاط سواء من كود الدعوة او من خلال الرحلات التي قام بها يستطيع حينها ان يستبدل نقاطة برصيد مبلغ مالي في المحفظة الخاصة به يستطيع الكابتن من خلاله دفع رسوم الباقة او تحويله الى حسابه الشخصي او-->
    <!--                                    سداد قيمة العمولة للرحلات.</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div class="col-lg-4 col-md-4 col-12">-->
    <!--                <img src="{{ asset('landingAssets') }}/assets/img/app-mobile-image.png" class="img-fluid mx-auto d-lg-block d-none" alt="app screen">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--features section end-->

    <!--video with download start-->
    <!--<section class="position-relative overflow-hidden ptb-100">-->
    <!--    <div class="mask-65"></div>-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-md-9 col-lg-8">-->
    <!--                <div class="section-heading text-center text-white">-->
    <!--                    <h2 class="text-white">منصة التطبيقات الأكثر استخدامًا</h2>-->
    <!--                    <p>ابدأ العمل مع ذلك يمكن أن يوفر كل ما تحتاجه لتوليد الوعي ، وزيادة حركة المرور ، والاتصال. تحويل القيمة الدقيقة بكفاءة مع المحتوى الذي يركز على العميل.</p>-->
    <!--                </div>-->
    <!--                <div class="video-promo-content my-5 pb-4">-->
    <!--                    <a href="https://www.youtube.com/watch?v=9No-FiEInLA" class="popup-youtube video-play-icon text-center m-auto"><span class="ti-control-play"></span> </a>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--end col-->
    <!--        </div>-->
            <!--end row-->
    <!--        <div class="row justify-content-md-center justify-content-sm-center">-->
    <!--            <div class="col-sm-4 col-md-4 col-12">-->
    <!--                <div class="bg-white p-5 rounded text-center shadow mt-lg-0 mt-4">-->
    <!--                    <div class="icon-text-wrap">-->
    <!--                        <i class="fab fa-apple icon-size-md color-primary mb-2"></i>-->
    <!--                        <h5>متجر آبل</h5>-->
    <!--                    </div>-->
    <!--                    <div class="p-20px">-->
    <!--                        <p class="m-0px">تعزيز التقارب الذي تم بحثه بالكامل والموارد التفاعلية لإدارة البيانات بسلاسة.</p>-->
    <!--                        <a class="btn btn-brand-02 btn-sm btn-rounded" href="{{ setting('app_store_app') }}">تحميل الان</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-sm-4 col-md-4 col-12">-->
    <!--                <div class="bg-white p-5 rounded text-center shadow mt-lg-0 mt-4">-->
    <!--                    <div class="icon-text-wrap">-->
    <!--                        <i class="fab fa-google-play icon-size-md color-primary mb-2"></i>-->
    <!--                        <h5>تطبيقات جوجل</h5>-->
    <!--                    </div>-->
    <!--                    <div class="p-20px">-->
    <!--                        <p class="m-0px">تعزيز التقارب الذي تم بحثه بالكامل والموارد التفاعلية لإدارة البيانات بسلاسة.</p>-->
    <!--                        <a class="btn btn-brand-02 btn-sm btn-rounded" href="{{ setting('g_play_app') }}">تحميل الان</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-sm-4 col-md-4 col-12">-->
    <!--                <div class="bg-white p-5 rounded text-center shadow mt-lg-0 mt-4">-->
    <!--                    <div class="icon-text-wrap">-->
    <!--                        {{-- <i class="fab fa-google-play icon-size-md color-primary mb-2"></i> --}}-->
    <!--                        <img src="{{ asset('dashboardAssets') }}/images/icons/huawei_logo.png" style="width: 45px;" alt="huawei_logo">-->
    <!--                        <h5>متجر هواوي</h5>-->
    <!--                    </div>-->
    <!--                    <div class="p-20px">-->
    <!--                        <p class="m-0px">تعزيز التقارب الذي تم بحثه بالكامل والموارد التفاعلية لإدارة البيانات بسلاسة.</p>-->
    <!--                        <a class="btn btn-brand-02 btn-sm btn-rounded" href="{{ setting('huawei_store_app') }}">تحميل الان</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--video with download end-->

    <!--usage section start-->
    <section class="usage-section ptb-100 position-relative overflow-hidden">
        <div class="effect-2 opacity-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 463.6 616" style="enable-background:new 0 0 463.6 616;" xml:space="preserve"
                class="injected-svg svg_img dark-color">
                <path d="M148.4,608.3C25.7,572.5-3.5,442.2,0.3,375.8s24.8-117,124.8-166.5s125.7-77.4,165-129.6 c43.2-57.4,96.5-94.4,127.9-73c63,43,53.9,280,14,358s-68.9,75.5-98.9,118.7S271,644,148.4,608.3z"></path>
            </svg>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-heading text-center mb-5">
                        <h2>طريقة الاستخدام</h2>
                        <p>- طريقة الاستخدام: سواء للكابتن او الراكب
                            أولا: طريقة استخدام واستقبال الكابتن للرحلات كالتالي:
                            -عند وصول اشعار بطلب جديد بأعلى الشاشة عليكم حينها الذهاب الى الصفحة الخاصة بالطلبات الجديدة وسحب الشاشة للأسفل لتحديث الصفحة.
                            -سوف يظهر لك الطلب الجديد عليكم الضغط على الطلب ومعرفة تفاصيله ومن ثم قبوله أو تقديم عرض سعر مناسب لكم للعميل.
                            -عند اختياركم من قبل العميل سوف يظهر لكم اشعار يفيد بانه تم اختياركم كابتن للرحلة من قبل العميل.
                            -حينها عليكم الضغط على خيار متابعة طلباتي وستجدون الطلب نقوم بالضغط على الطلب وسوف يظهر بانكم في الطريق للعميل.
                            -عند وصولكم للعميل حينها نقوم بالضغط على خيار بدء الرحلة وإبلاغ العميل بقبول بدء الرحلة والانطلاق بالرحلة وستلاحظون حينها في الطلب بان الرحلة جاريه.
                            -عند الانتهاء من الرحلة وتوصيل العميل نقوم بالضغط على خيار انهاء الرحلة وسيظهر للعميل انهاء الرحلة وتقييم الكابتن.
                            وهكذا بالنسبة للطلبات الأخرى والجديدة

                            ** ملاحظة مهمه للكباتن **
                            عليكم التأكد من التالي:
                            -التأكد من قبولكم ووصول اشعار يفيد بانه تم قبولكم
                            -التأكد من تحميل اخر نسخه للتطبيق
                            -التأكد من وضع موقع التطبيق اثناء استخدام التطبيق
                            -التأكد من اختيار باقة من الباقات المتوفرة الشهرية
                            -عدم تسجيل الخروج من التطبيق بل اختيار احدى الخيارات التالية:
                            متاح: ذلك يعني تفرغكم للتطبيق بحيث يمكنكم استقبال الطلبات والاشعارات الخاصة بها
                            غير متاح: وذلك عدم تفرغكم للتطبيق وذلك يمنع وصول الاشعارات الخاصة بالطلبات
                        </p>
                    </div>
                </div>
            </div>
            <!--<div class="row">-->
            <!--    <div class="col-md-6 col-lg-4">-->
            <!--        <div class="video-section">-->
            <!--            <div class="videoWrapper videoWrapper169 js-videoWrapper">-->
            <!--                <iframe class="videoIframe js-videoIframe" src="" data-src="https://www.youtube.com/embed/VnZFpsa1yRI" frameborder="0" allowfullscreen></iframe>-->
            <!--                <button class="videoPoster btn js-videoPoster" style="background-image:url('{{ asset('landingAssets') }}/assets/img/1.png');"></button>-->
            <!--            </div>-->
            <!--            <button class="close-video" onclick="videoStop()">-->
            <!--                عوده-->
            <!--            </button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-6 col-lg-4">-->
            <!--        <div class="video-section">-->
            <!--            <div class="videoWrapper videoWrapper169 js-videoWrapper">-->
            <!--                <iframe class="videoIframe js-videoIframe" src="" data-src="https://www.youtube.com/embed/hAf-_unkzTg" frameborder="0" allowfullscreen></iframe>-->
            <!--                <button class="videoPoster btn js-videoPoster" style="background-image:url('{{ asset('landingAssets') }}/assets/img/1.png');"></button>-->
            <!--            </div>-->
            <!--            <button class="close-video" onclick="videoStop()">-->
            <!--                عوده-->
            <!--            </button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-6 col-lg-4">-->
            <!--        <div class="video-section">-->
            <!--            <div class="videoWrapper videoWrapper169 js-videoWrapper">-->
            <!--                <iframe class="videoIframe js-videoIframe" src="" data-src="https://www.youtube.com/embed/jmqcfbiiVDw" frameborder="0" allowfullscreen></iframe>-->
            <!--                <button class="videoPoster btn js-videoPoster" style="background-image:url('{{ asset('landingAssets') }}/assets/img/1.png');"></button>-->
            <!--            </div>-->
            <!--            <button class="close-video" onclick="videoStop()">-->
            <!--                عوده-->
            <!--            </button>-->
            <!--        </div>-->
            <!--    </div>-->


            <!--    <div class="col-md-6 col-lg-4">-->
            <!--        <div class="video-section">-->
            <!--            <div class="videoWrapper videoWrapper169 js-videoWrapper">-->
            <!--                <iframe class="videoIframe js-videoIframe" src="" data-src="https://www.youtube.com/embed/GgH_NdBu8co" frameborder="0" allowfullscreen></iframe>-->
            <!--                <button class="videoPoster btn js-videoPoster" style="background-image:url('{{ asset('landingAssets') }}/assets/img/1.png');"></button>-->
            <!--            </div>-->
            <!--            <button class="close-video" onclick="videoStop()">-->
            <!--                عوده-->
            <!--            </button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-6 col-lg-4">-->
            <!--        <div class="video-section">-->
            <!--            <div class="videoWrapper videoWrapper169 js-videoWrapper">-->
            <!--                <iframe class="videoIframe js-videoIframe" src="" data-src="https://www.youtube.com/embed/oFGiO_jcV9U" frameborder="0" allowfullscreen></iframe>-->
            <!--                <button class="videoPoster btn js-videoPoster" style="background-image:url('{{ asset('landingAssets') }}/assets/img/1.png');"></button>-->
            <!--            </div>-->
            <!--            <button class="close-video" onclick="videoStop()">-->
            <!--                عوده-->
            <!--            </button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-6 col-lg-4">-->
            <!--        <div class="video-section">-->
            <!--            <div class="videoWrapper videoWrapper169 js-videoWrapper">-->
            <!--                <iframe class="videoIframe js-videoIframe" src="" data-src="https://www.youtube.com/embed/XcXgqiQoMEE" frameborder="0" allowfullscreen></iframe>-->
            <!--                <button class="videoPoster btn js-videoPoster" style="background-image:url('{{ asset('landingAssets') }}/assets/img/1.png');"></button>-->
            <!--            </div>-->
            <!--            <button class="close-video" onclick="videoStop()">-->
            <!--                عوده-->
            <!--            </button>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--</div>-->
        </div>
    </section>
    <!--usage section end-->

    <!--screenshots section start-->
    <section id="screenshots" class="screenshots-section pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                    <div class="section-heading text-center mb-5">
                        <h2>شاشات التطبيق</h2>
                        <p>يمكنك الاطلاع على شاشات تطبيق كاب.</p>
                    </div>
                </div>
            </div>
            start app screen carousel
            <div class="screenshot-wrap">
                <div class="screenshot-frame"></div>
                <div class="screen-carousel owl-carousel owl-theme dot-indicator">
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/1.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/2.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/3.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/4.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/5.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/6.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/7.png" class="img-fluid" alt="screenshots" />
                    <img src="{{ asset('landingAssets') }}/assets/img/SCREENS/8.png" class="img-fluid" alt="screenshots" />
                </div>
            </div>
            <!--end app screen carousel-->
        </div>
    </section>


    <!--screenshots section end-->

    <!--our contact section start-->
    <section id="contact" class="contact-us-section ptb-100">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-12 pb-3 message-box d-none">
                    <div class="alert alert-danger"></div>
                </div>
                <div class="col-md-12 col-lg-5 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                    <div class="con-img">
                        <img src="{{ asset('landingAssets') }}/assets/img/home-banner-img.png" class="img-fluid mx-auto d-lg-block d-none">
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="contact-us-content">
                        <ul class="contact-info-list">
                            <li class="d-flex pb-3">
                                <div class="contact-icon ml-3">
                                    <span class="fas fa-location-arrow color-primary rounded-circle p-3"></span>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1">العنوان</h5>
                                    <p>
                                        المملكة العربية السعودية , المدينة المنورة
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex pb-3">
                                <div class="contact-icon ml-3">
                                    <span class="fas fa-envelope color-primary rounded-circle p-3"></span>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1">البريد الالكتروني</h5>
                                    <p>
                                        {{ setting('email') }}
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex pb-3">
                                <div class="contact-icon ml-3">
                                    <span class="fas fa-phone color-primary rounded-circle p-3 feat-icon"></span>
                                </div>
                                <div class="contact-text">
                                    <h5 class="mb-1 cont-tit">الهاتف</h5>
                                    <p class="cont-desc">
                                        <a href="tel:054899555">{{ setting('phone') }}</a>
                                    </p>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--our contact section end-->



</div>

@endsection

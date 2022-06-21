<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from layerdrops.com/zimed/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Mar 2020 10:29:15 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ setting('project_name') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('landingAssets') }}/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('landingAssets') }}/images/fav.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('landingAssets') }}/images/fav.png">
    <link rel="manifest" href="{{ asset('landingAssets') }}/images/fav.png">

    <!-- plugin scripts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/bootstrap-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/zimed-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/jquery.bxslider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingAssets') }}/css/magnific-popup.css">
    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('landingAssets') }}/css/responsive.css">

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div><!-- /.preloader -->
    <div class="page-wrapper">

        <header class="main-nav__header-one ">
            <nav class="header-navigation stricky">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="main-nav__logo-box">
                        <a href="{!! route('home') !!}" class="main-nav__logo">
                            <img src="{{ asset('landingAssets') }}/images/22.png" width="50" alt="{{ setting('project_name') }}" />

                        </a>
                        <a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i>
                            <!-- /.smpl-icon-menu --></a>
                    </div>
                    <!-- /.logo-box -->
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="main-nav__main-navigation">
                        <ul class="one-page-scroll-menu main-nav__navigation-box">
                            <li class="current scrollToLink">
                                <a href="index.html">الرئيسية</a>
                            </li>
                            <li class="scrollToLink">
                                <a href="#features">المميزات</a>
                            </li>
                            <li class="scrollToLink">
                                <a href="#app-shots">شاشات التطبيق</a>
                            </li>

                            <li class="scrollToLink">
                                <a href="#contact">تواصل معنا</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
        </header><!-- /.main-nav__header-one -->
        <section class="banner-one" id="banner" style="background-image: url({{ asset('landingAssets') }}/images/background/banner-bg-1-1.png);">

            <img src="{{ asset('landingAssets') }}/images/shapes/banner-shapes-1-1.png" alt="" class="banner-one__shape-1">
            <img src="{{ asset('landingAssets') }}/images/shapes/banner-shapes-1-2.png" alt="" class="banner-one__shape-2">

            <img src="{{ asset('landingAssets') }}/images/shapes/banner-shapes-1-4.png" alt="" class="banner-one__shape-4">
            <img src="{{ asset('landingAssets') }}/images/shapes/banner-shapes-1-5.png" alt="" class="banner-one__shape-5">

            <div class="container">
                <img src="{{ asset('landingAssets') }}/images/shapes/banner-shapes-1-3.png" alt="" class="banner-one__shape-moc-1">
                <img src="{{ asset('landingAssets') }}/images/mocs/banner-moc-1-1.png" alt="" class="banner-one__moc">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="banner-one__content">
                            <h3>تطبيق {{ setting('project_name') }}</h3>
                            <p>{!! app()->getLocale() == 'ar' ? setting('desc_ar') : setting('desc_en') !!}</p>
                            <a href="{{ setting('g_play_app') }}" class="thm-btn cta-one__btn"><i class="fab fa-google-play"></i> android</a>
                            <!-- /.thm-btn cta-one__btn -->
                            <a href="{{ setting('app_store_app') }}" class="thm-btn cta-one__btn"><i class="fab fa-apple"></i> ios</a>
                            <!-- /.thm-btn cta-one__btn -->
                        </div>
                        <!-- /.banner-one__content -->
                    </div>
                    <!-- /.col-lg-7 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>


        <section class="service-one" id="features">
            <img src="{{ asset('landingAssets') }}/images/shapes/cta-2-shape-1.png" alt="" class="cta-two__shape-1">
            <img src="{{ asset('landingAssets') }}/images/shapes/banner-shapes-1-4.png" alt="" class="banner-one__shape-4">
            <div class="container">
                <div class="block-title text-center">
                    <span class="block-title__bubbles"></span>
                    <p>مميزات التطبيق</p>
                    <h3>افضل التطبيقات التى تحتاجها</h3>
                </div><!-- /.block-title -->
                <div class="row">
                    <div class="service-one__col wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                        <div class="service-one__single">
                            <i class="zimed-icon-responsive"></i>
                            <h3>تثبيت مجاني</h3>
                        </div><!-- /.service-one__single -->
                    </div><!-- /.service-one__col -->
                    <div class="service-one__col wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="service-one__single">
                            <i class="zimed-icon-computer-graphic"></i>
                            <h3>الوصول السريع</h3>
                        </div><!-- /.service-one__single -->
                    </div><!-- /.service-one__col -->
                    <div class="service-one__col wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="service-one__single">
                            <i class="zimed-icon-development1"></i>
                            <h3>ادارة المستخدمين</h3>
                        </div><!-- /.service-one__single -->
                    </div><!-- /.service-one__col -->
                    <div class="service-one__col wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="service-one__single">
                            <i class="zimed-icon-development"></i>
                            <h3>مؤمنة بالكامل</h3>
                        </div><!-- /.service-one__single -->
                    </div><!-- /.service-one__col -->
                    <div class="service-one__col wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                        <div class="service-one__single">
                            <i class="zimed-icon-development"></i>
                            <h3>التحديث اليومي</h3>
                        </div><!-- /.service-one__single -->
                    </div><!-- /.service-one__col -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.service-one -->

        <div class="cta-three">
            <img src="{{ asset('landingAssets') }}/images/shapes/cta-1-shape-2.png" alt="" class="cta-three__shape-2">
            <img src="{{ asset('landingAssets') }}/images/shapes/cta-1-shape-3.png" alt="" class="cta-three__shape-3">
            <div class="container">
                <img src="{{ asset('landingAssets') }}/images/shapes/cta-2-shape-1.png" alt="" class="cta-two__shape-1">
                <img src="{{ asset('landingAssets') }}/images/shapes/cta-2-shape-2.png" alt="" class="cta-two__shape-2">
                <img src="{{ asset('landingAssets') }}/images/shapes/cta-1-shape-1.png" alt="" class="cta-three__shape-1">
                <img src="{{ asset('landingAssets') }}/images/mocs/banner-moc-1.png" alt="" class="cta-three__moc">
                <div class="row justify-content-start">
                    <div class="col-lg-6">
                        <div class="cta-three__content">
                            <div class="block-title text-left">
                                <span class="block-title__bubbles"></span>
                                <p>مميزات التطبيق</p>
                                <h3>تحكم في كل شي عن طريق تطبيق واحد</h3>
                            </div>
                            <!-- /.block-title -->
                            <div class="cta-three__box-wrap">
                                <div class="cta-three__box">
                                    <div class="cta-three__box-icon">
                                        <i class="zimed-icon-strategy"></i>
                                    </div>
                                    <!-- /.cta-three__box-icon -->
                                    <div class="cta-three__box-content">
                                        <h3>بيع منتجاتك بكل سهولة</h3>
                                        <p>يمكنك التطبيق من اضافة اعلانات بكل سهولة والوصول الى عشرات المشتريين وترويج منتجاتك بكل سهولة</p>
                                    </div>
                                    <!-- /.cta-three__box-content -->
                                </div>
                                <!-- /.cta-three__box -->
                                <div class="cta-three__box">
                                    <div class="cta-three__box-icon">
                                        <i class="zimed-icon-training"></i>
                                    </div>
                                    <!-- /.cta-three__box-icon -->
                                    <div class="cta-three__box-content">
                                        <h3>خاصية الاشعارات</h3>
                                        <p>كن على ثقة واطمأن من عدم تفويت اى اخبار جديد او شىء داخل التطبيق بسبب خاصية الاشعارات التى تبقيك على اطلاع دائم بكل مايدور داخل التطبيق</p>
                                    </div>
                                    <!-- /.cta-three__box-content -->

                                </div>
                                <!-- /.cta-three__box -->
                            </div>
                            <!-- /.cta-three__box-wrap -->
                        </div>
                        <!-- /.cta-three__content -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.cta-three -->

        <section class="app-shot-one" id="app-shots">
            <img src="{{ asset('landingAssets') }}/images/shapes/contact-shape-3.png" alt="" class="app-shot__shape-1">
            <img src="{{ asset('landingAssets') }}/images/shapes/contact-shape-2.png" alt="" class="app-shot__shape-2">

            <div class="container-fluid">
                <div class="block-title text-center">
                    <span class="block-title__bubbles"></span>
                    <p>واجهة التطبيق</p>
                    <h3>شاشات التطبيق</h3>
                </div>
                <!-- /.block-title -->
                <div class="app-shot-one__carousel thm__owl-carousel owl-theme owl-carousel" data-options='{ "loop": true, "rtl": true , "margin": 43, "nav": false, "dots": true, "autoWidth": false, "autoplay": true, "smartSpeed": 700, "autoplayTimeout": 5000, "autoplayHoverPause": true, "slideBy": 5, "responsive": { "0": { "items": 1 }, "480": { "items": 2 }, "600": { "items": 3 }, "991": { "items": 4 }, "1000": { "items": 5 }, "1200": { "items": 5 } } }'>
                    <div class="item">
                        <img src="{{ asset('landingAssets') }}/images/screens/advertiser-page.png" alt="">
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <img src="{{ asset('landingAssets') }}/images/screens/conversation.png" alt="">
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <img src="{{ asset('landingAssets') }}/images/screens/splash.png" alt="">
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <img src="{{ asset('landingAssets') }}/images/screens/notification.png" alt="">
                    </div>
                    <div class="item">
                      <img src="{{ asset('landingAssets') }}/images/screens/more.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingAssets') }}/images/screens/terms.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingAssets') }}/images/screens/terms2.png" alt="">
                    </div>
                </div>
                <!-- /.app-shot-one__carousel owl-theme owl-carousel -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.app-shot-one -->

        <section class="contact-one" id="contact">
            <img src="{{ asset('landingAssets') }}/images/shapes/contact-shape-1.png" alt="" class="contact-one__shape-1">
            <img src="{{ asset('landingAssets') }}/images/shapes/contact-shape-2.png" alt="" class="contact-one__shape-2">
            <img src="{{ asset('landingAssets') }}/images/shapes/contact-shape-3.png" alt="" class="contact-one__shape-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-one__content">
                            <div class="contact-one__infos">
                                <div class="block-title">
                                    <span class="block-title__bubbles"></span>
                                    <p>تواصل معنا</p>
                                    <h3>تواصل معنا</h3>
                                </div>
                                <!-- /.block-title -->
                                <div class="contact-one__infos-single">
                                    <div class="contact-one__infos-icon">
                                        <i class="zimed-icon-placeholder"></i>
                                    </div>
                                    <!-- /.contact-one__infos-icon -->
                                    <div class="contact-one__infos-content">
                                        <h3>{{ trans('dashboard.social.address') }}</h3>
                                        <p>{{ setting('address') }}</p>
                                    </div>
                                    <!-- /.contact-one__infos-content -->
                                </div>
                                <!-- /.contact-one__infos-single -->
                                <div class="contact-one__infos-single">
                                    <div class="contact-one__infos-icon">
                                        <i class="zimed-icon-message"></i>
                                    </div>
                                    <!-- /.contact-one__infos-icon -->
                                    <div class="contact-one__infos-content">
                                        <h3>{!! trans('dashboard.general.email') !!}</h3>
                                        <p><a href="mailto:{{ setting('email') }}">{{ setting('email') }}</a></p>
                                    </div>
                                    <!-- /.contact-one__infos-content -->
                                </div>
                                <!-- /.contact-one__infos-single -->
                                <div class="contact-one__infos-single">
                                    <div class="contact-one__infos-icon">
                                        <i class="zimed-icon-phone-call"></i>
                                    </div>
                                    <!-- /.contact-one__infos-icon -->
                                    <div class="contact-one__infos-content">
                                        <h3>{!! trans('dashboard.general.phone') !!}</h3>
                                        <p><a href="tel:{{ setting('phone') }}">{{ setting('phone') }}</a></p>
                                    </div>
                                    <!-- /.contact-one__infos-content -->
                                </div>
                                <!-- /.contact-one__infos-single -->
                            </div>
                            <!-- /.contact-one__infos -->
                        </div>
                        <!-- /.contact-one__content -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="left-img">
                            <img src="{{ asset('landingAssets') }}/images/mocs/banner-moc-2.png">
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.contact-one -->

        <section class="cta-one">
            <div class="container">
                <div class="cta-one__circle-1"></div>
                <!-- /.cta-one__circle-1 -->
                <div class="cta-one__circle-2"></div>
                <!-- /.cta-one__circle-2 -->
                <div class="cta-one__circle-3"></div>
                <!-- /.cta-one__circle-3 -->
                <div class="cta-one__content text-center">
                    <h3> حمل التطبيق الأن </h3>
                    <a href="{{ setting('g_play_app') }}" class="thm-btn cta-one__btn cta-one__btn2"><i class="fab fa-google-play"></i> android</a>
                    <!-- /.thm-btn cta-one__btn -->
                    <a href="{{ setting('app_store_app') }}" class="thm-btn cta-one__btn cta-one__btn2"><i class="fab fa-apple"></i> ios</a>
                    <!-- /.thm-btn cta-one__btn -->
                </div>
                <!-- /.cta-one__content -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.cta-one -->

        <footer class="site-footer">
            <img src="{{ asset('landingAssets') }}/images/shapes/footer-shape-3.png" class="site-footer__shape-3" alt="">
            <div class="site-footer__bottom">
                <div class="container">
                    <div class="inner-container">
                        <div class="site-footer__social">
                            <a class="fab fa-facebook-f" href="{{ setting('facebook') }}"></a>
                            <a class="fab fa-twitter" href="{{ setting('twitter') }}"></a>
                            <a class="fab fa-instagram" href="{{ setting('instagram') }}"></a>
                            <a class="fab fa-pinterest-p" href="{{ setting('pinterest') }}"></a>
                        </div><!-- /.site-footer__social -->
                        <p>جميع الحقوق محفوظة &copy; لموقع {{ setting('project_name') }}</p>
                    </div><!-- /.inner-container -->
                </div><!-- /.container -->
            </div><!-- /.site-footer__bottom -->
        </footer><!-- /.site-footer -->

    </div><!-- /.page-wrapper -->
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>



    <div class="side-menu__block">


        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">

                <a href="#" class="side-menu__toggler side-menu__close-btn"><img src="{{ asset('landingAssets') }}/images/shapes/close-1-1.png" alt=""></a>
            </div><!-- /.side-menu__top -->


            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->


    <script src="{{ asset('landingAssets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/TweenMax.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.easing.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/waypoints.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/wow.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.bxslider.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('landingAssets') }}/js/jquery.ajaxchimp.min.js"></script>
    <!-- template scripts -->
    <script src="{{ asset('landingAssets') }}/js/theme.js"></script>
</body>



<!-- Mirrored from layerdrops.com/zimed/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Mar 2020 10:29:15 GMT -->

</html>

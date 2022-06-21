<!--header section start-->
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top my-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('site.home') }}">
                <img src="{{ asset('landingAssets') }}/assets/img/logo%20white.png" alt="logo" class="img-fluid" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>

            <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto menu">
                    <li><a href="{!! route('site.home') !!}" class=""> الرئيسية</a>
                    </li>
                    <li><a href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#about" class="page-scroll">من نحن</a></li>
                    <!--<li><a href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#features" class="page-scroll">المميزات</a></li>-->
                    <li><a href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#screenshots" class="page-scroll">شاشات التطبيق</a></li>
                    <li><a href="{!! route('site.terms') !!}" class="page-scroll">الشروط والاحكام</a></li>
                    <li><a href="{!! route('site.faqs') !!}" class="page-scroll">الاسئلة الشائعة </a></li>
                    <li><a href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#contact" class="page-scroll">تواصل معنا</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--header section end-->

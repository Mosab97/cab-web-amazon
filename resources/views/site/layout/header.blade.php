
<!-- navbar -->
       <nav class="navbar navbar-expand-lg">
           <div class="container">
               <a class="navbar-brand" href="{{ route('site.home') }}">
                   <img src="{{ asset('landingAssets') }}/assets/m-logo.png" />
               </a>
               <button class="navbar-toggler" id="nav-men" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
   </button>

               <div class="collapse navbar-collapse s-nav trans" id="s-nav">
                   <ul class="navbar-nav">
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('site.home') }}">{!! trans('land.header.home') !!}</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#about-us">{!! trans('land.header.who') !!}</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#app-screen">{!! trans('land.header.screens') !!}</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('site.terms') }}">{!! trans('land.header.terms') !!}</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('site.policy') }}">{!! trans('land.header.policy') !!}</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('site.faqs') }}">{!! trans('land.header.faqs') !!}</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ request()->route()->getName() == 'site.home' ? '' : route('site.home') }}#contact-us">{!! trans('land.header.contact_us') !!}</a>
                       </li>
                   </ul>
                   <div class="men-cl dis">
                       <i class="fa fa-times" aria-hidden="true"></i>
                   </div>
               </div>
               <div class="logo-left">
                   <img src="{{ asset('landingAssets') }}/assets/logo2.png">
               </div>
           </div>
       </nav>

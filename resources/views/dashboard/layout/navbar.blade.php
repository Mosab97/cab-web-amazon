<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-dark navbar-shadow">
    <div class="navbar-wrapper" style="height: 62px;">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                        <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                        <!--     i.ficon.feather.icon-menu-->
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('dashboard/get_profile') }}" data-toggle="tooltip" data-placement="top">
                                <i>{!! trans('dashboard.messages.welcome',['name' => optional(auth()->user())->fullname]) !!}</i>
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('dashboard.setting.index') }}" data-toggle="tooltip" data-placement="top" title="{!! trans('dashboard.setting.setting') !!}"><i class="ficon feather icon-settings"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{!! route('dashboard.order.index') !!}?order_status=pending" data-toggle="tooltip" data-placement="top" title="{!! trans('dashboard.order.pending_orders') !!}"><i class="ficon feather icon-shopping-cart"></i></a></li>
                        {{-- <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="CheckIfTempBalance()" data-toggle="tooltip" data-placement="top" title="{!! trans('dashboard.general.remove_temp_balance') !!}"><i class="ficon feather icon-clock"></i></a></li> --}}

                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @continue($localeCode == LaravelLocalization::getCurrentLocale())
                        <a class="nav-link" data-language="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <i class="flag-icon flag-icon-{{ $localeCode == 'en' ? 'us' : 'sa' }}"></i>
                                {{ $properties['native'] }}
                        </a>
                        @endforeach
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" id="layout-mode">
                            <i class="ficon feather icon-sun" onclick="changeMode()"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>


                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                        <div class="search-input">
                            <form method="get" action="{!! LaravelLocalization::localizeUrl('dashboard/search') !!}">
                                <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                                <input type="text" name="search" class="input autocomplete_general" onkeypress="getSearch(this.value,'.search_section')" tabindex="-1" placeholder="{!! trans('dashboard.general.search') !!}" autocomplete="off">
                                <div class="search-input-close"><i class="feather icon-x"></i></div>
                                <ul class="search-list search-list-main search_section border-info"></ul>
                            </form>
                        </div>
                    </li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up notify_count">{{ auth()->user()->unreadnotifications()->count() }}</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white notify_count" id="notify_counter">{{ auth()->user()->unreadnotifications()->count() }}</h3><span class="notification-title">{!! trans('dashboard.notification.notifications') !!}</span>
                                </div>
                            </li>
                            <li class="scrollable-container media-list notification_list">
                                @forelse ($notifications as $notification)
                                    @php
                                    $title = "";
                                    if (isset($notification->data['title'])) {
                                        if (!is_array($notification->data['title'])) {
                                            $title = trans($notification->data['title']);
                                        }elseif (isset($notification->data['title'][1])) {
                                            $title = trans($notification->data['title'][0],$notification->data['title'][1]);
                                        }elseif (!isset($notification->data['title'][1])) {
                                            $title = trans($notification->data['title'][0]);
                                        }else{
                                            $title = "";
                                        }
                                    }
                                    $body = "";
                                    if (isset($notification->data['body'])) {
                                        if (!is_array($notification->data['body'])) {
                                            $body = trans($notification->data['body']);
                                        }elseif (isset($notification->data['body'][1])) {
                                            $body = trans($notification->data['body'][0],$notification->data['body'][1]);
                                        }elseif (!isset($notification->data['body'][1])) {
                                            $body = trans($notification->data['body'][0]);
                                        }else{
                                            $body = "";
                                        }
                                    }
                                    $route = '#';
                                    if (isset($notification->data['notify_type'])) {
                                        switch ($notification->data['notify_type']) {
                                            case 'order':
                                                $route = route('dashboard.order.show',$notification->data['order_id']);
                                                break;
                                            case 'contact':
                                                $route = route('dashboard.contact.show',$notification->data['contact_id']);
                                                break;
                                        }
                                    }
                                    if (isset($notification->data['route'])) {
                                        $route = $notification->data['route'];
                                    }
                                    @endphp

                                    <a class="d-flex justify-content-between" href="{{ $route }}">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left">
                                                @isset($notification->data['order_id'])
                                                <i class="feather icon-shopping-cart font-medium-5 primary"></i>
                                                @else
                                                <i class="feather icon-message-square font-medium-5 primary"></i>
                                                @endisset
                                            </div>
                                            <div class="media-body">
                                                <h6 class="primary media-heading">{{ $title }}</h6>
                                                <small class="notification-text"> {{ str_limit($body,100,'...') }}</small>
                                            </div>
                                            <small>
                                                <time class="media-meta">{{ $notification->created_at->isoFormat("D MMMM , Y") }}</time>
                                            </small>
                                        </div>
                                    </a>
                            @empty
                                <a class="d-flex justify-content-center no_notifications pt-2 pb-2">
                                    <i class="feather icon-bell align-middle font-medium-3 text-white text-bold-700"></i>
                                    <span class="align-middle text-bold-700 font-medium-3 ">{!! trans('dashboard.notification.no_notifications') !!}</span>
                                </a>
                                {{-- <li class="empty-cart d-none p-2 no_notifications">{!! trans('dashboard.notification.no_notifications') !!}.</li> --}}
                            @endforelse
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="{!! route('dashboard.notification.index') !!}">{!! trans('dashboard.general.show_all') !!}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name text-bold-600">{{ auth()->user()->fullname }}</span>
                                <span class="user-status">{{ optional(auth()->user()->role)->name??null }}</span>
                            </div>
                            <span>
                                <img class="round" src="{{ auth()->user()->avatar }}" alt="avatar" height="40" width="40">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="width:190px;">
                            <a class="dropdown-item" href="{{ LaravelLocalization::localizeUrl('dashboard/get_profile') }}">
                                <i class="feather icon-user"></i> {!! trans('dashboard.user.profile') !!}
                            </a>

                            @if (auth()->user()->hasPermissions('setting','store'))
                            <a href="{{ route('dashboard.setting.index') }}" class="dropdown-item">
                                <i class="feather icon-settings"></i>
                                {!! trans('dashboard.setting.setting') !!}
                            </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            {!! Form::open(['route' => 'logout' , 'method' => 'POST' , 'id' => 'logout_form']) !!}
                            <a class="dropdown-item" onclick="document.getElementById('logout_form').submit();">
                                <i class="feather icon-power"></i>
                                {!! trans('dashboard.auth.logout') !!}
                            </a>
                            {!! Form::close() !!}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none ">

</ul>
<!-- END: Header-->

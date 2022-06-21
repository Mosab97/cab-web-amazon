<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{!! route('dashboard.home') !!}">
                {{-- <img src="{{ setting('logo') }}" alt=""> --}}
                    <div class="brand-logo">
                    </div>
                    <h2 class="brand-text mb-0">{{ setting('project_name') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->route()->getName() == 'dashboard.home' ? 'active' : '' }} nav-item">
                <a href="{!! route('dashboard.home') !!}">
                    <i class="feather icon-tv"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.general.home') !!}">
                        {!! trans('dashboard.general.home') !!}
                    </span>
                </a>
            </li>
             @if (auth()->user()->hasPermissions('setting','store'))
            <li class="{{ request()->route()->getName() == 'dashboard.setting.index' ? 'active' : '' }} nav-item">
                <a href="{{ route('dashboard.setting.index') }}">
                    <i class="feather icon-settings"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.setting.setting') !!}">
                        {!! trans('dashboard.setting.setting') !!}
                    </span>
                </a>
            </li>
            @endif
            <li class=" navigation-header"><span>{!! trans('dashboard.sidebar.hr') !!}</span></li>
            {{-- Managers --}}
            @if (auth()->user()->hasPermissions('manager'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/manager/*") || request()->is("$locale/dashboard/manager") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-user"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.manager.managers') !!}">
                        {{ trans('dashboard.manager.managers') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.manager.index' || request()->route()->getName() == 'dashboard.manager.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.manager.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.manager.managers') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('manager','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.manager.create' || request()->route()->getName() == 'dashboard.manager.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.manager.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.manager.add_manager') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Driver --}}
            @if (auth()->user()->hasPermissions('driver'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/driver/*") || request()->is("$locale/dashboard/driver") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-globe"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.driver.drivers') !!}">
                        {{ trans('dashboard.driver.drivers') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->route()->getName() == 'dashboard.driver.index' || request()->route()->getName() == 'dashboard.driver.show') && ! request('status') ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.drivers') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'wait_accept_drivers' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=wait_not_accept_drivers">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.wait_not_accept_drivers') !!}">
                                {!! trans('dashboard.driver.wait_not_accept_drivers') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'deactive' ? 'active' : '' }}">
                        <a href="{{ route('dashboard.driver.index') }}?status=deactive">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.driver.deacive_drivers') }}">
                                {{ trans('dashboard.driver.deacive_drivers') }}
                            </span>
                        </a>
                    </li>

                    {{-- <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'accepted' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.in<li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'wait_accept_drivers' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=wait_accept_drivers">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.wait_accept_drivers') !!}">
                                {!! trans('dashboard.driver.wait_accept_drivers') !!}
                            </span>
                        </a>
                    </li>dex') !!}?status=accepted">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.accepted_drivers') !!}">
                                {!! trans('dashboard.driver.accepted_drivers') !!}
                            </span>
                        </a>
                    </li> --}}
                    {{-- <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'paid' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=paid">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.paid_drivers') !!}">
                                {!! trans('dashboard.driver.paid_drivers') !!}
                            </span>
                        </a>
                    </li> --}}
                    {{-- <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'available' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=available">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.available_drivers') !!}">
                                {!! trans('dashboard.driver.available_drivers') !!}
                            </span>
                        </a>
                    </li> --}}


                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'driver_without_orders' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=driver_without_orders">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.driver_without_orders') !!}">
                                {!! trans('dashboard.driver.driver_without_orders') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'not_available' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=not_available">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.not_available_drivers') !!}">
                                {!! trans('dashboard.driver.not_available_drivers') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'enable_to_recieve_orders' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=enable_to_recieve_orders">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.enable_to_recieve_orders') !!}">
                                {!! trans('dashboard.driver.enable_to_recieve_orders') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'disable_to_recieve_orders' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=disable_to_recieve_orders">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.disable_to_recieve_orders') !!}">
                                {!! trans('dashboard.driver.disable_to_recieve_orders') !!}
                            </span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'refused_drivers' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=refused_drivers">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.refused_drivers') !!}">
                                {!! trans('dashboard.driver.refused_drivers') !!}
                            </span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'on_order_drivers' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=on_order_drivers">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.on_order_drivers') !!}">
                                {!! trans('dashboard.driver.on_order_drivers') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'monthly_drivers' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=monthly_drivers">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.monthly_drivers') !!}">
                                {!! trans('dashboard.driver.monthly_drivers') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'has_balance_in_wallet' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=has_balance_in_wallet">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.has_balance_in_wallet_drivers') !!}">
                                {!! trans('dashboard.driver.has_balance_in_wallet_drivers') !!}
                            </span>
                        </a>
                    </li>

                    <li class="{{ request()->route()->getName() == 'dashboard.driver.index' && request('status') == 'drivers_cancelled_orders' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.index') !!}?status=drivers_cancelled_orders">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.driver.drivers_cancelled_orders') !!}">
                                {!! trans('dashboard.driver.drivers_cancelled_orders') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('driver','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.driver.create' || request()->route()->getName() == 'dashboard.driver.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.driver.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.driver.add_driver') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Clients --}}
            @if (auth()->user()->hasPermissions('client'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/client/*") || request()->is("$locale/dashboard/client") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-users"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.client.clients') !!}">
                        {{ trans('dashboard.client.clients') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->route()->getName() == 'dashboard.client.index' || request()->route()->getName() == 'dashboard.client.show') && ! request('status') ? 'active' : '' }}">
                        <a href="{!! route('dashboard.client.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.client.clients') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.client.index' && request('status') == 'has_balance_in_wallet' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.client.index') !!}?status=has_balance_in_wallet">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.client.has_balance_in_wallet_clients') !!}">
                                {!! trans('dashboard.client.has_balance_in_wallet_clients') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('client','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.client.create' || request()->route()->getName() == 'dashboard.client.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.client.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.client.add_client') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Ambassador --}}
            @if (auth()->user()->hasPermissions('ambassador'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/ambassador/*") || request()->is("$locale/dashboard/ambassador") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-at-sign"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.ambassador.ambassadors') !!}">
                        {{ trans('dashboard.ambassador.ambassadors') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.ambassador.index' && request('user_type') == 'driver' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.ambassador.index') !!}?user_type=driver">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.ambassador.driver_ambassadors') !!}">
                                {!! trans('dashboard.ambassador.driver_ambassadors') !!}
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->getName() == 'dashboard.ambassador.index' && request('user_type') == 'client' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.ambassador.index') !!}?user_type=client">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.ambassador.client_ambassadors') !!}">
                                {!! trans('dashboard.ambassador.client_ambassadors') !!}
                            </span>
                        </a>
                    </li>

                </ul>
            </li>
            @endif
            {{-- predecessor_service --}}
            @if (auth()->user()->hasPermissions('predecessor_service'))
                <li class="nav-item has-sub {{ request()->is("$locale/dashboard/predecessor_service/*") || request()->is("$locale/dashboard/predecessor_service") ? 'sidebar-group-active open' : '' }}">
                    <a href="#">
                        <i class="feather icon-at-sign"></i>
                        <span class="menu-title" data-i18n="{!! trans('dashboard.predecessor_service.predecessor_services') !!}">
                        {{ trans('dashboard.predecessor_service.predecessor_services') }}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ request()->route()->getName() == 'dashboard.predecessor_service.index' && request('user_type') == 'driver' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.predecessor_service.index') !!}?user_type=driver">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.ambassador.driver_ambassadors') !!}">
                                {!! trans('dashboard.predecessor_service.driver_predecessor_service') !!}
                            </span>
                            </a>
                        </li>
                        <li class="{{ request()->route()->getName() == 'dashboard.predecessor_service.index' && request('user_type') == 'client' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.predecessor_service.index') !!}?user_type=client">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.predecessor_service.client_predecessor_service') !!}">
                                {!! trans('dashboard.predecessor_service.client_predecessor_service') !!}
                            </span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif
            {{-- point_use --}}
            @if (auth()->user()->hasPermissions('point_use'))
                <li class="nav-item has-sub {{ request()->is("$locale/dashboard/point_use/*") || request()->is("$locale/dashboard/point_use") ? 'sidebar-group-active open' : '' }}">
                    <a href="#">
                        <i class="feather icon-at-sign"></i>
                        <span class="menu-title" data-i18n="{!! trans('dashboard.point_use.point_use') !!}">
                        {{ trans('dashboard.point_use.point_uses') }}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ request()->route()->getName() == 'dashboard.point_use.index' && request('user_type') == 'driver' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.point_use.index') !!}?user_type=driver">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.point_use.driver_point_use') !!}">
                                {!! trans('dashboard.point_use.driver_point_use') !!}
                            </span>
                            </a>
                        </li>
                        <li class="{{ request()->route()->getName() == 'dashboard.point_use.index' && request('user_type') == 'client' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.point_use.index') !!}?user_type=client">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.point_use.client_point_use') !!}">
                                {!! trans('dashboard.point_use.client_point_use') !!}
                            </span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif

            <li class=" navigation-header"><span>{!! trans('dashboard.sidebar.menu') !!}</span></li>
            {{-- Roles --}}
            @if (auth()->user()->hasPermissions('role'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/role/*") || request()->is("$locale/dashboard/role") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.role.roles') !!}">
                        {{ trans('dashboard.role.roles') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.role.index' || request()->route()->getName() == 'dashboard.role.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.role.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.role.roles') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('role','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.role.create' || request()->route()->getName() == 'dashboard.role.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.role.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.role.add_role') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Country --}}
            @if (auth()->user()->hasPermissions('country'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/country/*") || request()->is("$locale/dashboard/country") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-flag"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.country.countries') !!}">
                        {{ trans('dashboard.country.countries') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.country.index' || request()->route()->getName() == 'dashboard.country.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.country.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.country.countries') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('country','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.country.create' || request()->route()->getName() == 'dashboard.country.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.country.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.country.add_country') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- City --}}
            @if (auth()->user()->hasPermissions('city'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/city/*") || request()->is("$locale/dashboard/city") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-flag"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.city.cities') !!}">
                        {{ trans('dashboard.city.cities') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.city.index' || request()->route()->getName() == 'dashboard.city.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.city.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.city.cities') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('city','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.city.create' || request()->route()->getName() == 'dashboard.city.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.city.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.city.add_city') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Package --}}
            @if (auth()->user()->hasPermissions('package'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/package/*") || request()->is("$locale/dashboard/package") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.package.packages') !!}">
                        {{ trans('dashboard.package.packages') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.package.index' || request()->route()->getName() == 'dashboard.package.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.package.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.package.packages') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('package','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.package.create' || request()->route()->getName() == 'dashboard.package.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.package.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.package.add_package') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Point Package --}}
            @if (auth()->user()->hasPermissions('point_package'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/point_package/*") || request()->is("$locale/dashboard/point_package") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-package"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.point_package.point_packages') !!}">
                        {{ trans('dashboard.point_package.point_packages') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.point_package.index' || request()->route()->getName() == 'dashboard.point_package.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.point_package.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.point_package.point_packages') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('point_package','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.point_package.create' || request()->route()->getName() == 'dashboard.point_package.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.point_package.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.point_package.add_point_package') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Invite Code --}}
            @if (auth()->user()->hasPermissions('invite_code'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/invite_code/*") || request()->is("$locale/dashboard/invite_code") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-hash"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.invite_code.invite_codes') !!}">
                        {{ trans('dashboard.invite_code.invite_codes') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.invite_code.index' || request()->route()->getName() == 'dashboard.invite_code.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.invite_code.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.invite_code.invite_codes') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('invite_code','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.invite_code.create' || request()->route()->getName() == 'dashboard.invite_code.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.invite_code.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.invite_code.add_invite_code') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Brand --}}
            @if (auth()->user()->hasPermissions('brand'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/brand/*") || request()->is("$locale/dashboard/brand") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-bold"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.brand.brands') !!}">
                        {{ trans('dashboard.brand.brands') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.brand.index' || request()->route()->getName() == 'dashboard.brand.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.brand.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.brand.brands') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('brand','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.brand.create' || request()->route()->getName() == 'dashboard.brand.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.brand.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.brand.add_brand') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Car Model --}}
            @if (auth()->user()->hasPermissions('car_model'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/car_model/*") || request()->is("$locale/dashboard/car_model") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-crop"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.car_model.car_models') !!}">
                        {{ trans('dashboard.car_model.car_models') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.car_model.index' || request()->route()->getName() == 'dashboard.car_model.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.car_model.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.car_model.car_models') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('car_model','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.car_model.create' || request()->route()->getName() == 'dashboard.car_model.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.car_model.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.car_model.add_car_model') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Car Type --}}
            @if (auth()->user()->hasPermissions('car_type'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/car_type/*") || request()->is("$locale/dashboard/car_type") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.car_type.car_types') !!}">
                        {{ trans('dashboard.car_type.car_types') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.car_type.index' || request()->route()->getName() == 'dashboard.car_type.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.car_type.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.car_type.car_types') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('car_type','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.car_type.create' || request()->route()->getName() == 'dashboard.car_type.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.car_type.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.car_type.add_car_type') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Car --}}
            @if (auth()->user()->hasPermissions('car'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/car/*") || request()->is("$locale/dashboard/car") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-truck"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.car.cars') !!}">
                        {{ trans('dashboard.car.cars') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.car.index' || request()->route()->getName() == 'dashboard.car.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.car.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.car.cars') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('car','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.car.create' || request()->route()->getName() == 'dashboard.car.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.car.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.car.add_car') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            {{-- Cancel Reason --}}
            @if (auth()->user()->hasPermissions('cancel_reason'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/cancel_reason/*") || request()->is("$locale/dashboard/cancel_reason") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-x-circle"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.cancel_reason.cancel_reasons') !!}">
                        {{ trans('dashboard.cancel_reason.cancel_reasons') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.cancel_reason.index' || request()->route()->getName() == 'dashboard.cancel_reason.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.cancel_reason.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.cancel_reason.cancel_reasons') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('cancel_reason','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.cancel_reason.create' || request()->route()->getName() == 'dashboard.cancel_reason.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.cancel_reason.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.cancel_reason.add_cancel_reason') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if (auth()->user()->hasPermissions('contact'))
            <li class="{{ request()->route()->getName() == 'dashboard.contact.index' }} nav-item">
                <a href="{!! route('dashboard.contact.index') !!}">
                    <i class="feather icon-message-circle"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.contact.contacts') !!}">
                        {!! trans('dashboard.contact.contacts') !!}
                    </span>
                </a>
            </li>
            @endif

            @if (auth()->user()->hasPermissions('update_request') || auth()->user()->hasPermissions('renew_subscribtion_request'))
                <li class="nav-item has-sub {{ request()->is("$locale/dashboard/renew_subscribtion_request") || request()->is("$locale/dashboard/update_request") || request()->is("$locale/dashboard/renew_subscribtion_request/*") || request()->is("$locale/dashboard/update_request/*") ? 'sidebar-group-active open' : '' }}">
                    <a href="#">
                        <i class="feather icon-edit"></i>
                        <span class="menu-title" data-i18n="{!! trans('dashboard.update_request.update_sub_and_requests') !!}">
                            {{ trans('dashboard.update_request.update_sub_and_requests') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        @if (auth()->user()->hasPermissions('update_request'))
                        <li class="{{ request()->route()->getName() == 'dashboard.update_request.index' || request()->route()->getName() == 'dashboard.update_request.show' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.update_request.index') !!}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.update_request.update_requests') !!}">
                                    {!! trans('dashboard.update_request.update_requests') !!}
                                </span>
                            </a>
                        </li>
                    @endif
                        @if (auth()->user()->hasPermissions('renew_subscribtion_request'))
                        <li class="{{ request()->route()->getName() == 'dashboard.renew_subscribtion_request.index' || request()->route()->getName() == 'dashboard.renew_subscribtion_request.show' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.renew_subscribtion_request.index') !!}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.renew_subscribtion_request.renew_subscribtion_requests') !!}">
                                    {!! trans('dashboard.renew_subscribtion_request.renew_subscribtion_requests') !!}
                                </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

            @endif
            @if (auth()->user()->hasPermissions('balance_transfer'))
            <li class="{{ request()->route()->getName() == 'dashboard.balance_transfer.index' }} nav-item">
                <a href="{!! route('dashboard.balance_transfer.index') !!}">
                    <i class="feather icon-dollar-sign"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.balance_transfer.balance_transfers') !!}">
                        {!! trans('dashboard.balance_transfer.balance_transfers') !!}
                    </span>
                </a>
            </li>
            @endif

            {{-- Faqs --}}
            {{-- @if (auth()->user()->hasPermissions('faq'))
                <li class="nav-item has-sub {{ request()->is("$locale/dashboard/faq/*") || request()->is("$locale/dashboard/faq") ? 'sidebar-group-active open' : '' }}">
                    <a href="#">
                        <i class="feather icon-help-circle"></i>
                        <span class="menu-title" data-i18n="{!! trans('dashboard.faq.faqs') !!}">
                        {{ trans('dashboard.faq.faqs') }}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ request()->route()->getName() == 'dashboard.faq.index' || request()->route()->getName() == 'dashboard.faq.show' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.faq.index') !!}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.faq.faqs') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                            </a>
                        </li>
                        @if (auth()->user()->hasPermissions('faq','store'))
                            <li class="{{ request()->route()->getName() == 'dashboard.faq.create' || request()->route()->getName() == 'dashboard.faq.edit' ? 'active' : '' }}">
                                <a href="{!! route('dashboard.faq.create') !!}">
                                    <i class="feather icon-circle"></i>
                                    <span class="menu-item" data-i18n="{{ trans('dashboard.faq.faq') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}

            <li class=" navigation-header"><span>{!! trans('dashboard.sidebar.offers') !!}</span></li>
            {{-- Point Offer --}}
            @if (auth()->user()->hasPermissions('point_offer'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/point_offer/*") || request()->is("$locale/dashboard/point_offer") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-gift"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.point_offer.point_offers') !!}">
                        {{ trans('dashboard.point_offer.point_offers') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.point_offer.index' || request()->route()->getName() == 'dashboard.point_offer.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.point_offer.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.point_offer.point_offers') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('point_offer','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.point_offer.create' || request()->route()->getName() == 'dashboard.point_offer.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.point_offer.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.point_offer.add_point_offer') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- App Ad --}}
            @if (auth()->user()->hasPermissions('app_ad'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/app_ad/*") || request()->is("$locale/dashboard/app_ad") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-gift"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.app_ad.app_ads') !!}">
                        {{ trans('dashboard.app_ad.app_ads') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.app_ad.index' || request()->route()->getName() == 'dashboard.app_ad.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.app_ad.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.app_ad.app_ads') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('app_ad','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.app_ad.create' || request()->route()->getName() == 'dashboard.app_ad.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.app_ad.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.app_ad.add_app_ad') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Lucky Box --}}
            @if (auth()->user()->hasPermissions('lucky_box'))
            <li class="nav-item has-sub {{ request()->is("$locale/dashboard/lucky_box/*") || request()->is("$locale/dashboard/lucky_box") ? 'sidebar-group-active open' : '' }}">
                <a href="#">
                    <i class="feather icon-gift"></i>
                    <span class="menu-title" data-i18n="{!! trans('dashboard.lucky_box.lucky_boxes') !!}">
                        {{ trans('dashboard.lucky_box.lucky_boxes') }}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->route()->getName() == 'dashboard.lucky_box.index' || request()->route()->getName() == 'dashboard.lucky_box.show' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.lucky_box.index') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{!! trans('dashboard.lucky_box.lucky_boxes') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->hasPermissions('lucky_box','store'))
                    <li class="{{ request()->route()->getName() == 'dashboard.lucky_box.create' || request()->route()->getName() == 'dashboard.lucky_box.edit' ? 'active' : '' }}">
                        <a href="{!! route('dashboard.lucky_box.create') !!}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="{{ trans('dashboard.lucky_box.add_lucky_box') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{--  app Offer --}}
            @if (auth()->user()->hasPermissions('app_offer'))
                <li class="nav-item has-sub {{ request()->is("$locale/dashboard/app_offer/*") || request()->is("$locale/dashboard/app_offer") ? 'sidebar-group-active open' : '' }}">
                    <a href="#">
                        <i class="feather icon-gift"></i>
                        <span class="menu-title" data-i18n="{!! trans('dashboard.app_offer.app_offers') !!}">
                        {{ trans('dashboard.app_offer.app_offers') }}
                    </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ request()->route()->getName() == 'dashboard.app_offer.index' || request()->route()->getName() == 'dashboard.app_offer.show' ? 'active' : '' }}">
                            <a href="{!! route('dashboard.app_offer.index') !!}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="{!! trans('dashboard.app_offer.app_offer') !!}">
                                {!! trans('dashboard.general.show_all') !!}
                            </span>
                            </a>
                        </li>
                        @if (auth()->user()->hasPermissions('app_offer','store'))
                            <li class="{{ request()->route()->getName() == 'dashboard.app_offer.create' || request()->route()->getName() == 'dashboard.app_offer.edit' ? 'active' : '' }}">
                                <a href="{!! route('dashboard.app_offer.create') !!}">
                                    <i class="feather icon-circle"></i>
                                    <span class="menu-item" data-i18n="{{ trans('dashboard.app_offer.add_app_offer') }}">
                                {!! trans('dashboard.general.add_new') !!}
                            </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            <li class=" navigation-header"><span>{!! trans('dashboard.sidebar.order_section') !!}</span></li>
           @if (auth()->user()->hasPermissions('order'))
           <li class="{{ request()->route()->getName() == 'dashboard.order.index' && ! request('order_status') ? 'active' : '' }} nav-item">
               <a href="{!! route('dashboard.order.index') !!}">
                   <i class="feather icon-shopping-cart"></i>
                   <span class="menu-title" data-i18n="{!! trans('dashboard.order.all_orders') !!}">
                       {!! trans('dashboard.order.all_orders') !!}
                   </span>
               </a>
           </li>
           @endif
           @if (auth()->user()->hasPermissions('order'))
           <li class="{{ request()->route()->getName() == 'dashboard.order.index' && request('order_status') == 'pending' ? 'active' : '' }} nav-item">
               <a href="{!! route('dashboard.order.index') !!}?order_status=pending">
                   <i class="feather icon-clock"></i>
                   <span class="menu-title" data-i18n="{!! trans('dashboard.order.pending_orders') !!}">
                       {!! trans('dashboard.order.pending_orders') !!}
                   </span>
               </a>
           </li>
           @endif
           @if (auth()->user()->hasPermissions('order'))
           <li class="{{ request()->route()->getName() == 'dashboard.order.index' && request('order_status') == 'shipping' ? 'active' : '' }} nav-item">
               <a href="{!! route('dashboard.order.index') !!}?order_status=shipping">
                   <i class="feather icon-truck"></i>
                   <span class="menu-title" data-i18n="{!! trans('dashboard.order.shipping_orders') !!}">
                       {!! trans('dashboard.order.shipping_orders') !!}
                   </span>
               </a>
           </li>
           @endif
           @if (auth()->user()->hasPermissions('order'))
           <li class="{{ request()->route()->getName() == 'dashboard.order.index' && request('order_status') == 'finished' ? 'active' : '' }} nav-item">
               <a href="{!! route('dashboard.order.index') !!}?order_status=finished">
                   <i class="feather icon-archive"></i>
                   <span class="menu-title" data-i18n="{!! trans('dashboard.order.finished_orders') !!}">
                       {!! trans('dashboard.order.finished_orders') !!}
                   </span>
               </a>
           </li>
           @endif
           @if (auth()->user()->hasPermissions('trip'))
           <li class="{{ request()->route()->getName() == 'dashboard.trip.index' }} nav-item">
               <a href="{!! route('dashboard.trip.index') !!}">
                   <i class="feather icon-map-pin"></i>
                   <span class="menu-title" data-i18n="{!! trans('dashboard.trip.trips') !!}">
                       {!! trans('dashboard.trip.trips') !!}
                   </span>
               </a>
           </li>
           @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <img src="{{ asset('frontend/images/logo/logo.jpg')}}" alt="logo" class="desktop-logo">
            <img src="{{ asset('backend/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
            <img src="{{ asset('backend/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
            <img src="{{ asset('backend/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.dashboard') }}"
                        class="side-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                        <i class="side-menu__icon ri-dashboard-line"></i>
                        <span class="side-menu__label">Dashboards</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.service.list') }}"
                        class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.service.list', 'admin.service.add']) ? 'active' : '' }}">
                        <i class="side-menu__icon ri-service-line"></i>
                        <span class="side-menu__label">Services</span>
                    </a>
                </li>
                <li
                    class="slide has-sub {{ in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.add', 'admin.sub.category.index', 'admin.sub.category.add']) ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.add', 'admin.sub.category.index', 'admin.sub.category.add']) ? 'active' : '' }}">
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                        <i class="side-menu__icon ri-newspaper-line"></i>
                        <span class="side-menu__label">Manage Products</span>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.category.index') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.add']) ? 'active' : '' }}">
                                Category
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('admin.sub.category.index') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.sub.category.index', 'admin.sub.category.add']) ? 'active' : '' }}">Sub
                                Category</a>
                        </li>


                    </ul>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<header class="app-header sticky" id="header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">
            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('frontend/assets/images/logo/logo.png')}}" alt="logo" class="    ">
                        <img src="{{ asset('frontend/assets/images/logo/logo.png')}}" alt="logo" class="toggle-logo">
                        <img src="{{ asset('backend/assets/images/brand-logos/desktop-dark.png')}}" alt="logo"
                            class="desktop-dark">
                        <img src="{{ asset('backend/assets/images/brand-logos/toggle-dark.png')}}" alt="logo"
                            class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link" data-bs-toggle="sidebar"
                    href="javascript:void(0);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn" width="32" height="32"
                        fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                        </path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn-close" width="32"
                        height="32" fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z">
                        </path>
                    </svg>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->


        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <ul class="header-content-right">

            <!-- Start::header-element -->
            <li class="header-element d-md-none d-block">
                <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                    data-bs-target="#header-responsive-search">
                    <!-- Start::header-link-icon -->
                    <i class="bi bi-search header-link-icon"></i>
                    <!-- End::header-link-icon -->
                </a>
            </li>

            <!-- Start::header-element -->
            <li class="header-element dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-xl-2 me-0">
                            <img src="{{ Auth::user()->profile_photo
    ? asset('storage/'.Auth::user()->profile_photo)
    : asset('backend/assets/images/faces/2.jpg') }}" alt="Profile Photo"
                                class="avatar avatar-sm avatar-rounded">
                        </div>
                        <div class="d-xl-block d-none lh-1">
                            <span class="fw-medium lh-1">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <li>
                        <div class="py-2 px-3 text-center"> <span class="fw-semibold"> {{ auth()->user()->name }}
                            </span> <span class="d-block fs-12 text-muted">Admin</span> </div>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('edit.profile.page') }}"><i
                                class="ti ti-user text-primary me-2 fs-16"></i>Profile</a>
                    </li>
                    <li class="py-2 px-3"><a class="btn btn-primary btn-sm w-100" href="{{ route('admin.logout') }}">Log
                            Out</a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
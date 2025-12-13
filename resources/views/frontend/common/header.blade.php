<header class="header">
    {{-- <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Welcome to Wolmart Store message or remove it!</p>
            </div>
            <div class="header-right pr-0">
                <div class="dropdown">
                    <a href="#currency">USD</a>
                    <div class="dropdown-box">
                        <a href="#USD">USD</a>
                        <a href="#EUR">EUR</a>
                    </div>
                </div>
                <!-- End of DropDown Menu -->

                <div class="dropdown">
                    <a href="#language"><img src="{{ asset('frontend/images/flags/eng.png')}}" alt="ENG Flag" width="14"
                            height="8" class="dropdown-image" /> ENG</a>
                    <div class="dropdown-box">
                        <a href="#ENG">
                            <img src="{{ asset('frontend/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8"
                                class="dropdown-image" />
                            ENG
                        </a>
                        <a href="#FRA">
                            <img src="{{ asset('frontend/images/flags/fra.png')}}" alt="FRA Flag" width="14" height="8"
                                class="dropdown-image" />
                            FRA
                        </a>
                    </div>
                </div>
                <!-- End of Dropdown Menu -->
                <span class="divider d-lg-show"></span>
                <a href="blog.html" class="d-lg-show">Blog</a>
                <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                <a href="my-account.html" class="d-lg-show">My Account</a>
                <a href="frontend/ajax/login.html" class="d-lg-show login sign-in"><i class="w-icon-account"></i>Sign
                    In</a>
                <span class="delimiter d-lg-show">/</span>
                <a href="frontend/ajax/login.html" class="ml-0 d-lg-show login register">Register</a>
            </div>
        </div>
    </div> --}}
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4 justify-content-between">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                </a>
                <a href="{{ route('home') }}" class="logo ml-lg-0">
                    <img style="height:60px;width:auto" src="{{ asset('frontend/images/logo.jpg') }}" alt="logo"
                        width="144" height="45" />
                </a>
                <nav class="main-nav">
                    <ul class="menu">
                        <li class="">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="">
                            <a href="{{ route('home') }}">Services</a>
                            @if($services->count() > '0')
                                <ul>
                                    @foreach ($services as $service)
                                        <li><a href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="">
                            <a href="{{ route('home') }}">Shop
                                @if($categories->count() > '0')
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('service.details', $category->slug) }}">{{ $category->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                        </li>

                        <li>
                            <a href="about-us.html">About Us</a>
                        </li>
                        <li>
                            <a href="about-us.html">Contact Us</a>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="header-right ml-4">
                {{-- <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:#" class="w-icon-call"></a>
                    <div class="call-info d-xl-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="https://portotheme.com/cdn-cgi/l/email-protection#c8eb"
                                class="text-capitalize">Live Chat</a> or :
                        </h4>
                        <a href="tel:#" class="phone-number font-weight-bolder ls-50">0(800)123-456</a>
                    </div>
                </div>
                <a class="wishlist label-down link d-xs-show" href="wishlist.html">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">Wishlist</span>
                </a>
                <a class="compare label-down link d-xs-show" href="compare.html">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">Compare</span>
                </a>
                <div class="dropdown cart-dropdown mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">2</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="products">
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Beige knitted
                                        elas<br>tic
                                        runner shoes</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$25.68</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('frontend/images/cart/product-1.jpg')}}" alt="product"
                                            height="84" width="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close" aria-label="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Blue utility
                                        pina<br>fore
                                        denim dress</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$32.99</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('frontend/images/cart/product-2.jpg')}}" alt="product"
                                            width="84" height="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close" aria-label="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">$58.67</span>
                        </div>

                        <div class="cart-action">
                            <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div> --}}
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left flex-1">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true" data-display="static" title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                {{-- <li>
                                    <a href="shop-fullwidth-banner.html">
                                        <i class="w-icon-tshirt2"></i>Fashion
                                    </a>
                                    <ul class="megamenu">
                                        <li>
                                            <h4 class="menu-title">Women</h4>
                                            <hr class="divider">
                                            <ul>
                                                <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                                </li>
                                                <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                                </li>
                                                <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                                </li>
                                                <li><a href="shop-fullwidth-banner.html">Jewlery &
                                                        Watches</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h4 class="menu-title">Men</h4>
                                            <hr class="divider">
                                            <ul>
                                                <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                                </li>
                                                <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                                </li>
                                                <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                                <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                                </li>
                                                <li><a href="shop-fullwidth-banner.html">Jewlery &
                                                        Watches</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="banner-fixed menu-banner menu-banner2">
                                                <figure>
                                                    <img src="{{ asset('frontend/images/menu/banner-2.jpg')}}"
                                                        alt="Menu Banner" width="235" height="347" />
                                                </figure>
                                                <div class="banner-content">
                                                    <div class="banner-price-info mb-1 ls-normal">Get up to
                                                        <strong class="text-primary text-uppercase">20%Off</strong>
                                                    </div>
                                                    <h3 class="banner-title ls-normal">Hot Sales</h3>
                                                    <a href="shop-banner-sidebar.html"
                                                        class="btn btn-dark btn-sm btn-link btn-slide-right btn-icon-right">
                                                        Shop Now<i class="w-icon-long-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li> --}}
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('product.list', $category->slug) }}">
                                            {{ $category->category_name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <form method="get" action="#"
                        class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
                        <div class="select-box">
                            <select id="category" name="category">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <li>
                                        <option value="{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    </li>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="search" id="search" placeholder="Search in..."
                            required />
                        <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                        </button>
                    </form>
                </div>
                {{-- <div class="header-right pr-0 ml-4">
                    <a href="#" class="d-xl-show mr-6"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                    <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                </div> --}}
            </div>
        </div>
    </div>
</header>
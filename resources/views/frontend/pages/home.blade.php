@extends('frontend.common.master')
@section('content')
    <style>
        
    </style>
    <main class="main">
        <div class="intro-section">
            <div class="swiper-container swiper-theme nav-inner pg-inner animation-slider pg-xxl-hide pg-show nav-xxl-show nav-hide"
                data-swiper-options="{
                            'slidesPerView': 1,
                            'autoplay': {
                                'delay': 4000,
                                'disableOnInteraction': false
                            }
                        }">
                <div class="swiper-wrapper row gutter-no cols-1">
                    <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                        style="background-image: url({{ asset('frontend/images/demos/demo2/slides/slide-1.jpg')}}); background-color: #f1f0f0;">
                        <div class="container">
                            <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                            'name': 'fadeInDownShorter', 'duration': '1s'
                                        }"
                                data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}"
                                data-child-depth="0.2">
                                <img src="{{ asset('frontend/images/demos/demo2/slides/ski.png')}}" alt="Ski" width="729"
                                    height="570" />
                            </figure>
                            <div class="banner-content text-right y-50 ml-auto">
                                <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInUpShorter', 'duration': '1s'
                                            }">Deals And Promotions</h5>
                                <h3 class="banner-title ls-25 mb-6 slide-animate" data-animation-options="{
                                                'name': 'fadeInUpShorter', 'duration': '1s'
                                            }">Fashion <span class="text-primary">Skiwears</span> for the ardent Sports
                                    devotees
                                </h3>
                                <a href="shop-banner-sidebar.html"
                                    class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInUpShorter', 'duration': '1s'
                                            }">
                                    Shop Now<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <!-- End of .banner-content -->
                        </div>
                        <!-- End of .container -->
                    </div>
                    <!-- End of .intro-slide1 -->

                    <div class="swiper-slide banner banner-fixed intro-slide intro-slide2"
                        style="background-image: url({{ asset('frontend/images/demos/demo2/slides/slide-2.jpg')}}); background-color: #d9ddd9;">
                        <div class="container">
                            <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                            'name': 'fadeInUpShorter', 'duration': '1s'
                                        }"
                                data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}"
                                data-child-depth="0.2">
                                <img src="{{ asset('frontend/images/demos/demo2/slides/woman.png')}}" alt="Ski" width="865"
                                    height="732" />
                            </figure>
                            <div class="banner-content y-50">
                                <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.5s'
                                            }">News And Inspiration</h5>
                                <h3 class="banner-title ls-25 mb-2 text-uppercase lh-1 slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.7s'
                                            }">Natural Sound</h3>
                                <div class="banner-price-info font-weight-bold text-dark ls-25 slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.9s'
                                            }">Sale up to
                                    <span class="text-primary font-weight-bolder text-uppercase ls-normal">30%
                                        Off</span>
                                </div>
                                <p class="font-weight-normal text-default ls-25 slide-animate" data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.1s'
                                            }">Free returns extended to 30 days after delivery</p>
                                <a href="shop-banner-sidebar.html"
                                    class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.3s'
                                            }">
                                    Shop Now<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <!-- End of .banner-content -->
                        </div>
                        <!-- End of .container -->
                    </div>
                    <!-- End of .intro-slide2 -->

                    <div class="swiper-slide banner banner-fixed intro-slide intro-slide3"
                        style="background-image: url({{ asset('frontend/images/demos/demo2/slides/slide-3.jpg')}}); background-color: #d0cfcb;">
                        <div class="container">
                            <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                            'name': 'fadeInRightShorter', 'duration': '1s'
                                        }"
                                data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}"
                                data-child-depth="0.2">
                                <img src="{{ asset('frontend/images/demos/demo2/slides/man.png')}}" alt="Ski" width="527"
                                    height="481" />
                            </figure>
                            <div class="banner-content y-50">
                                <h5 class="banner-subtitle text-uppercase font-weight-bold slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s'
                                            }">Top Monthly Seller</h5>
                                <h4 class="banner-title ls-25 slide-animate" data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s'
                                            }">Sumsung 52 Inches Full HD <span class="text-primary">Smart LED</span> TV
                                </h4>
                                <p class="font-weight-normal text-dark slide-animate" data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s'
                                            }">Only until the end of this week.</p>
                                <a href="shop-banner-sidebar.html"
                                    class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                    data-animation-options="{
                                                'name': 'fadeInRightShorter', 'duration': '1s'
                                            }">Shop Now<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <!-- End of .banner-content -->
                        </div>
                        <!-- End of .container -->
                    </div>
                    <!-- End of .intro-slide3 -->
                </div>
                <div class="swiper-pagination"></div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>
        </div>
        <!-- End of .intro-section -->

        <div class="container">
            {{-- <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm mt-6 mb-10"
                data-swiper-options="{
                            'loop': true,
                            'slidesPerView': 1,
                            'autoplay': {
                                'delay': 4000,
                                'disableOnInteraction': false
                            },
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '1200': {
                                    'slidesPerView': 4
                                }
                            }
                        }">
                <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                    <div class="swiper-slide icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Free Shipping & Returns</h4>
                            <p class="text-default">For all orders over $99</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                            <p class="text-default">Any back within 30 days</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- End of Iocn Box Wrapper -->

            <div class="title-link-wrapper mb-3 mt-3 appear-animate">
                <h2 class="title title-deals mb-1">Our Services</h2>
                <a href="shop-boxed-banner.html" class="font-weight-bold ls-25">More Products<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>
            <div class="swiper-container swiper-theme post-wrapper mb-10 mb-lg-5 appear-animate" data-swiper-options="{

                            'spaceBetween': 20,
                            'slidesPerView': 1,
                            'autoplay': {
                                'delay': 2000,
                                'disableOnInteraction': false
                            },
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '992': {
                                    'slidesPerView': 4
                                }
                            }
                        }">
                <div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
                    <div class="swiper-slide post">
                        <figure class="post-media br-sm">
                            <a href="post-single.html">
                                <img src="{{ asset('frontend/images/demos/demo2/blog/1.jpg')}}" alt="Post" width="620"
                                    height="398" style="background-color: #898078;">
                            </a>
                            
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">We want to be different, and Fashion
                                    gives
                                    me that outlet to do</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="swiper-slide post">
                        <figure class="post-media br-sm">
                            <a href="post-single.html">
                                <img src="{{ asset('frontend/images/demos/demo2/blog/1.jpg')}}" alt="Post" width="620"
                                    height="398" style="background-color: #898078;">
                            </a>
                            
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">We want to be different, and Fashion
                                    gives
                                    me that outlet to do</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="swiper-slide post">
                        <figure class="post-media br-sm">
                            <a href="post-single.html">
                                <img src="{{ asset('frontend/images/demos/demo2/blog/2.jpg')}}" alt="Post" width="620"
                                    height="398" style="background-color: #EDEFEE;">
                            </a>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">Explore Fashion For Women In</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip
                                    isic ing elit, sed do eiusmod.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="swiper-slide post">
                        <figure class="post-media br-sm">
                            <a href="post-single.html">
                                <img src="{{ asset('frontend/images/demos/demo2/blog/3.jpg')}}" alt="Post" width="620"
                                    height="398" style="background-color: #A1A09E;">
                            </a>
                            
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">Fashion tells about who you are from
                                    external point of view</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="swiper-slide post">
                        <figure class="post-media br-sm">
                            <a href="post-single.html">
                                <img src="{{ asset('frontend/images/demos/demo2/blog/4.jpg')}}" alt="Post" width="620"
                                    height="398" style="background-color: #EDF1F2;">
                            </a>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">Just found the ultimate denim
                                    dresses</a>
                            </h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip
                                    isic ing elit, sed do eiusmod.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="title-link-wrapper mb-3 appear-animate">
                <h2 class="title title-deals mb-1">Laptops</h2>
                <a href="shop-boxed-banner.html" class="font-weight-bold ls-25">More Products<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>
            <!-- End of .title-link-wrapper -->

            <div class="swiper-container swiper-theme product-deals-wrapper appear-animate mb-7" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'autoplay': {
                                'delay': 2000,
                                'disableOnInteraction': false
                            },
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 4
                                },
                                '992': {
                                    'slidesPerView': 5
                                }
                            }
                        }">
                <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-2">
                    <div class="swiper-slide product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="product-default.html">
                                    <img src="{{ asset('frontend/images/demos/demo2/products/1-1-1.jpg')}}" alt="Product"
                                        width="300" height="338">
                                    <img src="{{ asset('frontend/images/demos/demo2/products/1-1-2.jpg')}}" alt="Product"
                                        width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                    <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                        title="Add to Compare"></a>
                                </div>
                                <div class="product-label-group">
                                    <label class="product-label label-new">New</label>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="product-default.html">Women's Comforter</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    {{-- <a href="product-default.html" class="rating-reviews">(3 Reviews)</a> --}}
                                </div>
                                {{-- <div class="product-price">
                                    <ins class="new-price">$45.62 - $58.28</ins>
                                </div> --}}
                                    <div class="product-inquiry mt-3 d-flex justify-content-center gap-2">
                                        <a href="https://wa.me/919999999999?text=Hi, I am interested in this product"
                                            target="_blank" class="action-btn whatsapp mr-1">
                                            <i class="fab fa-whatsapp fa-2x"></i>
                                            <span></span>
                                        </a>

                                        <a href="tel:+919999999999" class="action-btn call mr-1">
                                            <i class="w-icon-phone"></i>
                                            <span></span>
                                        </a>

                                        <a href="#" class="action-btn enquiry" data-bs-toggle="modal"
                                            data-bs-target="#enquiryModal">
                                            <i class="fas fa-envelope fa-2x"></i>
                                            <span></span>
                                        </a>

                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Product Deals Warpper -->

            <h2 class="title text-left mb-5 appear-animate">Our Brands</h2>
            <div class="swiper-container swiper-theme brands-wrapper br-sm mb-10 appear-animate" data-swiper-options="{
                            'loop': true,
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'autoplay': {
                                'delay': 4000,
                                'disableOnInteraction': false
                            },
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 4
                                },
                                '992': {
                                    'slidesPerView': 6
                                },
                                '1200': {
                                    'slidesPerView': 8
                                }
                            }
                        }">
                <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/1.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/2.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/3.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/4.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/5.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/6.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/7.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ asset('frontend/images/demos/demo2/brands/8.png')}}" alt="Brand" width="290"
                                height="100" />
                        </figure>
                    </div>
                </div>
            </div>
            <!-- End of Brands Wrapper -->
        </div>
        <!-- End of Container -->
    </main>
@endsection
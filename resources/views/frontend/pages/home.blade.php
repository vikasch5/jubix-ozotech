@extends('frontend.common.master')
@section('content')
    <main class="main">
        @if($banners->count())
            <div class="intro-section">
                <div class="swiper-container swiper-theme" data-swiper-options='{
                                "slidesPerView": 1,
                                "autoplay": {
                                    "delay": 4000,
                                    "disableOnInteraction": false
                                },
                                "loop": true
                            }'>

                    <div class="swiper-wrapper">

                        @foreach($banners as $banner)
                            <div class="swiper-slide">
                                <img src="{{ asset($banner->image) }}" class="w-100 intro-img" alt="Banner {{ $loop->iteration }}">
                            </div>
                        @endforeach

                    </div>

                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        @endif


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
            @if($services->count() > 0)
                <div class="title-link-wrapper mb-3 mt-3 appear-animate">
                    <h2 class="title title-deals mb-1">Our Services</h2>
                    {{-- <a href="{{ route('service.details') }}" class="font-weight-bold ls-25">More Services<i
                            class="w-icon-long-arrow-right"></i></a> --}}
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
                        @foreach ($services as $service)
                            <div class="swiper-slide post">
                                <figure class="post-media br-sm">
                                    <a href="{{ route('service.details', $service->slug) }}">
                                        <img loading="lazy" src="{{ asset('uploads/services/' . $service->image)}}" alt="Post"
                                            width="620" height="398" style="background-color: #898078;">
                                    </a>

                                </figure>
                                <div class="post-details">
                                    <h4 class="post-title"><a
                                            href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a></h4>
                                    <div class="post-content">
                                        <p>{{ \Illuminate\Support\Str::words(strip_tags($service->description), 30, '...') }}</p>
                                    </div>
                                    <a href="{{ route('service.details', $service->slug) }}"
                                        class="btn btn-link btn-dark btn-underline">Read More<i
                                            class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @endif
            @if($homeCategories->count() > 0)
                @foreach ($homeCategories as $homeCategory)
                    <div class="title-link-wrapper mb-3 appear-animate">
                        <h2 class="title title-deals mb-1">Laptops</h2>
                        <a href="{{ route('product.list', $homeCategory->slug) }}" class="font-weight-bold ls-25">More Products<i
                                class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <!-- End of .title-link-wrapper -->
                    <div class="swiper-container swiper-theme product-deals-wrapper appear-animate mb-7"
                        data-swiper-options="{
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
                            @foreach ($homeCategory->products as $product)
                                <div class="swiper-slide product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                @php
                                                    $images = $product->images ? json_decode($product->images, true) : [];
                                                    $productImage = count($images) > 0 ? asset('storage/' . $images[0]) : asset('frontend/images/no-image.png');
                                                @endphp
                                                <img loading="lazy" src="{{ $productImage }}" alt="{{ $product->product_name }}"
                                                    width="300" height="338">
                                                <img loading="lazy" src="{{ $productImage }}" alt="{{ $product->product_name }}"
                                                    width="300" height="338">
                                            </a>
                                            <div class="product-label-group">
                                                <label class="product-label label-new">New</label>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name"><a
                                                    href="{{ route('product.detail', $product->slug) }}">{{ $product->product_name }}</a>
                                            </h4>
                                            {{-- <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="{{ route('product.detail', $product->slug) }}" class="rating-reviews">(3
                                                    Reviews)</a>
                                            </div> --}}
                                            {{-- <div class="product-price">
                                                <ins class="new-price">$45.62 - $58.28</ins>
                                            </div> --}}
                                            <div class="product-inquiry mt-3 d-flex justify-content-center gap-2">
                                                <a href="https://wa.me/{{ optional($settings)->mobile_number }}?text=Hi, I am interested in this product"
                                                    target="_blank" class="action-btn whatsapp mr-1">
                                                    <i class="fab fa-whatsapp fa-2x"></i>
                                                    <span></span>
                                                </a>

                                                <a href="tel:{{ optional($settings)->mobile_number }}" class="action-btn call mr-1">
                                                    <i class="w-icon-phone"></i>
                                                    <span></span>
                                                </a>

                                                <a href="#" class="action-btn enquiry" data-bs-toggle="modal"
                                                    data-name="{{ $product->product_name }}" data-img="{{ $productImage  }}"
                                                    data-bs-target="#enquiryModal">
                                                    <i class="fas fa-envelope fa-2x"></i>
                                                    <span></span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @endforeach
            @endif

            {{-- <h2 class="title text-left mb-5 appear-animate">Our Brands</h2>
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
            </div> --}}
            <!-- End of Brands Wrapper -->
        </div>
        <!-- End of Container -->
    </main>
@endsection
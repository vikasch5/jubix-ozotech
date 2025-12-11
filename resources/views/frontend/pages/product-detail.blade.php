@extends('frontend.common.master')

@section('content')

    @php
        // Decode product images JSON
        $images = $product->images ? json_decode($product->images, true) : [];
    @endphp

    <main class="main mb-10 pb-1">

        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">{{ $product->category->category_name ?? 'Category' }}</a></li>
                <li>{{ $product->product_name }}</li>
            </ul>
        </nav>
        <!-- /Breadcrumb -->

        <div class="page-content">
            <div class="container">

                <div class="product product-single row">

                    <!-- LEFT: PRODUCT IMAGES -->
                    <div class="col-md-6 mb-6">
                        <div class="product-gallery product-gallery-sticky product-gallery-vertical">

                            <!-- Main Image Slider -->
                            <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                data-swiper-options="{ 'navigation': { 'nextEl': '.swiper-button-next', 'prevEl': '.swiper-button-prev' } }">
                                <div class="swiper-wrapper row cols-1 gutter-no">

                                    @foreach ($images as $img)
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{ asset('storage/' . $img) }}"
                                                    data-zoom-image="{{ asset('storage/' . $img) }}"
                                                    alt="{{ $product->product_name }}" width="800" height="900">
                                            </figure>
                                        </div>
                                    @endforeach

                                </div>

                                <button class="swiper-button-next"></button>
                                <button class="swiper-button-prev"></button>
                                <a href="#" class="product-gallery-btn product-image-full"><i class="w-icon-zoom"></i></a>
                            </div>

                            <!-- Thumbnail Slider -->
                            <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                        'navigation': { 'nextEl': '.swiper-button-next', 'prevEl': '.swiper-button-prev' },
                                        'breakpoints': {
                                            '992': { 'direction': 'vertical', 'slidesPerView': 'auto' }
                                        }
                                     }">

                                <div class="product-thumbs swiper-wrapper row cols-lg-1 cols-4 gutter-sm">
                                    @foreach ($images as $img)
                                        <div class="product-thumb swiper-slide">
                                            <img src="{{ asset('storage/' . $img) }}" alt="Thumbnail" width="800" height="900">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="swiper-button-prev"></button>
                                <button class="swiper-button-next"></button>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT: PRODUCT DETAILS -->
                    <div class="col-md-6 mb-4 mb-md-6">
                        <div class="product-details">

                            <!-- Title -->
                            <h1 class="product-title">{{ $product->product_name }}</h1>

                            <!-- Category -->
                            <div class="product-meta">
                                <div class="product-categories">
                                    Category:
                                    <span class="product-category">
                                        <a href="#">{{ $product->category->category_name ?? '' }}</a>
                                    </span>
                                </div>
                                @if($product->subCategory)
                                    <div class="product-categories">
                                        Sub Category:
                                        <span class="product-category">
                                            <a href="#">{{ $product->subCategory->sub_category_name }}</a>
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <hr class="product-divider">

                            <!-- PRICE -->
                            <div class="product-price">
                                <ins class="new-price">₹{{ number_format($product->price, 2) }}</ins>
                            </div>

                            <!-- DESCRIPTION SHORT -->
                            <div class="product-short-desc lh-2 mt-3">
                                {!! nl2br(e(Str::limit($product->description, 200))) !!}
                            </div>

                            <hr class="product-divider">

                            <!-- Enquiry Buttons -->
                            <div class="mt-3 d-flex gap-3">
                                <div class="product-inquiry mt-3 d-flex justify-content-center gap-2">

                                    <!-- WhatsApp Inquiry -->
                                    <a href="https://wa.me/919999999999?text=Hi, I am interested in {{ urlencode($product->product_name) }}"
                                        target="_blank" class="action-btn whatsapp mr-1">
                                        <i class="fab fa-whatsapp fa-2x"></i>
                                    </a>

                                    <!-- Call -->
                                    <a href="tel:+919999999999" class="action-btn call mr-1">
                                        <i class="w-icon-phone"></i>
                                    </a>

                                    <!-- Enquiry Modal -->
                                    <a href="#" class="action-btn enquiry" data-bs-toggle="modal"
                                        data-bs-target="#enquiryModal" data-product="{{ $product->product_name }}">
                                        <i class="fas fa-envelope fa-2x"></i>
                                    </a>

                                </div>
                            </div>

                            <hr class="product-divider">

                            <!-- FULL DESCRIPTION -->
                            <h4 class="mt-4 mb-2">Description</h4>
                            <div class="product-description">
                                {!! nl2br(e($product->description)) !!}
                            </div>

                        </div>
                    </div>

                </div>

                <!-- RELATED PRODUCTS -->
                @if($relatedProducts->count() > 0)
                    <section class="related-product-section mt-10">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title">Related Products</h4>
                        </div>

                        <div class="swiper-container swiper-theme" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '576': { 'slidesPerView': 3 },
                                        '768': { 'slidesPerView': 4 },
                                        '992': { 'slidesPerView': 4 }
                                    }
                                }">

                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">

                                @foreach ($relatedProducts as $item)
                                    @php
                                        $firstImg = $item->images ? json_decode($item->images, true)[0] : null;
                                    @endphp

                                    <div class="swiper-slide product">
                                        <figure class="product-media">
                                            <a href="{{ route('product.detail', $item->slug) }}">
                                                <img src="{{ $firstImg ? asset('storage/' . $firstImg) : asset('frontend/no-image.jpg') }}"
                                                    width="300" height="338">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="{{ route('product.detail', $item->slug) }}">{{ $item->product_name }}</a>
                                            </h4>
                                            <div class="product-price">₹{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    </section>
                @endif

            </div>
        </div>

    </main>

@endsection
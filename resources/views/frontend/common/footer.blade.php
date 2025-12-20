<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">

    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="demo2.html" class="logo-footer">
                            <img src="{{ asset('frontend/images/demos/demo2/footer-logo.png')}}" alt="logo-footer"
                                width="144" height="45" />
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">Got Question? Call us 24/7</p>
                            <a href="tel:{{ !empty($settings->mobile_number) ? $settings->mobile_number : '0000000000' }}"
                                class="widget-about-call">{{ !empty($settings->mobile_number) ? $settings->mobile_number : '0000000000' }}</a>
                            <a href="mail:{{ !empty($settings->email) ? $settings->email : 'demo@gmail.com' }}"
                                class="widget-about-call">{{ !empty($settings->email) ? $settings->email :
                                'demo@gmail.com' }}</a>
                            <div class="social-icons social-icons-colored">

                                @if(!empty($settings->facebook))
                                    <a href="{{ $settings->facebook }}" target="_blank"
                                        class="social-icon social-facebook w-icon-facebook"></a>
                                @endif

                                @if(!empty($settings->twitter))
                                    <a href="{{ $settings->twitter }}" target="_blank"
                                        class="social-icon social-twitter w-icon-twitter"></a>
                                @endif

                                @if(!empty($settings->instagram))
                                    <a href="{{ $settings->instagram }}" target="_blank"
                                        class="social-icon social-instagram w-icon-instagram"></a>
                                @endif

                                @if(!empty($settings->youtube))
                                    <a href="{{ $settings->youtube }}" target="_blank"
                                        class="social-icon social-youtube w-icon-youtube"></a>
                                @endif

                                @if(!empty($settings->pinterest))
                                    <a href="{{ $settings->pinterest }}" target="_blank"
                                        class="social-icon social-pinterest w-icon-pinterest"></a>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="{{ route('about.us') }}">About Us</a></li>
                            <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Services</h4>
                        <ul class="widget-body">
                            @foreach ($services as $service)
                                <li><a href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="widget address-widget p-3 h-100">
                        <h5 class="widget-title mb-2">Address</h5>
                        <p class="mb-0 text-muted">
                            @if(!empty($settings->address))
                                {{ $settings->address }}
                            @else
                                1234 Street Name, City Name, United States
                            @endif

                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">Copyright © 2021 {{ env('APP_NAME') }}. All Rights Reserved.</p>
            </div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8">We're using safe payment for</span>
                <figure class="payment">
                    <img src="{{ asset('frontend/images/payment.png')}}" alt="payment" width="159" height="25" />
                </figure>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade enquiry-modal" id="enquiryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content enquiry-glass">

            <div class="row g-0">

                <!-- LEFT : IMAGE PANEL -->
                <div class="col-lg-5 d-none d-lg-block enquiry-image" id="modalProductImage">
                    <div class="image-overlay">
                        <h3 id="modalProductName">Product Name</h3>
                        <p>High quality · Trusted · Fast delivery</p>
                    </div>
                </div>

                <!-- RIGHT : FORM PANEL -->
                <div class="col-lg-7">
                    <div class="p-5">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fw-bold mb-1">Product Enquiry</h2>
                                <p class="text-muted mb-0">Let us know your requirement</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Product Preview -->
                        <div class="mini-product mb-4">
                            <img id="modalProductThumb" src="" alt="Product">
                            <div>
                                <h6 id="modalProductNameSmall"></h6>
                                <span class="badge bg-success">In Stock</span>
                            </div>
                        </div>

                        <form id="enquiry-form" method="post" action="{{ route('product.enquiry.save') }}">
                            @csrf

                            <div id="enquiry-alert" class="alert d-none" role="alert"></div>
                            <input type="hidden" name="product_name" id="productNameInput">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control premium-input"
                                        placeholder="Your Name" required>
                                </div>

                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control premium-input"
                                        placeholder="Email Address" required>
                                </div>

                                <div class="col-md-6">
                                    <input type="tel" name="phone" class="form-control premium-input"
                                        placeholder="Phone Number" required>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" name="quantity" class="form-control premium-input" value="1"
                                        min="1">
                                </div>

                                <div class="col-12">
                                    <textarea rows="4" name="message" class="form-control premium-input"
                                        placeholder="Describe your requirement..."></textarea>
                                </div>

                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-gradient px-5 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Send Enquiry
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
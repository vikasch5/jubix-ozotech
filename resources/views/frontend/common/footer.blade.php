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
                            <a href="tel:18005707777" class="widget-about-call">1-800-570-7777</a>
                            <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                & coupons ster now toon.
                            </p>

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
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Services</h4>
                        <ul class="widget-body">
                            @foreach ($services as $service)
                            <li><a href="{{ route('service.details',$service->slug) }}">{{ $service->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Money-back guarantee!</a></li>
                            <li><a href="#">Product Returns</a></li>
                            <li><a href="#">Support Center</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Term and Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">Copyright © 2021 Wolmart Store. All Rights Reserved.</p>
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
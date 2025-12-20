@extends('frontend.common.master')

@section('content')
    <style>
        /* CONTACT INFO BOX */
        .contact-info-box {
            background: #f8f9fa;
            border-radius: 14px;
            padding: 35px;
        }

        .contact-info-item {
            display: flex;
            gap: 18px;
            margin-bottom: 25px;
        }

        .contact-info-item .icon {
            width: 48px;
            height: 48px;
            background: #222;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .contact-info-item h6 {
            margin-bottom: 4px;
            font-weight: 600;
        }

        .contact-info-item p {
            margin-bottom: 0;
            color: #555;
        }

        /* CONTACT FORM */
        .contact-form-box {
            background: #fff;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .contact-us-form label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .contact-us-form .form-control {
            border-radius: 8px;
            padding: 12px;
        }
    </style>

    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Contact Us</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav mb-10 pb-1">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="demo1.html">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content contact-us">
            <div class="container">
                <section class="content-title-section mb-10">
                    <h3 class="title title-center mb-3">Contact
                        Information
                    </h3>
                    <p class="text-center">Lorem ipsum dolor sit amet,
                        consectetur
                        adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                </section>
                <!-- End of Contact Title Section -->
                <section class="contact-section py-10 pb-3">
                    <div class="row g-5 align-items-stretch">

                        <!-- LEFT SIDE : CONTACT INFO -->
                        <div class="col-lg-5">
                            <div class="contact-info-box h-100">
                                <h4 class="title mb-4">Contact Information</h4>

                                <div class="contact-info-item">
                                    <span class="icon">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                    <div>
                                        <h6>Address</h6>
                                        <p>{{ optional($settings)->address }}</p>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <span class="icon">
                                        <i class="w-icon-envelop-closed"></i>
                                    </span>
                                    <div>
                                        <h6>Email</h6>
                                        <p>
                                            <a href="mailto:{{ optional($settings)->email }}">
                                                {{ optional($settings)->email }}
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <span class="icon">
                                        <i class="w-icon-headphone"></i>
                                    </span>
                                    <div>
                                        <h6>Phone</h6>
                                        <p>{{ optional($settings)->mobile_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE : CONTACT FORM -->
                        <div class="col-lg-7">
                            <div class="contact-form-box">
                                <h4 class="title mb-4">Send Us a Message</h4>

                                <form id="contactForm" class="contact-us-form">
                                    @csrf

                                    <div class="row g-4">

                                        <div class="col-md-6">
                                            <label class="form-label">Your Name *</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter your name">
                                            <small class="text-danger error-text name_error"></small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email Address *</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                                            <small class="text-danger error-text email_error"></small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Enter phone">
                                            <small class="text-danger error-text phone_error"></small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Subject</label>
                                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Your Message *</label>
                                            <textarea name="message" rows="5" class="form-control"
                                                placeholder="Write message..."></textarea>
                                            <small class="text-danger error-text message_error"></small>
                                        </div>

                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-dark px-5" id="submitBtn">
                                                <span class="btn-text">Send Message</span>
                                                <span class="spinner-border spinner-border-sm d-none"></span>
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <div id="formResponse"></div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </section>

            </div>

            <!-- End Map Section -->
        </div>
        <!-- End of PageContent -->
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $('#contactForm').on('submit', function (e) {
                e.preventDefault();

                $('.error-text').text('');
                $('#formResponse').html('');

                let form = this;
                let formData = new FormData(form);

                $('#submitBtn .btn-text').text('Sending...');
                $('#submitBtn .spinner-border').removeClass('d-none');

                $.ajax({
                    url: "{{ route('contact.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        $('#submitBtn .btn-text').text('Send Message');
                        $('#submitBtn .spinner-border').addClass('d-none');

                        if (res.status === true) {
                            $('#formResponse').html(
                                `<div class="alert alert-success">${res.message}</div>`
                            );
                            form.reset();
                        }
                    },
                    error: function (xhr) {
                        $('#submitBtn .btn-text').text('Send Message');
                        $('#submitBtn .spinner-border').addClass('d-none');

                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });
                        } else {
                            $('#formResponse').html(
                                `<div class="alert alert-danger">Something went wrong!</div>`
                            );
                        }
                    }
                });
            });

        });
    </script>

@endsection
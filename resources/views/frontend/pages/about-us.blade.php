@extends('frontend.common.master')

@section('content')
    <style>
        .about-page h2 {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .about-page h3 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .about-page p {
            font-size: 16px;
            line-height: 1.9;
            color: #555;
        }

        /* .about-hero {
                    padding: 90px 0;
                } */

        .about-hero img {
            width: 100%;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .15);
        }

        .section-padding {
            padding: 90px 0;
        }

        .feature-list {
            margin-top: 25px;
        }

        .feature-list li {
            margin-bottom: 14px;
            padding-left: 30px;
            position: relative;
            font-weight: 500;
        }

        .feature-list li::before {
            content: "✔";
            position: absolute;
            left: 0;
            color: #ff3d00;
            font-weight: bold;
        }

        .full-width {
            background: #f8f9fa;
            padding: 100px 0;
        }

        .stat-box {
            background: #fff;
            padding: 35px;
            border-radius: 14px;
            text-align: center;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .stat-box h3 {
            font-size: 40px;
            font-weight: 700;
            color: #ff3d00;
        }

        .team-card img {
            width: 100%;
            border-radius: 16px;
        }

        .team-card h5 {
            margin-top: 15px;
            font-weight: 600;
        }
    </style>

    <main class="main about-page">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">About Us</h1>
            </div>
        </div>

        <!-- BREADCRUMB -->
        <nav class="breadcrumb-nav mb-10 pb-8">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </nav>
        <section class="about-hero">
            <div class="container">
                <div class="row align-items-center">

                    <!-- LEFT CONTENT -->
                    <div class="col-lg-6 mb-5">
                        {!! optional($page)->content !!}
                    </div>

                    <div class="col-lg-6 mb-5">
                        <img src="{{ asset('uploads/pages/' . optional($page)->image) }}"
                            alt="Company Overview">
                    </div>

                </div>
            </div>
        </section>
        {{-- <section class="full-width">
            <div class="container text-center">
                <h2 class="mb-4">
                    Our Mission & Vision
                </h2>
                <p class="mx-auto mb-5" style="max-width: 900px;">
                    Our mission is to empower businesses through technology-driven solutions
                    that are reliable, scalable, and future-ready. We aim to simplify complex
                    processes, improve efficiency, and help organizations stay ahead in an
                    ever-evolving digital landscape.
                </p>
            </div>
        </section> --}}
    </main>
@endsection
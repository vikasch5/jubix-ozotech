@extends('frontend.common.master')

@section('content')
    <style>
        .policy-box {
            background: #fff;
            border-radius: 14px;
            padding: 40px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .policy-box h4 {
            margin-top: 30px;
            font-weight: 600;
        }

        .policy-box p,
        .policy-box li {
            color: #555;
            font-size: 15px;
            line-height: 1.8;
        }

        .policy-box ul {
            padding-left: 20px;
        }
    </style>

    <main class="main">

        <!-- Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Terms & Conditions</h1>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav mb-10 pb-1">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Terms & Conditions</li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <section class="policy-section py-10">
                    <div class="policy-box">
                        {!! optional($page)->content !!}
                    </div>
                </section>
            </div>
        </div>

    </main>
@endsection
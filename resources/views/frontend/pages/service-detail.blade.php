@extends('frontend.common.master')
@section('content')
    <style>
        .product-inquiry {
            margin-top: 12px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            /* gap: 6px; */
            padding: 10px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            transition: all 0.35s ease;
            white-space: nowrap;
        }

        .action-btn i {
            font-size: 14px;
        }

        /* WhatsApp */
        .action-btn.whatsapp {
            background: linear-gradient(135deg, #25D366, #1DA851);
        }

        /* Call */
        .action-btn.call {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        /* Enquiry */
        .action-btn.enquiry {
            background: linear-gradient(135deg, #ff7a18, #ff3d00);
        }

        /* Hover Effects */
        .action-btn:hover {
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.25);
            color: #fff;
        }

        /* Mobile Optimization */
        @media (max-width: 575px) {
            .action-btn {
                padding: 9px 12px;
                font-size: 12px;
            }
        }
    </style>
    <main class="main">
            <div class="page-content mb-8">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="col-md-12 post-single-content">
                            <div class="post post-grid post-single">
                                <div class="post-details">
                                    <h2 class="post-title text-center mt-4"><a href="#">{{ $service->title }}</a></h2>
                                    <div class="post-content">
                                        {!! $service->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
@endsection
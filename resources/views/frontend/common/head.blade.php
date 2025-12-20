<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>
        @yield('meta_title', optional($settings)->meta_title)
    </title>
    <meta name="description" content="@yield('meta_description', optional($settings)->meta_description)">
    <meta name="keywords" content="@yield('meta_keywords', optional($settings)->meta_keywords)">
    <meta name="author" content="Jubix Technologies">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset(optional($settings)->favicon) }}">
    <link rel="shortcut icon" href="{{ asset(optional($settings)->favicon) }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset(optional($settings)->favicon) }}">
    <!-- Favicon -->
    <link rel="preload" href="{{ asset('frontend/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('frontend/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('frontend/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('frontend/fonts/wolmart87d5.woff?png09e" as="font" type="font/woff')}}"
        crossorigin="anonymous">
    <!-- Vendor CSS -->
    <link rel="stylesheet" defer type="text/css" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" defer type="text/css" href="{{ asset('frontend/css/style.min.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" defer href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css')}}">
    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.min.css')}}">
    <link rel="stylesheet" defer type="text/css"
        href="{{ asset('frontend/vendor/magnific-popup/magnific-popup.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/demo2.min.css')}}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
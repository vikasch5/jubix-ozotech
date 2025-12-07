<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="ZYNIX - Laravel Bootstrap 5 Premium Admin &amp; Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="laravel template, laravel admin, laravel dashboard, laravel admin panel, laravel admin template, dashboard for laravel, admin panel for laravel, template dashboard, bootstrap dashboard, dashboard template, bootstrap admin template, bootstrap 5 admin template, admin template, admin panel in laravel">

    <title>Admin Panel - News</title>

    <!-- FAVICON -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('backend/assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    {{--
    <link id="style" href="{{ asset('backend/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- APP SCSS -->
    <link rel="preload" as="style" href="{{ asset('backend/assets/app-BB87L1Zm.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/app-BB87L1Zm.css')}}" />

    <!-- ICONS CSS -->
    <link href="{{ asset('backend/assets/icon-fonts/icons.css')}}" rel="stylesheet">

    <!-- NODE WAVES CSS -->
    <link href="{{ asset('backend/assets/libs/node-waves/waves.min.css')}}" rel="stylesheet">

    <!-- SIMPLEBAR CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/simplebar/simplebar.min.css')}}">

    <!-- PICKER CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/%40simonwep/pickr/themes/nano.min.css')}}">

    <!-- AUTO COMPLETE CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/%40tarekraafat/autocomplete.js')}}">

    <!-- CHOICES CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/choices.js')}}">

    <!-- CHOICES JS -->
    <script src="{{ asset('backend/assets/libs/choices.js')}}"></script>

    <!-- MAIN JS -->
    <script src="{{ asset('backend/assets/main.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        table.table th,
        table.table td {
            white-space: normal;
            /* allows text wrapping */
        }
    </style>
</head>
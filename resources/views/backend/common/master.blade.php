<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-width="fullwidth" data-menu-styles="light" data-toggled="close">
@include('backend.common.head')

<body>
    @include('backend.common.preloader')
    <div class="page">
        @include('backend.common.header')
        @include('backend.common.sidebar')
        @yield('content')
    </div>

    @include('backend.common.footer')
    @yield('scripts')
    <script>$(document).ready(function () {
            $('#summernote').summernote({
                height: 350,

                toolbar: [
                    ['style', ['style']],

                    ['font', ['bold', 'italic', 'underline', 'strikethrough',
                        'superscript', 'subscript', 'clear']],

                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],

                    ['color', ['color']],

                    ['para', ['ul', 'ol', 'paragraph']],

                    ['height', ['height']],

                    ['table', ['table']],

                    ['insert', ['link', 'picture', 'video', 'hr']],

                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ],

                fontSizes: [
                    '8', '9', '10', '11', '12', '14', '16', '18', '20',
                    '24', '28', '32', '36', '48', '64', '72', '96'
                ]
            });
        });</script>

</body>

</html>
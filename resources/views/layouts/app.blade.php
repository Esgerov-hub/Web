<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Weblabs - @yield('weblabs.title')</title>
    <meta name="author" content="vecuro">
    <meta name="description" content="WebLabs.az">
    <meta name="keywords" content="WebLabs.az">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('weblabs/assets/img/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('weblabs/assets/img/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('weblabs/assets/img/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('weblabs/assets/img/favicons/apple-icon-76x76.png')  }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('weblabs/assets/img/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('weblabs/assets/img/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('weblabs/assets/img/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('weblabs/assets/img/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('weblabs/assets/img/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('weblabs/assets/img/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('weblabs/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('weblabs/assets/img/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('weblabs/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('weblabs/assets/img/favicons/manifest.html') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('weblabs/assets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700&amp;family=Fira+Sans:wght@400;500&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('weblabs/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('weblabs/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('weblabs/assets/css/style.css') }}">
@yield('aheng.css')
</head>

<!-- page wrapper -->
<body >

    <!-- /.preloader -->
    @include('layouts.partials.header')

    @yield('weblabs.content')

   @include('layouts.footer')
<!-- jequery plugins -->
    <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>
    <script src="{{ asset('weblabs/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('weblabs/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('weblabs/assets/js/layerslider.utils.js') }}"></script>
    <script src="{{ asset('weblabs/assets/js/layerslider.transitions.js') }}"></script>
    <script src="{{ asset('weblabs/assets/js/layerslider.kreaturamedia.jquery.js') }}"></script>
    <script src="{{ asset('weblabs/assets/js/main.js') }}"></script>
@yield('aheng.js')
</body><!-- End of .page_wrapper -->
</html>

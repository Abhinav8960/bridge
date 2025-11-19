<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Skoodos Bridge')</title>
    <meta name="description" content="@yield('metadescription', 'Skoodos Bridge')">
    <meta name="keywords" content="@yield('keyword', 'Skoodos Bridge')">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K5N205VHLJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-K5N205VHLJ');
    </script>

    {{-- @yield('og') --}}
    {{-- <meta content="Skoodos, Skoodos Bridge" name="keywords"> --}}

    <!-- Favicons -->
    <link href="/favicon.png" rel="icon">
    <!-- <link href="{{ asset('assets/skoodos/assets/img/apple-touch-icon.png" rel="apple-touch-icon') }}"> -->
    <!-- Vendor CSS Files -->

    <link href="{{ asset('assets/skoodos/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/skoodos/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/skoodos/assets/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skoodos/assets/vendor/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skoodos/assets/vendor/slick/slick-lightbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css" />
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/skoodos/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/skoodos/assets/css/responsive.css') }}">
    @if (!Route::is('institute.microsite'))
        <link rel="stylesheet" href="{{ asset('assets/skoodos/assets/css/static.css') }}">
    @endif

    @stack('styles')
    @livewireStyles()

</head>

<body>

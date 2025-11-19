<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Skoodos Bridge')</title>
    <meta name="description" content="@yield('description', 'Skoodos Bridge')">
    <link href="/favicon.png" rel="icon">
    @yield('og')
    <!-----==== Css Links ====---->
    <link rel="stylesheet" href="{{ asset('/assets/skoodos/mobile/assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('/assets/skoodos/mobile/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/skoodos/mobile/assets/vendor/slick/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/skoodos/mobile/assets/vendor/slick/slick-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/skoodos/mobile/assets/css/style.css') }}" />
    <!-----==== End Css Links ====---->
    @stack('styles')

</head>

<body>

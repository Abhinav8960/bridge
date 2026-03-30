<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Skoodos Bridge')</title>
    <meta name="description" content="@yield('description', 'Skoodos Bridge')">
    @yield('og')

    <!-----==== Css Links ====---->
    <link rel="stylesheet" href="{{ '/assets/skoodos/mobile/assets/vendor/bootstrap/css/bootstrap.min.css' }}" />
    <link rel="stylesheet" href="{{ '/assets/skoodos/mobile/assets/vendor/bootstrap-icons/bootstrap-icons.css' }}" />
    <link rel="stylesheet" href="{{ '/assets/skoodos/mobile/assets/vendor/slick/slick.css' }}" />
    <link rel="stylesheet" href="{{ '/assets/skoodos/mobile/assets/vendor/slick/slick-theme.css' }}" />
    <link rel="stylesheet" href="{{ '/assets/skoodos/mobile/assets/vendor/slick/slick-lightbox.css' }}">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ '/assets/skoodos/mobile/assets/css/style.css' }}" />
    <!-----==== End Css Links ====---->
    @stack('styles')

</head>

<body style="background-color:#004D85">

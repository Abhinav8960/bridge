@include('layouts._head')
@include('layouts._pre_header')
@include('layouts.navbar')

@if (!Route::is('homepage'))
    @include('layouts.search-component')
@endif

@yield('content')


@include('layouts._footerbar')
@include('layouts._footer')

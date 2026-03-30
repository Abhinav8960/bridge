@include('layouts._head')
@include('layouts._pre_header')
@include('layouts.navbar')

{{-- @if (!Route::is('homepage'))
    @include('layouts.search-component')
@endif --}}

<section class="error">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <img src="@yield('image')" alt="">
                {{-- @yield('code') --}}
                <h1>Oops!</h1>
                <p>@yield('message')</p>
            </div>

        </div>

    </div>

  </section>


  @include('layouts._footerbar')
  @include('layouts._footer')


  

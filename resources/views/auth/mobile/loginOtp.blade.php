@extends('layouts.mobile.masterlogin')

@section('content')
    <main id="main">

        <!-- ------------------Login--------------------- -->

        <header class="auth-header">
            <div class="container">
                <nav class="navbar">
                    <a href="/"><i class="bi bi-arrow-left"></i>Login With OTP</a>
                </nav>
            </div>
        </header>

        <section class="section-auth" style="background-image: url(/assets/skoodos/assets/img/auth-bg.png);">
            @livewire('auth.login-with-otp')
        </section>

    </main><!-- End #main -->
@endsection
@push('styles')
    @livewireStyles()
@endpush
@push('scripts')
    @livewireScripts()
@endpush

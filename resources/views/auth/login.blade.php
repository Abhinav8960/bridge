@extends('layouts.master')

@section('content')
    <main id="main">

        <section class="login">
            <div class="container">
                <div class="login-page mt-5 mb-5">
                    <div class="login-left-box d-flex">
                        <div class="login-left">
                            <div class="inner_center">
                                <h3>Welcome Back to <span>Skoodos Bridge!</span></h3>
                                <p>A Connection Between Student & Institutes</p>
                                    @include('layouts.flash-message')

                                <form class="login_form" method="POST" action="{{ route('student.auth.login') }}">
                                    @csrf
                                    <h6>Login With Password</h6>
                                    <div class="login_input">

                                        <input id="phone" type="tel"
                                            class="form-control @error('phone') is-invalid @enderror" maxlength="10"
                                            name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                            autofocus placeholder="Mobile"
                                            onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                            onpaste="return false">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="login_input">

                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required placeholder="Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="login_forgot">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        @endif
                                        @if (Route::has('student.login.with.otp'))
                                        <a href="{{ route('student.login.with.otp') }}">Login with OTP</a>
                                        @endif
                                    </div>
                                    <div class="login_buttons">
                                        <button type="submit" class="yellow-btn">Login</button>
                                        <span class="text-muted">New User?</span>
                                            @if (Route::has('student.register'))
                                                <a class="btn btn-link" href="{{ route('student.register') }}">
                                                    {{ __('Register') }}
                                                </a>
                                            @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="login-right-box text-center">
                        <div class="login-right-bg ">
                            <img src="/assets/skoodos/assets/img/login-banner.png" alt="">
                            <h2>We are connect with <span>limitless Institutes</span> across India.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

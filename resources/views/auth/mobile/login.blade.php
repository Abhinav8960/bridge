@extends('layouts.mobile.masterlogin')

@section('content')
    <main>
        <header class="auth-header" id="myHeader">
            <div class="container">
                <nav class="navbar">
                    <a href="/"><i class="bi bi-arrow-left"></i> Sign In</a>
                </nav>
            </div>
        </header>

        <section class="section-auth" style="background-image: url(/assets/skoodos/assets/img/auth-bg.png);">
            <div class="container">
                <div class="auth__content">
                    <div class="d-flex justify-content-between">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                        <p><span class="text-muted">New User?</span>
                            @if (Route::has('student.register'))
                                <a href="{{ route('student.register') }}">
                                    Register
                                </a>
                            @endif
                        </p>
                    </div>
                    <div class="auth__content__heading">
                        <h1>Welcome Back to <span>Skoodos Bridge!</span></h1>
                        <p>A Connection Between Student & Institutes</p>
                    </div>
                    <div class="auth__content__text">
                        <h2>Login With Password</h2>

                        <form class="login_form" method="POST" action="{{ route('student.login') }}">
                            @csrf
                            <div class="mb-4">
                                <input id="phone" type="tel"
                                    class="form-control @error('phone') is-invalid @enderror" maxlength="10" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Mobile"
                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                    onpaste="return false">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4 text-center">
                                @if (Route::has('student.login.with.otp'))
                                    <a href="{{ route('student.login.with.otp') }}">Login with OTP</a>
                                @endif
                            </div>
                            <div class="auth-btn-wrapper">
                                <button type="submit" class="btn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

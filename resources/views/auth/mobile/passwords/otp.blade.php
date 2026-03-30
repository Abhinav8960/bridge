@extends('layouts.mobile.masterlogin')

@section('content')
    <main>
        <header class="auth-header">
            <div class="container">
                <nav class="navbar">
                    <a href="/"><i class="bi bi-arrow-left"></i>Forgot Password</a>
                </nav>
            </div>
        </header>

        <section class="section-auth forget-password" style="background-image: url(/assets/skoodos/assets/img/auth-bg.png);">
            <div class="container">
                <div class="auth__content">
                    <div class="d-flex justify-content-between">
                        @if (Route::has('student.register'))
                            <p><span class="text-muted">Existing User?</span> <a
                                    href="{{ route('student.login') }}">Login</a></p>
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
                        <h1>Forget<span> Password?</span></h1>
                        <p>Please Enter Your Mobile Number</p>
                    </div>
                    <div class="auth__content__text">
                        <form method="POST" action="{{ route('password.send.otp') }}">
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
                            <div class="auth-btn-wrapper">
                                <button type="submit" class="btn">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

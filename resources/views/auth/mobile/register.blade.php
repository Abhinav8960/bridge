@extends('layouts.mobile.masterlogin')

@section('content')
    <main>

        <header class="auth-header">
            <div class="container">
                <nav class="navbar">
                    <a href="/"><i class="bi bi-arrow-left"></i> Sign Up</a>
                </nav>
            </div>
        </header>

        <section class="section-auth" style="background-image: url(/assets/skoodos/assets/img/auth-bg.png);">
            <div class="container">
                <div class="auth__content auth__content--register">
                    <div class="d-flex justify-content-between">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                        @if (Route::has('student.register'))
                            <p><span class="text-muted">Existing User?</span> <a
                                    href="{{ route('student.login') }}">Login</a></p>
                        @endif
                    </div>
                    <div class="auth__content__heading">
                        <h1>Looks Like You’re <span>New Here!</span></h1>
                        <p>Sign Up To Get Started</p>
                    </div>
                    <div class="auth__content__text">
                        <form class="login_form" method="POST" action="{{ route('student.register.store') }}">
                            @csrf
                            <div class="mb-2">

                                <input id="schoolname" type="text"
                                    class="form-control @error('school-name') is-invalid @enderror" name="school-name"
                                    required placeholder="School Name">

                                @error('school-name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-2">

                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" required
                                    placeholder="Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-2">
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
                            <div class="mb-2">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email" required
                                    placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <input id="confirmPassword" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required placeholder="Confirm Password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree to Skoodos Bridge<a href=""> Terms Of Use </a> &amp; <a
                                            href=""> Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                            <div class="auth-btn-wrapper">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

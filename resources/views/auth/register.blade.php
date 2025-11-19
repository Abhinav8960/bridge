@extends('layouts.master')

@section('content')

    <main id="main">

        <!-- ------------------Login--------------------- -->

        <section class="login register">
            <div class="container">
                <div class="login-page mt-5 mb-5">
                    <div class="login-left-box d-flex">
                        <div class="login-left">
                            <div class="inner_center">
                                <h3>Looks Like You're <span>New Here!</span></h3>
                                <p>Sign Up To Get Started</p>
                                @include('layouts.flash-message')

                                <form class="login_form" method="POST" action="{{ route('student.register.store') }}">
                                    @csrf
                                    {{-- <div class="login_input">

                                        <input id="schoolname" type="text"
                                            class="form-control @error('school-name') is-invalid @enderror"
                                            name="school-name" required placeholder="School Name">

                                        @error('school-name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="login_input">

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required placeholder="Name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="login_input">
                                        <input id="phone" type="tel"
                                            class="form-control @error('phone') is-invalid @enderror" maxlength="10"
                                            name="phone" value="{{ old('phone') }}" required autocomplete="phone" value="{{ old('phone') }}"
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
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                            required placeholder="Email">

                                        @error('email')
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
                                    <div class="login_input">
                                        <input id="confirmPassword" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" required placeholder="Confirm Password">

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-check mt-4 d-flex align-items-center">
                                        <input class="form-check-input @error('tc') is-invalid @enderror" type="checkbox" value="1" id="flexCheckDefault"
                                            name="tc">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree to Skoodos Bridge <a href=""> Terms Of Use </a> & <a
                                                href=""> Privacy Policy</a>
                                        </label>
                                        @error('tc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                    <div class="login_buttons mt-4">
                                        <button type="submit" class=" yellow-btn">Sign Up</button>
                                        <span class="text-muted">Existing User?</span>
                                        @if (Route::has('student.register'))
                                            <a class="register_btn" href="{{ route('student.login') }}">
                                                &nbsp;Log In
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="login-right-box ">
                        <div class="login-right-bg text-center">
                            <img src="/assets/skoodos/assets/img/login-banner.png" alt="">
                            <h2>We are connect with <span>limitless Institutes</span> across India.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

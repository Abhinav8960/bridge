@extends('backend::layouts.auth.master')

@section('title')
    Login
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6 login-section-wrapper align-items-center">
                    <div class="login-wrapper my-auto">
                        <div class="d-flex align-items-center">
                            <img src="/assets/backend/images/mnemonic.png" alt="logo" class="logo">
                            <div class="pl-2">
                                <h1 class="login-title">Login</h1>
                                <h2 class="login-sub-title">Please Enter The Following:</h2>
                            </div>
                        </div>
                        @include('layouts.flash-message')

                        <form class="pt-4 d-grid gap-3" method="POST" action="{{ route('backend.login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="phone" id="phone"
                                    class="form-control  @error('phone') is-invalid @enderror"
                                    placeholder="10 Digit Mobile Number" maxlength="10"
                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                    onpaste="return false" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" id="password"
                                    class="form-control  @error('password') is-invalid @enderror"
                                    placeholder="Your Passsword" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center form-group mb-4">
                                {!! NoCaptcha::display() !!}
                                {!! NoCaptcha::renderJs() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="d-grid gap-2">
                                <button id="login" class="btn login-btn" type="submit">Login</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center pt-4">
                            <a href="{{ route('backend.password.request') }}" class="forgot-password-link">Forgot Password</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 px-0">
                    <img src="/assets/backend/images/artwork.jpg" alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>
@endsection

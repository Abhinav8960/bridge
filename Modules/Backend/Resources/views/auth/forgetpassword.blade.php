@extends('backend::layouts.auth.master')

@section('title')
    Forget Password
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
                                <h1 class="login-title">Forgot Password</h1>
                                <h2 class="login-sub-title">Receive Password Via SMS:</h2>
                            </div>
                        </div>
                        @include('layouts.flash-message')
                        <form class="pt-4 d-grid gap-3" method="POST" action="{{ route('backend.password.send.otp') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Enter Your 10 Digit Mobile Number" maxlength="10"
                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                    onpaste="return false" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="justify-content-center form-group mb-4">
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                            <div class="d-grid gap-2">
                                <button id="login" class="btn login-btn" type="submit">Send</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center pt-4">
                            <a href="{{ route('backend.login') }}" class="forgot-password-link">Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 px-0">
                    <img src="/assets/backend/images/artwork.jpg" alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>
    {!! NoCaptcha::renderJs() !!}

@endsection

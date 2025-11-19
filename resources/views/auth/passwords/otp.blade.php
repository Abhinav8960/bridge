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


                                <form method="POST" action="{{ route('password.send.otp') }}">
                                    @csrf

                                    <div class="row mb-3">

                                        <div class="col-md-12">
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
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
                                        </div>
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

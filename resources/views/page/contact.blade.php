@extends('layouts.master')
@section('title')
Contact Skoodos Bridge
@endsection
@section('metadescription')
Connect with us at Skoodos Bridge. Whether you have inquiries or need support, our team is ready to assist you at any time.
@endsection

@section('content')
    <section class="contact-hero">
        <img src="/assets/skoodos/assets/img/Contact-Banner.png" alt="" class="w-100">
    </section>

    <!-- =========== End Contact Hero ======== -->

    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- =========== Contact  ======== -->

    <section class="contact">
        <div class="container">

            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if (Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                    @endif
                @endforeach
            </div>

              <div class="row">
                <div class="col-lg-4">
                    <div class="ps-4 pe-4 contact-loc">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14035.34429624174!2d77.107557!3d28.4242028!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x66f70b002eba8467!2sSkoodos!5e0!3m2!1sen!2sin!4v1655530858269!5m2!1sen!2sin"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <h3>Skoodos Bridge</h3>
                        <p>A Venture of
                            Spherion Solutions Pvt Ltd
                            A-1/309, Sushant Lok - 2,
                            Sector - 55, Gurugram 122011</p>

                        <div class="contact-links mt-3">
                            @livewire('contact')
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <h2>CONTACT US </h2>
                    <hr>

                    @include('layouts.flash-message')

                    <form method="POST" action="{{ route('contactStore') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 my-2">
                                <input type="text" class="form-control" name="name" id="exampleInputText"
                                    aria-describedby="text" placeholder="Name*" required>
                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="col-md-6 my-2">
                                <input type="text" maxlength="10" name="mobile" class="form-control" id="mobile"
                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                    onpaste="return false" placeholder="Phone*" required=""
                                    {{ $errors->has('mobile') ? 'has-error' : '' }}>
                                <span class="alert-danger">{{ $errors->first('mobile') }}</span>
                            </div>
                            <div class="col-md-6 my-2">
                                <input type="email" name="email" class="form-control" aria-describedby="emailHelp"
                                    placeholder="Email*" required>
                                <span class="alert-danger">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="col-md-6 my-2">
                                <select class="form-select" name="type" aria-label="Default select example">
                                    <option selected="">Type*</option>
                                    @foreach($conatctTypeOptions as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                    @endforeach

                                </select>
                                <span class="alert-danger">{{ $errors->first('type') }}</span>
                            </div>
                            <div class="col-md-12 my-2">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="message" placeholder="Message*"
                                    required></textarea>
                                <span class="alert-danger">{{ $errors->first('message') }}</span>
                            </div>
                            <div class="col-md-12 my-2">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button href="" class="btn yellow-btn " type="submit">Submit</button>
                            </div>

                        </div>


                    </form>

                </div>
              </div>
        </div>
    </section>
@endsection
{!! NoCaptcha::renderJs() !!}

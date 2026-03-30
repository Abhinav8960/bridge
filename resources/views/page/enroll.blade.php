@extends('layouts.master')
@section('title')
Enroll your Coaching Institute | Skoodos Bridge
@endsection
@section('metadescription')
Discover seamless enrollment for your coaching institute at Skoodos Bridge. Streamline your educational services by enrolling with us today. Join a platform designed to elevate your coaching institute's reach and impact.

@endsection
@section('keyword')
Enrollment, Enrol Now, join us, Registration, Online Enrollment System, Enrol With Us

@endsection
@section('content')
    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Enroll</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="enroll-hero">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="enroll-hero-left">
                    <div class="enroll-hero-left-text">
                        <h1> Helping You Navigate The Complex World of <br>
                            Competitive Exams Coaching </h1>
                    </div>
                </div>
                <div class="enroll-hero-right">
                    <div class="enroll-hero-form">
                        <h2>FILL YOUR <span>INSTITUTE DETAILS</span>
                        </h2>
                        @include('layouts.flash-message')

                        <form method="post" action="{{ route('storeEnroll') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <input type="text" class="form-control" id="name" name="name"
                                        aria-describedby="text" placeholder="Name*" value="{{ old('name') }}"
                                        required="">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <input type="text" class="form-control" name="institute" id="institute"
                                        aria-describedby="text" placeholder="Institute Name*" value="{{ old('institute') }}"
                                        required="">
                                    @error('institute')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    {{-- <input type="text" class="form-control" name="city" id="city"
                                        aria-describedby="text" placeholder="City" value="{{ old('city') }}"
                                        required=""> --}}
                                    <select class="form-control select2" name="city" required>
                                        <option value="">--Select City--</option>
                                        @foreach ($cities as $key => $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <input type="text" class="form-control" id="phone" aria-describedby="text"
                                        placeholder="Phone" maxlength="10" name="phone"
                                        onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                        onpaste="return false" value="{{ old('phone') }}" required="">
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="text" placeholder="Email" value="{{ old('email') }}"
                                        required="">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="btn-wrapper">
                                    <button class="btn yellow-btn " type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- -----------================= Orgnization =============-------------- -->

    <section class="enroll-heading">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>ORGANIZING THE WORLD OF <span>EXAMS & INSTITUTES</span></h2>
                    <p>Best Online Platform in India to search For UPSC, UPPCS, BPSC,BSSC, UPSSSC, SSC, Bank, Railway, Air
                        Force, NDA, CDS, CAPF and Other competitive Examination and Institutes.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="orgnization">
        <div class="container-fluid">
            <div class="orgnization-items">
                <div class="orgnization-item">
                    <div class="item-content">
                        <img src="/assets/skoodos/assets/img/homepage/UpperBanner/Logo.png" alt="" class="logo">
                    </div>
                </div>
                <div class="orgnization-item">
                    <div class="item-content">
                        <img src="/assets/skoodos/assets/img/Categories.png" alt="">
                        <h3>Exam Categories</h3>
                        <p>Entrance Exams</p>
                        <p>Government Exams</p>
                        <p>Foreign Language Exams</p>
                    </div>
                </div>
                <div class="orgnization-item">
                    <div class="item-content">
                        <img src="/assets/skoodos/assets/img/Stream.png" alt="">
                        <h3>Exam Streams</h3>
                        <p>Medical, Engineering <br>
                            Banking, Railways, UPSC <br>
                            English, Frenchm German</p>
                    </div>
                </div>
                <div class="orgnization-item">
                    <div class="item-content">
                        <img src="/assets/skoodos/assets/img/Exams.png" alt="">
                        <h3>Exams</h3>
                        <p> IIT, AIEE, AIMS <br>
                            NEET, ATMA, BMAT, NDA <br>
                            IELTS, TOEFL, GRE</p>
                    </div>
                </div>
                <div class="orgnization-item">
                    <div class="item-content">
                        <img src="/assets/skoodos/assets/img/Institutes.png" alt="">
                        <h3>Institutes</h3>
                        <p>ABC Enterance Coaching <br>
                            XYZ Coaching Centre <br>
                            World Language Centre</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- -----------================= Orgnization =============-------------- -->

    <!-- ----------============= enroll-microsite ==============----------->

    <section class="enroll-heading">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>DEDICATED MICROSITE FOR <span>ENHANCED VISIBILITY</span></h2>
                    <p>Browse through our dedicated microsite, your gateway to the city's top coaching institutes, to
                        Explore, connect, and excel in your academic and professional journey. </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ----------============= enroll-microsite ==============----------->

    <!-- ---------================ Tab -img ===============----------- -->

    <section class="tab-img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <img src="/assets/skoodos/assets/img/enroll-img-1.png" alt="">

                </div>
            </div>
        </div>
    </section>

    <!-- ---------================ Tab -img ===============----------- -->

    <!-- ---------=============== enroll-banner =============----------- -->

    <section class="enroll-banner d-flex justify-content-center">
        <div class="container">
            <div class="row w-100">
                <div class="col-6">
                    <div class="enroll-banner-text">
                        <h2>DYNAMIC LEADS THROUGH <br>
                            <span>REAL TIME TRAFFIC</span>
                        </h2>
                        <p>Secure inquiries directly into your microsite control panel. Maximize your business growth with streamlined communication and engagement.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --------================= End enroll banner ==================------ -->

    <!-- ----------============= enroll-microsite ==============----------->

    <section class="enroll-heading">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>FEATURED LISTINGS ON <span>HOME / CATEGORY PAGE</span></h2>
                    <p>Maximize your coaching institute's exposure with our featured listings on Prime Spot. Seize the
                        attention of eager students and supercharge your enrollment rates.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ----------============= enroll-microsite ==============----------->

    <!-- ---------================ Tab -img ===============----------- -->

    <section class="tab-img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <img src="/assets/skoodos/assets/img/enroll-img-2.png" alt="">

                </div>
            </div>
        </div>
    </section>

    <!-- ---------================ Tab -img ===============----------- -->

    <!-- ----------============= enroll-microsite ==============----------->

    <section class="enroll-heading">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>COMPREHENSIVE SEARCH WITH <span>REAL TIME FILTERS</span></h2>
                    <p>Showcase your coaching institute's presence with our comprehensive search and real-time filters.
                        Stand out and attract motivated students actively seeking your tailored programs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ----------============= enroll-microsite ==============----------->

    <!-- ---------================ Tab -img ===============----------- -->

    <section class="tab-img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <img src="/assets/skoodos/assets/img/enroll-img-3.png" alt="">

                </div>
            </div>
        </div>
    </section>
@endsection
{!! NoCaptcha::renderJs() !!}

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".cSlider")
                .slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true,
                    autoplay: false,
                    responsive: [{
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    }, ],
                    prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                    nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
                });

            $('.cSlider').slickLightbox({
                src: 'src',
                itemSelector: '.item img',
                background: 'rgba(0, 0, 0, .7)'
            });

            $(".job-slider")
                .slick({
                    infinite: true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true,
                    autoplay: true,
                    responsive: [{
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    }, ],
                });
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $('.cSlider').slick('setPosition');
            $('.job-slider').slick('setPosition');
        });
    </script>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endpush

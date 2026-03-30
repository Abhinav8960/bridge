@extends('layouts.master')
@section('title')
    About Us – Skoodos Bridge
@endsection
@section('metadescription')
    Skoodos Bridge is a one-stop platform helping students find best coaching institutes and exams held in India and abroad.
    Select the most excellent coaching for exam preparation and an extensive search engine for the students.
@endsection
@section('keyword')
    Skoodos Bridge
@endsection
@section('content')
    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">About</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- =========== End About======== -->
    <nav class="about-nav">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-leadership-tab" data-bs-toggle="tab" data-bs-target="#nav-leadership"
                type="button" role="tab" aria-controls="nav-leadership" aria-selected="true">LEADERSHIP</button>
            <button class="nav-link" id="nav-philosophy-tab" data-bs-toggle="tab" data-bs-target="#nav-philosophy"
                type="button" role="tab" aria-controls="nav-philosophy" aria-selected="false">PHILOSOPHY</button>
            <button class="nav-link" id="nav-venture-tab" data-bs-toggle="tab" data-bs-target="#nav-venture" type="button"
                role="tab" aria-controls="nav-venture" aria-selected="false">VENTURES</button>
            <button class="nav-link" id="nav-careers-tab" data-bs-toggle="tab" data-bs-target="#nav-careers" type="button"
                role="tab" aria-controls="nav-careers" aria-selected="false">CAREERS</button>
        </div>
    </nav>
    <div class="tab-content p-0" id="nav-tabContent">
        <!-- --------- Leadership Tab ---------- -->
        <div class="tab-pane fade show active" id="nav-leadership" role="tabpanel" aria-labelledby="nav-leadership-tab">
            <div class="leadership">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="leadership_content">
                                <h1>OUR <span>LEADERSHIP</span><br>
                                    SAILS IPSUM DESREIM </h1>
                                <p>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum
                                    sociis natoque penatibus et magnis dis parturient </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="founders-content">
                <div class="container">
                    <div class="items d-flex">
                        <div class="item text-center">
                            <img src="/assets/skoodos/assets/img/about-us/Dr-Siya.png" alt="">
                            <div class="founders_details">
                                <h2>DR. SIYA SETH</h2>
                                <h3>(FOUNDER & CEO)</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                    eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                    eu, pretium quis, sem. <br><br>

                                    Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
                                    vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                    justo. Nullam dictum felis eu pede mollis pretium. </p>
                            </div>
                        </div>
                        <div class="item text-center">
                            <img src="/assets/skoodos/assets/img/about-us/Shrut-Verma.png" alt="">
                            <div class="founders_details">
                                <h2>SHRUTI VERMA</h2>
                                <h3>(CO-FOUNDER)</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                    eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                    eu, pretium quis, sem. <br><br>

                                    Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
                                    vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                    justo. Nullam dictum felis eu pede mollis pretium. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-philosophy" role="tabpanel" aria-labelledby="nav-philosophy-tab">
            <!----------------Philoshophy------------- -->
            <div class="philosophy-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-6">
                            <div class="philosophy-text ps-5">
                                <h1>WE CONVERT THOUGHTS <br>
                                    <span>INTO CONCEPTS</span>
                                </h1>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas laudantium
                                    inventore tempore illum quis laboriosam voluptatum cumque animi quae maiores
                                    illo ipsum vero, omnis corporis fugit saepe, non libero quasi.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="philosophy-item innovate">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="philosophy-text">
                                <h1>WE CONCEPTUALIZE<br>
                                    <span>TO INNOVATE</span>
                                </h1>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas laudantium
                                    inventore tempore illum quis laboriosam voluptatum cumque animi quae maiores
                                    illo ipsum vero, omnis corporis fugit saepe, non libero quasi.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="philosophy-item sustenance">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-6">
                            <div class="philosophy-text ps-5">
                                <h1>WE INNOVATE TO OFFER <br>
                                    <span>SUSTENANCE</span>
                                </h1>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas laudantium
                                    inventore tempore illum quis laboriosam voluptatum cumque animi quae maiores
                                    illo ipsum vero, omnis corporis fugit saepe, non libero quasi.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="philosophy-item expansion">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="philosophy-text">
                                <h1>WE SUSTAIN FOR<br>
                                    FURTHER <span>EXPANSION</span>
                                </h1>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas laudantium
                                    inventore tempore illum quis laboriosam voluptatum cumque animi quae maiores
                                    illo ipsum vero, omnis corporis fugit saepe, non libero quasi.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="philosophy-item integrate">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="philosophy-text ps-5">
                                <h1>WE EXPAND & FURTHER<br>
                                    <span>INTEGRATE</span>
                                </h1>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas laudantium
                                    inventore tempore illum quis laboriosam voluptatum cumque animi quae maiores
                                    illo ipsum vero, omnis corporis fugit saepe, non libero quasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-venture" role="tabpanel" aria-labelledby="nav-venture-tab">

            <!-- ------------- Venture -------------- -->
            <div class="venture-bg-silver">
                <div class="venture-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="venture-content">
                                    <img src="/assets/skoodos/assets/img/about-us/skoodos-school-logo.png" alt="">
                                    <hr>
                                    <h2>FINDING THE BEST SCHOOL FOR</h2>
                                    <h3>BETTER FUTURE.</h3>
                                    <p>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient </p>

                                    <a href="https://skoodos.com/" target="_blank" class="btn">VISIT WEBSITE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="venture-bg selin-bg">
                    <div class="container">
                        <div class="row">
                            <div class="venture-content text-center">
                                <p>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
                                    Cum sociis natoque penatibus et magnis dis parturient </p>

                                <a href="http://selinclub.com/" class="btn btn-visit-selin" target="_blank">VISIT
                                    WEBSITE</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- <div class="venture-bg bridge">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="venture-content">
                                                    <img src="/assets/skoodos/assets/img/about-us/bridge-logo.png" alt="">
                                                    <h2>Your Pathway To Finding The Best <br>
                                                        <span>Competitive Exams Coaching</span>
                                                    </h2>
                                                    <p>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
                                                        Cum sociis natoque penatibus et magnis dis parturient </p>

                                                    <a href="https://skoodosbridge.com/" class="btn btn-bridge" target="_blank">VISIT WEBSITE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                <div class="venture-bg mart">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center text-center">
                                <div class="venture-content">
                                    <h2>FOR EVERYTHING A<br>
                                    </h2>
                                    <h3>SCHOOL NEEDS</h3>
                                    <p>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                                        massa. Cum sociis natoque penatibus et magnis dis parturient </p>

                                    <a href="https://skoodosmart.com" class="btn btn-mart">VISIT WEBSITE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-careers" role="tabpanel" aria-labelledby="nav-careers-tab">

            <!-- ------------ Careers ------------- -->

            <div class="careers-hero">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="careers-content">
                                <h2>HOW <span>SPHERION</span> HELPS IN <br>
                                    YOUR CAREER <span>GROWTH</span>
                                </h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta sit sapiente
                                    harum, est quis et odit, quibusdam qui a magni, sequi quasi ipsa debitis numquam
                                    ad. Ipsa amet dolorum fuga?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="career-features">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <div class="career-features-img ">
                                <img src="/assets/skoodos/assets/img/about-us/talent.png" alt="">
                            </div>
                            <div class="career-features-content ">
                                <h2>SUPPORT TALENT</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                    eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus. Donec quam felis, ultricies sit amet,
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="career-features-img">
                                <img src="/assets/skoodos/assets/img/about-us/opportunity.png" alt="">
                            </div>
                            <div class="career-features-content">
                                <h2>EQUAL OPPORTUNITY</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                    eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus. Donec quam felis, ultricies sit amet,
                                </p>

                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="career-features-img">
                                <img src="/assets/skoodos/assets/img/about-us/ecosystem.png" alt="">
                            </div>
                            <div class="career-features-content">
                                <h2>GROWTH ORIENTED ECOSYSTEM</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                    eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus. Donec quam felis, ultricies sit amet,
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="career-slider">
                <div class="container">
                    <h2>GET A GLIMPSE INTO LIFE <br>
                        <span>@ SPHERION</span>
                    </h2>
                    <div class="items career-slide cSlider">
                        <div class="item">
                            <img src="/assets/skoodos/assets/img/about-us/img-1.png" alt="">
                        </div>
                        <div class="item">
                            <img src="/assets/skoodos/assets/img/about-us/img-2.png" alt="">
                        </div>
                        <div class="item">
                            <img src="/assets/skoodos/assets/img/about-us/img-3.png" alt="">
                        </div>
                        <div class="item">
                            <img src="/assets/skoodos/assets/img/about-us/img-4.png" alt="">
                        </div>
                        <div class="item">
                            <img src="/assets/skoodos/assets/img/about-us/img-4.png" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="career-roles">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2><span>DISCOVER</span> OUR LATEST FEATURED ROLES</h2>
                            <div class="row job-slider">
                                <div class="slide">
                                    <div class="latest-featured active">
                                        <h3>Sales Executive</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                    <div class="latest-featured">
                                        <h3>Digital Marketing - Head</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                    <div class="latest-featured">
                                        <h3>Digital Marketing - Head</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="latest-featured">
                                        <h3>Front -End Developer</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                    <div class="latest-featured">
                                        <h3>Social Media Analyst</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                    <div class="latest-featured">
                                        <h3>Social Media Analyst</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="latest-featured">
                                        <h3>Sales Executive</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                    <div class="latest-featured">
                                        <h3>Digital Marketing - Head</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                    <div class="latest-featured">
                                        <h3>Digital Marketing - Head</h3>
                                        <p>Gurgaon- Delhi NCR</p>
                                        <p>1 Position</p>
                                        <span>Full Time</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="job-application">
                                <div class="job-bg">
                                    <h2>UPLOAD YOUR <span>JOB</span> <br>
                                        APPLICATION</h2>
                                    <p>We will match your resume with our latest openings.</p>
                                    <form action="">
                                        <div class="mb-4">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Name *" required>
                                        </div>
                                        <div class="gap-3 d-flex mb-4">
                                            <input type="text" maxlength="10" class="form-control" id="mobile"
                                                onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                                onpaste="return false" placeholder="Mobile*" required="">
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Email*" required>
                                        </div>
                                        <!-- <div class="dropdown mb-4">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Job Role ----------------
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                <li><button class="dropdown-item" type="button">Action</button></li>
                                                                <li><button class="dropdown-item" type="button">Another
                                                                        action</button></li>
                                                                <li><button class="dropdown-item" type="button">Something else
                                                                        here</button></li>
                                                            </ul>
                                                        </div> -->
                                        <div class="dropdown mb-4">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected=""> Job Role ----------------</option>
                                                <option>Services</option>

                                            </select>
                                        </div>
                                        <div class="input-group custom-file-button">
                                            <label class="input-group-text" for="formFile">Upload Resume</label>
                                            <input type="file" class="form-control" id="formFile" required>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-5 gap-3">
                                            <div class="g-recaptcha"
                                                data-sitekey="6Le8oq8UAAAAADSyaubiMfcxL1IqnYNDLPHeCKa8"></div>
                                            <button href="javascript:void(0)" class="btn blue-btn "
                                                type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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

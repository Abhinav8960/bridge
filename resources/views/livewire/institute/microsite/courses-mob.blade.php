<div>
    <!-- ------------------- Courses ----------------------->
    <header class="sub-header">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <a href="/"><i class="bi bi-arrow-left"></i>Microsite: Courses</a>
                    <div class="d-flex gap-4">
                        {{-- @if (Route::is('configuration.*')) --}}
                        <a href="microsite.html" wire:click="showMobileFilter()" data-bs-toggle="modal"
                            data-bs-target="#microsite-filter"><i class="bi bi-funnel-fill"></i></a>
                        {{-- <a wire:click="showMobileFilter()" data-bs-toggle="modal"
                                data-bs-target="#microsite-filter"><i class="bi bi-funnel-fill"></i></a> --}}
                        <a href="" data-bs-toggle="modal" data-bs-target="#microsite-option-model"><img
                                src="/assets/skoodos/assets/img/microsite/Menu.png" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <section class="broucher-section">
        <div class="container">
            <div class="broucher-card">
                <img src="/assets/skoodos/assets/img/explore-listing/recommended.png" alt="" class="recomended">
                <div class="institute-details">
                    <div class="institute-img" style="display: flex;align-items:center;justify-content:center;">
                        <img src="{{ !empty($uploads->logo) ? Storage::disk('public')->url($uploads->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                            alt="">
                        @if (empty($uploads->logo))
                            <div style="position:absolute; text-align:center;">
                                <h2 style="font-size: 20px; font-weight:bold;">
                                    {{ $institute->nickname() }}

                                </h2>
                            </div>
                        @endif
                    </div>
                    <div class="institute-text">
                        @student
                            @if ($isWishlited)
                                <a style="cursor: pointer;" wire:click="removefromwishlist({{ $institute->id }})"><img
                                        src="/assets/skoodos/assets/img/Wishlist-Icon-a.png" alt=""></a>
                                @if ($confirmNow)
                                    <div class="modal fade modal-splash show" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-modal="true" role="dialog" style="display: block;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="modal-title" id="staticBackdropLabel">
                                                        <div class="row">
                                                            {{-- <div class="col-lg-3">
                                                                <img src="/assets/skoodos/assets/img/modal-logo.png"
                                                                    alt="">
                                                            </div> --}}
                                                            <div class="col-lg-9">
                                                                <h5>Remove From Wishlist</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close" wire:click="ConfirmNewModelClose()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-splash-text">
                                                        <p class="d-flex">
                                                            Are you sure you want to delete {{ $institute->name }}
                                                            from
                                                            your wishlist?
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="model-footer text-center p-2 ">

                                                    <button type="button" class="btn yellow-btn mx-2"
                                                        data-bs-dismiss="modal" aria-label="Close"
                                                        wire:click="removeinstitteFroWishlistAgree()">Yes</button>
                                                    <button type="button" class="btn yellow-btn mx-2"
                                                        wire:click="ConfirmNewModelClose()">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-backdrop fade show"></div>
                                @endif
                            @else
                                <a style="cursor: pointer;" wire:click="wishlistnow({{ $institute->id }})"><img
                                        src="/assets/skoodos/assets/img/microsite/WishList.png" alt=""></a>
                            @endif
                        @endstudent
                        {{-- <img src="/assets/skoodos/assets/img/microsite/WishList.png" alt=""> --}}
                        <h2>{{ !empty($institute->name) ? $institute->name : '' }}</h2>
                        <ul class="rating">
                            {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                        </ul>
                        <ul class="broucher-card-text">
                            <li><span><i class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                {{ $institute->city_name }}, {{ $institute->state_name }}
                            </li>
                            <li><span><i class="bi bi-telephone-fill"></i></span>+91
                                {{ $institute->general->phone_number_1 }}
                            </li>
                            <li><span><i class="bi bi-envelope-fill"></i></span>{{ $institute->general->email_1 }}
                                @if (!empty($institute->general->email_2))
                                    , {{ $institute->general->email_2 }}
                                @endif
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="broucher-btn">
                    <a href="">Download Brochure</a>
                </div>
            </div>
        </div>
    </section>
    <div class="tab-pane fade show active" id="pills-courses" role="tabpanel" aria-labelledby="pills-courses-tab">
        <section class="courses-card">
            @if (!empty($courses) && $courses->count() > 0)
                @foreach ($courses as $course)
                    <div class="container">
                        <div class="microstite-container">
                            <div class="courses-card__heading">
                                <h2><i class="bi bi-dot"></i>{{ $course->course_title }}</h2>
                            </div>
                            @if ($course->discount > 0)
                            <div class="courses-card__icons-text">
                                <div class="m-stream-icon-bg"
                                    style="background-image: url(/assets/skoodos/assets/img/enroll-discount.png);">
                                    <p><span><b>{{ $course->discount }}</b><sup>%</sup></span> Discount</p>
                                </div>
                            </div>
                            @endif
                            <p>{!! $course->description !!}</p>
                            <div class="items mt-4">
                                <div class="item">
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/Start-Date.png" alt="">
                                        <h3>Start Date</h3>
                                        <p>{{ date('d M Y', strtotime($course->start_date)) }}</p>
                                    </div>
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/End-Date.png" alt="">
                                        <h3>End Date</h3>
                                        <p>{{ date('d M Y', strtotime($course->end_date)) }}</p>
                                    </div>
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/Last-Enrollment.png" alt="">
                                        <h3>Last Enrollment Date</h3>
                                        <p>{{ date('d M Y', strtotime($course->last_enrollment_date)) }}</p>
                                    </div>
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/Batch.png" alt="">
                                        <h3>Duration of Course</h3>
                                        <p>{{ $course->duration }} Year</p>
                                    </div>
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/Batch.png" alt="">
                                        <h3>Batch Size </h3>
                                        <p>{{ $course->batch_size }} Students</p>
                                    </div>
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/Booking.png" alt="">
                                        <h3>Booking Fee</h3>
                                        <p>Rs.{{ $course->category->booking_fees }}</p>
                                    </div>
                                    <div class="courses-card__icons-text">
                                        <img src="/assets/skoodos/assets/img/Duration.png" alt="">
                                        <h3>Total Fee</h3>
                                        <p>
                                            @if ($course->discount > 0)
                                                <span>Rs: {{ $course->total_fees }}</span>
                                            @endif
                                            Rs. {{ $course->netfees() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row institutes-slider" wire:ignore>
                                <div class="col-lg-12">
                                    <div class="text-center mb-4">
                                        {{-- @dump($this->category, $this->stream, $this->exam) --}}
                                           <h5>{{ $course->category ? $course->category->name : '' }} / Management</h5>
                                    </div>
                                    <div class="exam-card-slider exams-card">
                                        @if ($course->exams->count() > 0)
                                            @foreach ($course->exams as $exam)
                                                <div class="card exam-card-item text-center">
                                                    @if (!empty($exam->exam->icon))
                                                        <img src="{{ Storage::disk('public')->url($exam->exam->icon) }}"
                                                            alt="">
                                                    @else
                                                        <img src="assets/img/institute-banners/AIMA-UGT-1.jpg"
                                                            alt="...">
                                                    @endif
                                                    <h6>{{ $exam->exam->name }}</h6>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-btn">
                                <button class="btn-blue" type="button"
                                    wire:click="locationCovered({{ $course->id }},'{{ $course->course_title }}')">Locations
                                    Covered</button>
                                @if ($course->isbookingAllowed())
                                    <button class="btn-yellow" type="button"
                                        wire:click="courseEnrollmentTrigger({{ $course->id }},'{{ $course->course_title }}')">Enroll
                                        Now</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </div>

    <!-- ------------------- End Courses ----------------------->
    <!-- ----------- Modal Splash- -------- -->
    @if ($courseCentersModel)
        <div class="modal fade modal-splash show" id="loctioncovered" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true"
            role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title" id="staticBackdropLabel">
                            <div class="row">
                                <div class="col-3">
                                    <img src="/assets/skoodos/assets/img/modal-logo.png" alt="">
                                </div>
                                <div class="col-9">
                                    <h5>Location Covered</h5>
                                    <p>{{ $coucseNameForModel }}</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="locationCoveredModelClose()"></button>
                    </div>
                    <div class="modal-body">

                        <div class="modal-splash-text">
                            @foreach ($courseCentersOption as $coursecenter)
                                <p><a href="">{{ $coursecenter->center->name() }}</a></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-------------- End Modal splash ----------->

    <!-- ----------- Modal Enroll Splash- -------- -->
    @if ($courseEnrollmentModel)
        <div class="modal fade modal-splash modal-enroll show" id="enrollstaticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="">
                            <h5 class="modal-title" id="staticBackdropLabel"> <img
                                    src="/assets/skoodos/assets/img/modal-logo.png" alt="">COURSE
                                ENROLLMENT
                                CONFIRMATION</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="courseEnrollmentTriggerClose"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3 mb-3">
                            <h3>YOU WISH TO TO ENROLL TO THE FOLLOWING COURSE:</h3>
                            <h4>{{ $courseModel->course_title }} ({{ $courseModel->duration }} month(s))</h4>
                            <h6>{{ $courseModel->institute->name }}
                            </h6>
                            <p>{{ $courseModel->institute->area }},
                                {{ $courseModel->institute->city_name }},
                                {{ $courseModel->institute->state_name }}</p>
                            <p>Booking Fee: <span>Rs {{ $courseModel->category->booking_fees }}</span></p>
                            <p>Booking Date: <span> {{ \Carbon\Carbon::now()->format('d M Y') }}</span></p>
                            @if ($courseModel->discount > 0)
                                <div class="m-stream-icon-bg"
                                    style="background-image: url(/assets/skoodos/assets/img/enroll-discount.png);">
                                    <p><span><b>{{ $courseModel->discount }}</b><sup>%</sup></span> Discount</p>
                                </div>
                            @endif

                            <p>Total Fees :
                                @if ($courseModel->discount > 0)
                                    <span class="strikeout me-3"> Rs. {{ $courseModel->total_fees }} </span>
                                @endif
                                <span>
                                    Rs
                                    {{ $courseModel->netfees() }}</span>
                            </p>
                            <div>
                                @if (
                                    !empty(auth()->guard('students')->user()
                                    ))
                                    @if (auth()->guard('students')->user()->canEnroll())

                                    <select class="form-control" wire:model='preferredLocation' onclick="examsliknow()">
                                        <option value="">--Select Center--</option>
                                        @foreach ($courseCentersOption as $option)
                                            <option value="{{ $option->center_id }}">{{ $option->center->branch_name }}</option>
                                        @endforeach
                                    </select>
                                    @if (!empty($preferredLocation))

                                    <button class="yellow-btn mt-4"
                                        wire:click="initiatePayment()">CONTINUE TO PAYMENT</button>
                                    @endif


                                    @else
                                        <a href="{{ route('student.profile') }}" class="yellow-btn mt-4">Update
                                            Your
                                            Profile First</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif


    <!-- --------------- Modal Filter----------->
    @if ($mobileFilter)
        <div class="modal fade filter_modal  show" id="microsite-filter" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="display: block ">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="/" class="modal-title" id="staticBackdropLabel"><img
                                src="/assets/skoodos/assets/img/back_btn.png" alt=""><span>Filters</span></a>
                        <a wire:click="hideMobileFilter()">Apply</a>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="filter-location">
                                <div class="accordion" id="accordionExample">

                                    <!-- ------ Exam Category  ---- -->

                                    <div class="select-stream">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">Exam Category </h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For Exam Category">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row filters mt-3">
                                                        @foreach ($categoryOptions as $categ)
                                                            <div class="col-6">
                                                                {{-- <a class="active" value="{{ $categ->category_id }}"
                                                                wire:click="category({{ $categ->category_id }})">{{ $categ->category->name }}</a> --}}
                                                                <a @if ($category == $categ->category_id) class="active" @endif
                                                                    value="{{ $categ->category_id }}"
                                                                    wire:click="category({{ $categ->category_id }})">{{ $categ->category->name }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="filter_bar">
                                    <!------ Exam Stream ------>
                                    @if (!empty($streamOptions))
                                        <div class="filter_cat">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        <div class="filter-header">
                                                            <h2 class="m-heading">Exam Stream</h2>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row mt-2">
                                                            <div class="col-xs-12">
                                                                <div class="search">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                    <input type="search" class="form-control"
                                                                        placeholder="Search For Exam Stream">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row filters text-center mt-3">
                                                            @foreach ($streamOptions as $stream)
                                                                <div class="col-6">
                                                                    <a wire:click="stream({{ $stream->stream_id }})"
                                                                        value="{{ $stream->stream_id }}">{{ $stream->stream->name }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">

                                    <!----------============= Exams =================---------- -->
                                    @if (!empty($examOptions))
                                        <div class="select-exam">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSix">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                        aria-expanded="false" aria-controls="collapseSix">
                                                        <div class="filter-header">
                                                            <h2 class="m-heading">Exam</h2>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapseSix" class="accordion-collapse collapse"
                                                    aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row mt-2">
                                                            <div class="col-xs-12">
                                                                <div class="search">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                    <input type="search" class="form-control"
                                                                        placeholder="Search For Exam">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" row filters mt-3">
                                                            @foreach ($examOptions as $exam)
                                                                <div class="col-6">
                                                                    <a value="{{ $exam->exam_id }}"
                                                                        wire:model="exam({{ $exam->exam_id }})">{{ $exam->exam->name }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-------------- End Modal Enroll splash ----------->
    <script>
        $(document).ready(function() {
            $(".exam-card-slider")
                .slick({
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: false,
                    responsive: [{
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 475,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 1,
                            },
                        },
                    ],
                    prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                    nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
                });
        });

        $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
            $('.exam-card-slider').slick('setPosition');
        });
        $('#engineer-btn-more').click(function() {
            $('.exam-card-slider').slick('setPosition');
        })
    </script>


    <script>
        $('#btn-more').click(function(e) {
            e.preventDefault();
            $('.show-more').slideToggle("fast");
            if ($('#managment-course').val() == 1) {
                $('#managment-course').val(0);
                $('#btn-more').text("Collapse");
            } else {
                $('#managment-course').val(1);
                $('#btn-more').text("Show More");
            }
        });
    </script>

    <script>
        $('#engineer-btn-more').click(function(e) {
            e.preventDefault();
            $('.engineer-show-more').slideToggle("fast");
            if ($('#engineering-course').val() == 1) {
                $('#engineering-course').val(0);
                $('#engineer-btn-more').text("Collapse");
            } else {
                $('#engineering-course').val(1);
                $('#engineer-btn-more').text("Show More");
            }
        });
    </script>
    <style>
        .filter_modal .modal-dialog .modal-content .modal-body .accordion-item .accordion-body .filters button {
            border: 1px solid #f2f2f2;
            background-color: #f2f2f2;
            padding: 6px 6px;
            font-size: 12px;
            text-align: center;
            display: block;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .yellow-btn {
            background-color: #d0de29 !important;
            color: var(--primary) !important;
            padding: 6px 58px;
            border-radius: 6px;
            font-size: 16px;
            display: inline-block;
            border: 1px solid var(--yellow);
        }
    </style>
</div>
<!------------====================== End Course Microsite ==============--------------------  -->

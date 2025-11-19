<div>
    <div class="tab-pane fade show active" id="pills-courses" role="tabpanel" aria-labelledby="pills-courses-tab">

        <!------------====================== Course Microsite ==============--------------------  -->

        <div class="stream-managment mt-5 mb-5">
            <div class="container">
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <!-- <h2 class="micro-heading">Our Star Faculty</h2> -->
                        <hr class="divider">
                    </div>
                    <div class="d-flex gap-3">
                        <div class="m-dropdown">
                            <select class="form-select select2" aria-label="Default select example"
                                wire:model="category" onchange="examsliknow();">
                                <option value="">Select Exam Category</option>
                                @foreach ($categoryOptions as $categ)
                                    <option value="{{ $categ->category_id }}">{{ $categ->category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-dropdown">
                            @if (!empty($streamOptions))
                                <select class="form-select select2" aria-label="Default select example"
                                    wire:model="stream" onchange="examsliknow();">
                                    <option value="">Select Exam Stream</option>
                                    @foreach ($streamOptions as $stream)
                                        <option value="{{ $stream->stream_id }}">{{ $stream->stream->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="m-dropdown">
                            @if (!empty($examOptions))
                                <select class="form-select select2" aria-label="Default select example"
                                    wire:model="exam" onchange="examsliknow();">
                                    <option value="">Select Exam</option>
                                    @foreach ($examOptions as $exam)
                                        <option value="{{ $exam->exam_id }}">{{ $exam->exam->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>

                @if (!empty($courses) && $courses->count() > 0)
                    @foreach ($courses as $course)
                        <div class="container-box ">
                            <div class="managment-box">
                                <input type="hidden" id="managment-course" value="1">


                                <div class="couese-sub-heading d-flex justify-content-between">
                                    <h3><i class="bi bi-dot"></i> {{ $course->course_title }}</h3>
                                    <div class="d-flex gap-4">
                                        @if ($course->isbookingAllowed())
                                            <a class="yellow-btn"wire:click="courseEnrollmentTrigger({{ $course->id }},'{{ $course->course_title }}')"
                                                onclick="examsliknow();">Enroll
                                                Now</a>
                                        @endif
                                        <a class="blue-btn" href="" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"
                                            wire:click="locationCovered({{ $course->id }},'{{ $course->course_title }}')"
                                            onclick="examsliknow();">Locations
                                            Covered</a>

                                    </div>
                                </div>
                                <div class="m-course-timing-details">
                                    <p>{!! $course->description !!}</p>
                                    <div class="row ">
                                        <div class="col-lg-3 d-flex mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/date.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Start Date</h4>
                                                <p>{{ date('d M Y', strtotime($course->start_date)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex  mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/date.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>End Date</h4>
                                                <p>{{ date('d M Y', strtotime($course->end_date)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex  mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/enroll.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Last Enrollment Date</h4>
                                                <p>{{ date('d M Y', strtotime($course->last_enrollment_date)) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex  mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/duration.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Duration of Course</h4>
                                                <p>{{ $course->duration }} month(s)</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex  mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/batch.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Batch Size</h4>
                                                <p>{{ $course->batch_size }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex  mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/booking.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Booking Fee</h4>
                                                <p>₹ {{ $course->category->booking_fees }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex  mt-4">
                                            <div class="m-stream-icon">
                                                <img src="assets/img/microsite/caurses/fee.png" alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Total Fee</h4>
                                                <p>
                                                    @if ($course->discount > 0)
                                                        <span class="strikeout"> ₹ {{ $course->total_fees }}</span>
                                                    @endif
                                                    ₹ <?php echo $course->netfees(); ?>
                                                </p>

                                            </div>
                                        </div>
                                        @if ($course->discount > 0)
                                            <div class="col-lg-3  d-flex  mt-4">
                                                <div class="m-stream-icon-bg">
                                                    <p><span><b>{{ $course->discount }}</b><sup>%</sup></span> Discount
                                                    </p>
                                                </div>

                                            </div>
                                        @endif
                                    </div>

                                    <div class="row Exams__heading">
                                        <div class="col-lg-12">
                                            <div class="text-center mb-4">
                                                <h5>{{ \App\Helpers\Helper::getNameById($this->category, $this->stream, $this->exam) }}
                                                </h5>
                                            </div>
                                            <div class="exam-card-slider exams-card">
                                                @if ($course->exams->count() > 0)
                                                    @foreach ($course->exams as $course_exam)
                                                        <div class="card exam-card-item text-center @if ($selectedExam == $course_exam->exam->id) active @endif"
                                                            style="height: auto"
                                                            title="{{ strtoupper($course_exam->exam->fullname) }}">
                                                            @if (!empty($course_exam->exam->icon))
                                                                <img src="{{ Storage::disk('public')->url($course_exam->exam->icon) }}"
                                                                    class="exam-img-1" alt="">
                                                            @else
                                                                <img src="assets/img/homepage/EntranceExam/Exams/AIMA-UGT-1.jpg"
                                                                    class="card-img-top" alt="...">
                                                            @endif
                                                            <h6>{{ $course_exam->exam->name }}</h6>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif

                <!-- ----------- Modal Splash- -------- -->
                @if ($courseCentersModel)

                    <div class="modal fade modal-splash show" id="staticBackdrop" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-modal="true" role="dialog" style="display: block;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title" id="staticBackdropLabel">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="/assets/skoodos/assets/img/modal-logo.png" alt="">
                                            </div>
                                            <div class="col-lg-9">
                                                <h5>Location Covered</h5>
                                                <p>{{ $coucseNameForModel }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close" wire:click="locationCoveredModelClose()"
                                        onclick="examsliknow()"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <div class="row mt-3 mb-3">
                                <div class="col-xs-12">
                                    <div class="search">
                                        <i class="bi bi-geo-alt"></i>
                                        <input type="search" class="form-control"
                                            placeholder="Search For Branch">
                                    </div>
                                </div>
                            </div> --}}
                                    <div class="modal-splash-text">
                                        @foreach ($courseCentersOption as $coursecenter)
                                            <p class="d-flex">{{ $loop->iteration }}.
                                                <a href="#">
                                                    {{ $coursecenter->center->name() }}
                                                </a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-backdrop fade show"></div>
                @endif
                <!-------------- End Modal splash ----------->


                @if ($courseEnrollmentModel)
                    <!-- ----------- Modal Enroll Splash- -------- -->

                    <div class="modal fade modal-enroll show" id="enrollstaticBackdrop" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-modal="true" role="dialog" style="display: block;">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close"
                                        wire:click="courseEnrollmentTriggerClose()" onclick="examsliknow()"></button>
                                    <div class="text-center">
                                        <h5 class="modal-title" id="staticBackdropLabel"> <img
                                                src="assets/img/modal-logo.png" alt="">COURSE ENROLLMENT
                                            CONFIRMATION</h5>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row mt-3 mb-3">
                                        <h3>YOU WISH TO TO ENROLL TO THE FOLLOWING COURSE:</h3>
                                        <h4>{{ $courseModel->course_title }} ({{ $courseModel->duration }}
                                            month(s))</h4>
                                        <h6>{{ $courseModel->institute->name }}</h6>
                                        <p>{{ $courseModel->institute->area }},
                                            {{ $courseModel->institute->city_name }},
                                            {{ $courseModel->institute->state_name }}</p>
                                        <p>Booking Fee: <span>₹ {{ $courseModel->category->booking_fees }}</span></p>
                                        <p>Booking Date: <span> {{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                                        </p>
                                        @if ($courseModel->discount > 0)
                                            <div class="m-stream-icon-bg">
                                                <p><span><b>{{ $courseModel->discount }}</b><sup>%</sup></span>
                                                    Discount</p>
                                            </div>
                                        @endif
                                        <p>Total Fees :
                                            @if ($courseModel->discount > 0)
                                                <span class="strikeout me-3"> ₹
                                                    {{ $courseModel->total_fees }}
                                                </span>
                                            @endif

                                            <span> ₹
                                                {{ $courseModel->netfees() }}</span>
                                        </p>
                                        <div>
                                            @if (
                                                !empty(auth()->guard('students')->user()
                                                ))
                                                @if (auth()->guard('students')->user()->canEnroll())
                                                    <select class="form-control" wire:model='preferredLocation'
                                                        onclick="examsliknow()">
                                                        <option value="">--Select Center--</option>
                                                        @foreach ($courseCentersOption as $option)
                                                            <option value="{{ $option->center_id }}">
                                                                {{ $option->center->branch_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if (!empty($preferredLocation))
                                                        <button class="yellow-btn mt-4"
                                                            wire:click="initiatePayment()">CONTINUE TO PAYMENT</button>
                                                    @endif
                                                @else
                                                    <a href="{{ route('student.profile') }}"
                                                        class="yellow-btn mt-4">Update Your Profile First</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    <!-------------- End Modal Enroll splash ----------->
                @endif


                @if (!empty($courses) && $courses->count() > 10)
                    <div class="text-center mt-5">
                        <a wire:click="showMore({{ $selectedExam }})" id="faculty-btn-more">Show More</a>
                    </div>
                @endif
            </div>
        </div>
    </div>



</div>

<div>

    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-faculty" role="tabpanel" aria-labelledby="pills-faculty-tab">

            <!------------====================== Faculty Microsite ==============--------------------  -->

            <div class="m-faculty mt-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="micro-heading">Our Star Faculty</h2>
                        <hr class="divider">
                    </div>
                    <div class="d-flex gap-3">
                        <div class="m-dropdown">
                            <select class="form-select select2" aria-label="Default select example"
                                wire:model="category">
                                <option value="">Select Exam Category</option>
                                @foreach ($categoryOptions as $categ)
                                    <option value="{{ $categ->category_id }}">{{ $categ->category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-dropdown">
                            {{-- @dd($streamOptions); --}}
                            @if (!empty($streamOptions))
                                <select class="form-select select2" aria-label="Default select example"
                                    wire:model="stream">
                                    <option value="">Select Exam Stream</option>
                                    @foreach ($streamOptions as $stream)
                                        <option value="{{ $stream->stream_id }}">{{ $stream->stream->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="m-dropdown">
                            @if (!empty($examOptions))
                                <select class="form-select select2" aria-label="Default select example"
                                    wire:model="exam">
                                    <option value="">Select Exam</option>
                                    @foreach ($examOptions as $exam)
                                        <option value="{{ $exam->exam_id }}">{{ $exam->exam->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container-box mt-4">
                    <div class="row">
                        @if (!empty($faculties) && $faculties->count() > 0)
                            <input type="hidden" id="faculty-card" value="1">
                            @foreach ($faculties as $fac)
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ !empty($fac->faculty_image) ? Storage::disk('public')->url($fac->faculty_image) : '../assets/skoodos/assets/img/defaultImages/Faculty-Profile.jpg' }}"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3>{{ $fac->faculty_name }}</h3>
                                                    <h4>{{ ucfirst($fac->subject->subject) }}</h4>
                                                    <p>{{ $fac->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if (!empty($faculties) && $faculties->count() > 10)
                            <div class="text-center mt-5">
                                <a wire:click="showMore({{ $selectedExam }})" id="faculty-btn-more">Show More</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- ------------------------ Faculty ------------------ -->

        <div class="tab-pane fade show active" id="pills-faculty" role="tabpanel" aria-labelledby="pills-faculty-tab">

            <section class="faculty-section">
                <div class="container">
                    <div class="microstite-container">
                        <div class="section--heading sub-heading d-flex justify-content-between">
                            <h2>Our Star Faculty</h2>
                        </div>
                        @if (!empty($faculties) && $faculties->count() > 0)
                            @foreach ($faculties as $fac)
                                <div class="faculty-card">
                                    <div class="faculty-card__img">
                                        <img src="{{ !empty($fac->faculty_image) ? Storage::disk('public')->url($fac->faculty_image) : '../assets/skoodos/assets/img/defaultImages/Faculty-Profile.jpg' }}"
                                            alt="">
                                    </div>
                                    <div class="faculty-card__text">
                                        <h3>{{ $fac->faculty_name }}</h3>
                                        <h4>{{ ucfirst($fac->subject->subject) }}</h4>
                                        <h5>MANAGEMENT / ENGINEERING</h5>
                                        <p>{{ $fac->description }}.</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        </div>

        <!-- ------------------------ End Faculty ------------------ -->
    @endif
</div>

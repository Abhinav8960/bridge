<div>
    <main>

        <!-- ------- Sub Header ----- -->

        <header class="sub-header">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('explore.explorepage') }}"><i class="bi bi-arrow-left"></i>Search Results</a>
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('compare.institute') }}"><img src="/assets/skoodos/assets/img/board.png"
                                    alt=""></a>
                            <a href="" wire:click="showMobileFilter()" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"><img
                                    src="/assets/skoodos/assets/img/explore-listing/Filter.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ------- Sub Header ----- -->


        <section class="listing">
            <div class="container">
                <h2>Top Coaching Institutes for Entrance Exams in India</h2>

                    @foreach ($centers as $center)
                        <div class="featured-institute__container">
                            @if ($center->institute->is_recommended)
                                <img src="/assets/skoodos/assets/img/explore-listing/recommended.png"
                                    class="recommended" alt="">
                            @endif
                            <ul class="rating _text-end">
                                {!! \App\Helpers\Helper::printStar(
                                    $center->institute->netrating(),
                                    $center->institute->package->is_showing_review,
                                ) !!}
                            </ul>
                            <div class="featured-institute__card">
                                <div class="featured-institute__img position-relative">
                                    <img src="{{ !empty($center->institute->upload->logo) ? Storage::disk('public')->url($center->institute->upload->logo) : '/assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                        alt="">
                                    @if (empty($center->institute->upload->logo))
                                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                                            <h2
                                                style="font-size: 20px; font-weight:bold;position:relative; margin-top:-52px;">
                                                @php
                                                    $str = $center->institute->name;
                                                    echo implode(
                                                        '',
                                                        array_map(function ($v) {
                                                            return isset($v[0]) ? $v[0] : '';
                                                        }, explode(' ', $str)),
                                                    );
                                                @endphp
                                            </h2>
                                        </div>
                                    @endif
                                    <div class="form-check compare-check">
                                        <input class="form-check-input" type="checkbox"
                                            value="{{ $center->institute_id }}"
                                            id="compare-check_{{ $center->institute_id }}"
                                            wire:click="instituteCompare({{ $center->institute_id }})"
                                            @if (Session::has('compare.institute.' . $center->institute_id)) checked disabled @endif>
                                        <label class="form-check-label" for="compare-check1">
                                            Compare
                                        </label>
                                        {{-- <input class="form-check-input" type="checkbox" value=""
                                                id="compare-check1" checked="">
                                            <label class="form-check-label" for="compare-check1">
                                                Compare
                                            </label> --}}
                                    </div>
                                </div>
                                <div class="featured-institute__text">
                                    <a href="{{ route('institute.microsite', ['slug' => $center->institute->slug]) }}">
                                        <h3>{{ $center->institute->name }}</h3>
                                    </a>
                                    <ul>
                                        <li><span><i class="bi bi-geo-alt-fill"></i></span>{{ $center->area }},
                                            {{ $center->city_name }},
                                            {{ $center->state_name }}
                                        </li>
                                        <li><span><i class="bi bi-telephone-fill"></i></span>+91
                                            {{ $center->phone_number_1 }}

                                        </li>
                                        <li><span><i class="bi bi-envelope-fill"></i></span>{{ $center->email_1 }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @if (!empty($center->institute->feature))
                                <div class="institute-content__container">
                                    @foreach ($center->institute->feature as $feature)
                                        <div class="col-4 institute-content">
                                            <div class="institute-content__img">
                                                <img src="{{ Storage::disk('public')->url($feature->info->icon) }}"
                                                    alt="">
                                            </div>
                                            <div class="institute-content__text">
                                                <h4>{{ $feature->info->name }}</h4>
                                                <p>
                                                    @if ($feature->value == 1)
                                                        Yes
                                                    @elseif ($feature->value == 0)
                                                        No
                                                    @else
                                                        {{ $feature->value }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="institute-card-btn">
                                @if ($center->institute->package->is_course_enrollment)
                                    <a href="" class="btn btn-yellow">Enroll Now</a>
                                @endif
                                <a href="{{ route('institute.microsite', ['slug' => $center->institute->slug]) }}"
                                    class="btn btn-white">View Details</a>
                            </div>
                        </div>
                    @endforeach
                    <div>
                {{ $centers->links() }}

                        <br><br><br>

                    </div>
            </div>
        </section>

    </main>
    <!-- --------------- Modal Filter----------->

    @if ($mobileFilter)
        <div class="modal fade filter_modal  show" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            style="display: block ">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="{{ route('explore.india') }}" class="modal-title" id="staticBackdropLabel"><img
                                src="/assets/skoodos/assets/img/back_btn.png" alt=""><span>All
                                Filters</span></a>
                        <a wire:click="hideMobileFilter()">Apply</a>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="filter-location">
                                <div class="accordion" id="accordionExample">
                                    @if (!empty($filterStateOptions))
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingstate">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsestate"
                                                    aria-expanded="true" aria-controls="collapsestate">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">state</h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapsestate" class="accordion-collapse collapse show"
                                                aria-labelledby="headingstate" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For State">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 cities_name filters">
                                                        @foreach ($filterStateOptions as $filterStateOption)
                                                            <div class="col-6">
                                                                <a @if ($filterState == $filterStateOption->state_id) class="active" @endif
                                                                    value="{{ $filterStateOption->state_id }}"
                                                                    wire:click="filterState({{ $filterStateOption->state_id }})">{{ $filterStateOption->state_name }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <hr class="filter_bar">
                                    @if (count($filterCityOptions) > 0)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingcity">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsecity"
                                                    aria-expanded="true" aria-controls="collapsecity">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">City</h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapsecity"
                                                class="accordion-collapse collapse  @if ($filterCity > 0) show @endif"
                                                aria-labelledby="headingcity" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For City">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 cities_name filters">
                                                        @foreach ($filterCityOptions as $filterCityOption)
                                                            <div class="col-6">
                                                                <a class="active"
                                                                    value="{{ $filterCityOption->city_id }}"
                                                                    wire:click="filterCity({{ $filterCityOption->city_id }})">
                                                                    {{ $filterCityOption->city_name }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">

                                    <!-- ---------- Area Filter -- -->
                                    @if (count($filterAreaOptions) > 0)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingArea">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseArea"
                                                    aria-expanded="true" aria-controls="collapseArea">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">Area</h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseArea"
                                                class="accordion-collapse collapse  @if ($filterArea > 0) show @endif"
                                                aria-labelledby="headingArea" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For Area">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 cities_name filters">
                                                        @foreach ($filterAreaOptions as $filterAreaOption)
                                                            <div class="col-6">
                                                                <a class="active"
                                                                    value="{{ $filterAreaOption->area_id }}"
                                                                    wire:click="filterArea({{ $filterAreaOption->area_id }})">{{ $filterAreaOption->area }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">

                                    <!-- ------ Select Stream ---- -->
                                    @if (count($filterExamCategoryOptions) > 0)
                                        <div class="select-stream">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        <div class="filter-header">
                                                            <h2 class="m-heading">Select Stream</h2>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo"
                                                    class="accordion-collapse collapse @if ($filterExamCategory > 0) show @endif"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row filters mt-3">
                                                            @foreach ($filterExamCategoryOptions as $filterExamCategoryOption)
                                                                <div class="col-6">
                                                                    <a @if ($filterExamCategory == $filterExamCategoryOption->id) class="active" @endif
                                                                        value="{{ $filterExamCategoryOption->id }}"
                                                                        wire:click="filterExamCategory({{ $filterExamCategoryOption->id }})">{{ $filterExamCategoryOption->name }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">

                                    <!------ Select Sub Stream ------>
                                    @if (count($filterExamStreamOptions) > 0)
                                        <div class="filter_cat">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        <div class="filter-header">
                                                            <h2 class="m-heading">Select Sub Stream</h2>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapseFive"
                                                    class="accordion-collapse collapse  @if ($filterExamStream > 0) show @endif"
                                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row mt-2">
                                                            <div class="col-xs-12">
                                                                <div class="search">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                    <input type="search" class="form-control"
                                                                        placeholder="Search For Sub Stream">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row filters text-center mt-3">
                                                            @foreach ($filterExamStreamOptions as $options)
                                                                <div class="col-6">
                                                                    <a value="{{ $options->id }}"
                                                                        wire:click="filterExamStream({{ $options->id }})"
                                                                        @if ($filterExamStream == $options->id) class="active" @endif>{{ $options->name }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">

                                    <!----------============== Select Exams =================---------- -->
                                    @if (count($filterExamOptions) > 0)
                                        <div class="select-exam">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSix">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                        aria-expanded="false" aria-controls="collapseSix">
                                                        <div class="filter-header">
                                                            <h2 class="m-heading">Select Exam</h2>
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
                                                            @foreach ($filterExamOptions as $options)
                                                                <div class="col-6">
                                                                    <a @if ($filterExam == $options->id) class="active" @endif
                                                                        value="{{ $options->id }}" i
                                                                        wire:click="filterExam({{ $options->id }})">{{ $options->name }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="filter_bar">

                                    <!----------============== Features =================---------- -->
                                    @if (!empty($filterFeaturesOptions))
                                        <div class="features">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeven">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                        aria-expanded="false" aria-controls="collapseSeven">
                                                        <div class="filter-header">
                                                            <h2 class="m-heading">Features
                                                                {{-- <a href="">Select
                                                                    All</a> --}}
                                                            </h2>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapseSeven" class="accordion-collapse collapse"
                                                    aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row filters mt-2">
                                                            @foreach ($filterFeaturesOptions as $option)
                                                                <div class="col-6">
                                                                    <a @if ($filterFeatures == $option->id) class="active" @endif
                                                                        value="{{ $option->id }}"
                                                                        id="filterFeatures"
                                                                        wire:click="filterFeatures({{ $option->id }})">{{ $option->name }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <style>
        .listing .featured-institute__container .featured-institute__card .compare-check .form-check-input:checked[type=checkbox] {
            background-image: url(/assets/skoodos/assets/img/tick.png) !important;
            border-radius: 0;
            border: 1px solid #a0a0a0;
        }
    </style>
</div>

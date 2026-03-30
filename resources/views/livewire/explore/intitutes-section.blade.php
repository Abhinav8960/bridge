<div>
    @if ($desktopResult)
        <main id="main">
            <section class="coaching-institutes">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if (Route::is('explore.india'))
                                <h1>Coaching Institutes In India</h1>
                            @else
                                <h1>{{ ucwords(str_replace('-', ' ', request()->rseoslug)) }}</h1>
                            @endif
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="/assets/skoodos/assets/img/homepage/EntranceExam/institutes.png" alt=""
                                class="institute-logo">
                            <h3 class="institute-text">Institutes : <span class="i-number">{{ $centers->total() }}</span>
                            </h3>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-3">
                            <!---------============= Select Institutes Filter =====------------  -->
                            @if ($filterRecommendedOptions)
                                <div class="filter_exams">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">Institutes</h2>
                                    </div>
                                    <div class="checkbox instittute-checkbox">
                                        @foreach ($filterRecommendedOptions as $key => $option)
                                            <div class="form-check">
                                                <input class="form-check-input cbinstitute" type="radio"
                                                    value="{{ $key }}" wire:model="filterRecommended">
                                                <label class="form-check-label" for="cbsinstitute1">
                                                    {{ $option }}</label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif

                            <!---------============= state filter =====------------  -->
                            @if (!empty($filterStateOptions))
                                <div class="filter_exams mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">State</h2>
                                    </div>
                                    <input id="filterStateSearch" type="search" class="form-control"
                                        placeholder="Search" type="text" style="margin-bottom: 5px;"
                                        wire:model="filterStateSearch">
                                    <div class="checkbox">
                                        @foreach ($filterStateOptions as $filterStateOption)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-state" type="radio"
                                                    value="{{ $filterStateOption->state_id }}" wire:model="filterState">
                                                <label class="form-check-label" for="filterState">
                                                    {{ $filterStateOption->state_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!---------============= City filter =====------------  -->
                            @if (count($filterCityOptions) > 0)
                                <div class="filter_exams mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">City</h2>
                                    </div>
                                    <input id="filterCitySearch" type="search" class="form-control"
                                        placeholder="Search" type="text" style="margin-bottom: 5px;"
                                        wire:model="filterCitySearch">
                                    <div class="checkbox">
                                        @foreach ($filterCityOptions as $filterCityOption)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-city" type="radio"
                                                    value="{{ $filterCityOption->city_id }}" wire:model="filterCity">
                                                <label class="form-check-label" for="filterCity">
                                                    {{ $filterCityOption->city_name }}
                                                </label>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            @endif

                            <!---------============= Area filter =====------------  -->
                            @if (count($filterAreaOptions) > 0)
                                <div class="filter_exams mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">Area</h2>
                                    </div>
                                    <input id="filterAreaSearch" type="search" class="form-control"
                                        placeholder="Search" type="text" style="margin-bottom: 5px;"
                                        wire:model="filterAreaSearch">
                                    <div class="checkbox">
                                        @foreach ($filterAreaOptions as $filterAreaOption)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-city" type="radio"
                                                    value="{{ $filterAreaOption->area_id }}" wire:model="filterArea">
                                                <label class="form-check-label" for="filterArea">
                                                    {{ $filterAreaOption->area }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!---------============= Select Exams Stream Filter =====------------  -->
                            @if (count($filterExamCategoryOptions) > 0)
                                <div class="filter_stream mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">Exam Category
                                        </h2>
                                    </div>
                                    <div class="checkbox">
                                        @foreach ($filterExamCategoryOptions as $filterExamCategoryOption)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-stream" type="radio"
                                                    value="{{ $filterExamCategoryOption->id }}"
                                                    @if ($filterExamCategory == $filterExamCategoryOption->id) checked @endif
                                                    wire:model="filterExamCategory">
                                                <label class="form-check-label" for="filterExamCategory">
                                                    {{ $filterExamCategoryOption->name }}</label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif

                            <!---------============= Select Sub Exams Filter =====------------  -->
                            @if (count($filterExamStreamOptions) > 0)
                                <div class="filter_exams mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">Stream
                                        </h2>
                                    </div>
                                    <input id="filterExamStreamSearch" type="search" class="form-control"
                                        placeholder="Search" type="text" style="margin-bottom: 5px;"
                                        wire:model="filterExamStreamSearch">
                                    <div class="checkbox">
                                        @foreach ($filterExamStreamOptions as $options)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-sub-stream" type="radio"
                                                    value="{{ $options->id }}" wire:model="filterExamStream">
                                                <label class="form-check-label" for="filterExamStream">
                                                    {{ $options->name }}</label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif

                            @if (count($filterExamOptions) > 0)
                                <!---------============= Select Exams Filter =====------------  -->
                                <div class="filter_exams mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">Exam
                                        </h2>
                                    </div>
                                    <input id="filterExamSearch" type="search" class="form-control"
                                        placeholder="Search" type="text" style="margin-bottom: 5px;"
                                        wire:model="filterExamSearch">
                                    <div class="checkbox">
                                        @foreach ($filterExamOptions as $options)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-exam" type="radio"
                                                    value="{{ $options->id }}" i wire:model="filterExam">
                                                <label class="form-check-label" for="filterExam">
                                                    {{ $options->name }} </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!---------=============Features filter =====------------  -->
                            @endif

                            @if (!empty($filterFeaturesOptions))
                                <div class="filter_exams mt-3">
                                    <div class="filter-title d-flex justify-content-between align-items-center">
                                        <h2 class="filter-title-head">Features</h2>
                                    </div>
                                    <div class="checkbox">
                                        @foreach ($filterFeaturesOptions as $option)
                                            <div class="form-check">
                                                <input class="form-check-input select-cb-features" type="radio"
                                                    value="{{ $option->id }}" id="filterFeatures"
                                                    wire:model="filterFeatures">
                                                <label class="form-check-label" for="filterFeatures">
                                                    {{ $option->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif


                        </div>

                        <!-- ----------------------------- Select Exams ------------ -->
                        <div class="col-lg-9">
                            @if ($centers->count() > 0)

                                @foreach ($centers as $center)
                                    <div class="listing-border-box pt-5 mb-5">
                                        <div class="row explore-institute-top px-4">
                                            <div class="col-lg-9 d-flex position-relative">
                                                @if ($center->institute->is_recommended)
                                                    <img src="/assets/skoodos/assets/img/explore-listing/recommended.png"
                                                        alt="recommend" class="recommend">
                                                @endif
                                                <div class="explore-institute-image" style="padding-right: 15px;">
                                                    <img src="{{ !empty($center->institute->upload->logo) ? Storage::disk('public')->url($center->institute->upload->logo) : '/assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                                        alt="logo" style="height:118px; width:100%;">

                                                    @if (empty($center->institute->upload->logo))
                                                        <div>
                                                            <h2
                                                                style="font-size: 20px; font-weight:bold;margin-top:-70px; text-align:center;">
                                                                {{ $center->institute->nickname() }} </h2>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="explore-institute-detail ps-2">
                                                    <a
                                                        href="{{ route('institute.microsite', ['slug' => $center->institute->slug]) }}">
                                                        <h2 class="institute-name mb-2">{{ $center->institute->name }}
                                                        </h2>
                                                    </a>
                                                    <ul>
                                                        <li><span><i
                                                                    class="bi bi-geo-alt-fill"></i></span>{{ $center->area }},
                                                            {{ $center->city_name }},
                                                            {{ $center->state_name }}
                                                        </li>
                                                        <li><span><i class="bi bi-telephone-fill"></i></span>+91
                                                            {{ $center->phone_number_1 }}
                                                            @if (!empty($center->phone_number_2))
                                                                <img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                                    alt=""> +91 {{ $center->phone_number_2 }}
                                                            @endif
                                                        </li>
                                                        <li><span>
                                                                @if (!empty($center->institute->general->website))
                                                                    <i class="bi bi-window-desktop"></i>
                                                            </span>&nbsp;{{ $center->institute->general->website }}
                                                            &nbsp;
                                                            <i
                                                                class="bi bi-envelope-fill"></i></span>&nbsp;{{ $center->email_1 }}
                                @endif

                                </li>
                                </ul>

                        </div>
                    </div>

                    <div class="col-lg-3 text-center">
                        <ul class="d-flex rating align-items-center justify-content-center">
                            {!! \App\Helpers\Helper::printStar(
                                $center->institute->netrating(),
                                $center->institute->package->is_showing_review,
                            ) !!}
                        </ul>


                        {{-- <div class="form-check compare-check">
                            <input class="form-check-input" type="checkbox" value="{{ $center->institute_id }}"
                                id="compare-check_{{ $center->institute_id }}"
                                wire:click="instituteCompare({{ $center->institute_id }})"
                                @if (Session::has('compare.institute.' . $center->institute_id)) checked disabled @endif>
                            <label class="form-check-label" for="compare-check1">
                                Add To Compare
                            </label>
                        </div> --}}

                        <div class="form-check compare-check">
                            <input class="form-check-input" type="checkbox" value="{{ $center->institute_id }}"
                                id="compare-check_{{ $center->institute_id }}"
                                wire:click="instituteCompare({{ $center->institute_id }})"
                                @if (Session::has('compare.institute.' . $center->institute_id)) checked @endif
                                @if (count(Session::get('compare.institute', [])) >= 3) disabled @endif>
                            <label class="form-check-label" for="compare-check_{{ $center->institute_id }}">
                                Add To Compare
                            </label>
                        </div>



                        <a class="view-btn mt-2"
                            href="{{ route('institute.microsite', ['slug' => $center->institute->slug]) }}">View
                            Details</a>

                        {{-- @if ($center->institute->package->is_course_enrollment)
                            <a class="yellow-btn mt-2"
                                href="{{ route('institute.microsite', ['slug' => $center->institute->slug, 'coursesTab' => true]) }}">Enroll
                                Now</a>
                        @endif --}}
                    </div>
                    <div class="pt-4 institute-text">
                        <p>{!! \App\Helpers\Helper::wordslice(40, $center->institute->general->description ?? '', $center->institute->slug) !!}</p>
                    </div>
                    @if (!empty($center->institute->feature))
                        <div class="row pt-2">
                            @foreach ($center->institute->feature as $feature)
                                <div class="col-4 col-xl-3">
                                    <div class="institute-featured-box d-flex mt-3">
                                        <div class="box-image">
                                            <img src="{{ Storage::disk('public')->url($feature->info->icon) }}"
                                                alt="Features Icon">
                                        </div>
                                        <div class="institute-details">
                                            <h3>{{ $feature->info->name }}</h3>

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
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
                @if ($center->institute->champions->count() > 0)
                    <div class="listing-institute-bg mt-4 d-flex text-center align-items-center py-3">
                        <div class="heading-champ text-center">
                            <img src="/assets/skoodos/assets/img/explore-listing/Shape68.png" alt=""
                                class="champ">
                        </div>

                        @foreach (\App\Helpers\Helper::championswithconfiguration($center->institute_id, $category, $stream, $exam) as $champions)
                            <div class="student-card">

                                <img src="{{ !empty($champions->candidate_image) ? Storage::disk('public')->url($champions->candidate_image) : '/assets/skoodos/assets/img/defaultImages/Champion-Profile.jpg' }}"
                                    alt="">
                                <h4>{{ $champions->candidate_name }}</h4>
                                <p>Rank: {{ $champions->rank }} ({{ $champions->exam->name }}) |
                                    {{ $champions->year }}</p>
                            </div>
                        @endforeach

                    </div>
                @endif

</div>
@endforeach
@else
<div class="text-center">
    <img src="/assets/skoodos/assets/img/defaultImages/No Results/No-Institutes.jpg">
    <h3>No Institutes Found</h3>
</div>
@endif
{{ $centers->links() }}

<div>
    <!-- Pagination links -->
</div>

</div>
</div>
</div>
</section>

<!-- ---------- Compare ---------- -->

<div class="institute-compare-container">
    <div class="dropup">
        <a href="" class="blue-btn compare-btn"> Your Selection <i class="bi bi-chevron-right"></i></a>

        @if ($institute = Session::get('compare.institute'))
            {{-- @dd($institute); --}}
            @if (count($institute) > 0)

                <div class="institute-deatils-contain">
                    <div class="compare-items">

                        @foreach ($institute as $key => $institutes)
                            {{-- @php $instituteList = \App\Helpers\Helper::getInstitute($institutes); @endphp --}}

                            <div class="compare-item">
                                <div class="compare-item-img">
                                    @if (!empty($institutes->upload->logo))
                                        <img src="{{ Storage::disk('public')->url($institutes->upload->logo) }}"
                                            alt="logo">
                                    @else
                                        <img src="/assets/skoodos/assets/img/homepage/FeaturedInstitute/vidya.png"
                                            alt="">
                                    @endif
                                    <a href="" wire:click.prevent="deleteSearch1({{ $key }})"><i
                                            class="bi bi-x-lg"></i></a>
                                </div>
                                <p>{{ $institutes->name }}</p>
                                <p> {{ $institutes->area }}, {{ $institutes->city_name }},
                                    {{ $institutes->state_name }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('compare.institute') }}" class="hover_a">Click Here To Compare</a>
                    </div>
                </div>
            @endif
        @endif
    </div>

</div>
</main><!-- End #main -->
@elseif ($mobileResult)
<main>

    <!-- ------- Sub Header ----- -->

    <header class="sub-header">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <a href="index.html"><i class="bi bi-arrow-left"></i>Search Results</a>
                    <div class="d-flex align-items-center gap-3">
                        <a href="compare.html"><img src="/assets/skoodos/assets/img/board.png" alt=""></a>
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
            @if ($centers->count() > 0)
                @foreach ($centers as $center)
                    <div class="featured-institute__container">
                        @if ($center->institute->is_recommended)
                            <img src="/assets/skoodos/assets/img/explore-listing/recommended.png" class="recommended"
                                alt="">
                        @endif
                        <ul class="rating _text-end">
                            {!! \App\Helpers\Helper::printStar(
                                $center->institute->netrating(),
                                $center->institute->package->is_showing_review,
                            ) !!}
                        </ul>
                        <div class="featured-institute__card">
                            <div class="featured-institute__img">
                                <img src="{{ !empty($center->institute->upload->logo) ? Storage::disk('public')->url($center->institute->upload->logo) : '/assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                    alt="">
                                @if (empty($center->institute->upload->logo))
                                    <div style="position:relative; text-align:center;">
                                        <h2
                                            style="font-size: 20px; font-weight:bold;position:relative; margin-top:-52px;">
                                            @php
                                                $str = $center->institute->name;
                                                echo implode(
                                                    '',
                                                    array_map(function ($v) {
                                                        return $v[0];
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
                            {{-- @if ($center->institute->package->is_course_enrollment)
                                <a href="" class="btn btn-yellow">Enroll Now</a>
                            @endif --}}
                            <a href="{{ route('institute.microsite', ['slug' => $center->institute->slug]) }}"
                                class="btn btn-white">View Details</a>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </section>

</main>
<!-- --------------- Modal Filter----------->
@if ($mobileFilter)

    <div class="modal fade filter_modal show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: block ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="listing.html" class="modal-title" id="staticBackdropLabel"><img
                            src="/assets/skoodos/assets/img/back_btn.png" alt=""><span>All Filters</span></a>
                    <a href="">Apply</a>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="filter-location">
                            <div class="accordion" id="accordionExample">
                                @if (!empty($filterStateOptions))
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingstate">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapsestate" aria-expanded="true"
                                                aria-controls="collapsestate">
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
                                                            <button class="active" type="button"
                                                                value="{{ $filterStateOption->state_id }}"
                                                                wire:click="filterState({{ $filterStateOption->state_id }})">{{ $filterStateOption->state_name }}</button>
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
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapsecity" aria-expanded="true"
                                                aria-controls="collapsecity">
                                                <div class="filter-header">
                                                    <h2 class="m-heading">City</h2>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapsecity" class="accordion-collapse collapse"
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
                                                            <button class="active"
                                                                value="{{ $filterCityOption->city_id }}"
                                                                wire:model="filterCity">
                                                                {{ $filterCityOption->city_name }}</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <hr class="filter_bar">

                                <!-- ---------- Area Filter -- -->

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingArea">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseArea" aria-expanded="true"
                                            aria-controls="collapseArea">
                                            <div class="filter-header">
                                                <h2 class="m-heading">Area</h2>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseArea" class="accordion-collapse collapse"
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
                                                <div class="col-6">
                                                    <a class="active" href="javascript:void(0) ">Fateh Nagar</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="javascript:void(0)">Ashok Nagar</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="javascript:void(0)">Vishnu Gardan</a>
                                                </div>

                                                <div class="col-6">
                                                    <a href="javascript:void(0)">Vikash Puri</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="javascript:void(0)">Uttam Nagar</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="javascript:void(0)">Tilak Nagar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="filter_bar">

                                <!-- ------ Select Stream ---- -->

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
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row filters mt-3">
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Entrance
                                                            Exam</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Government Exam</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Foregin Exam</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="filter_bar">

                                <!------ Select Sub Stream ------>

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
                                        <div id="collapseFive" class="accordion-collapse collapse"
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
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Management</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Engeneering</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Law</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Pharmacy</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Commerce</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Science</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Computer</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Agriculture</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="filter_bar">

                                <!----------============== Select Exams =================---------- -->

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
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">APIIT NAT</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">ATMA</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">BMAT</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">BUMAT</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">CAT EXAM</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">CMAT</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="filter_bar">

                                <!----------============== Features =================---------- -->

                                <div class="features">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeven">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                aria-expanded="false" aria-controls="collapseSeven">
                                                <div class="filter-header">
                                                    <h2 class="m-heading">Features <a href="">Select
                                                            All</a>
                                                    </h2>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse"
                                            aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row filters mt-2">
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Batch
                                                            Training</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Personalized
                                                            Training</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Virtual
                                                            Classroom</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Doubt
                                                            Sessions</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a class="active" href="javascript:void(0)">Online Test
                                                            Series</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Choice Of Faculty</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Resource Library</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)">Admission Counselling</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<style>
    .filter_modal .modal-dialog .modal-content .modal-body .accordion-item .accordion-body .filters button.active {
        background-color: #004D85;
        color: #FFFFFF;
    }
</style>
@endif
</div>
<style>
    div.text-center a.hover_a:hover {
        color: #d0de29 !important;
    }
</style>

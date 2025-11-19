@extends('layouts.master')
@section('title')
Best Institute for Foreign Language Proficiency Exams | Skoodos Bridge

@endsection
@section('metadescription')
Discover the most popular Foreign Language and English proficiency tests coachings like IELTS, TOEFL, TOEIC, CELPIP, KET, PET, FCE, CAE and more on Skoodos Bridge.

@endsection
@section('keyword')
foreign language exams, IELTS GENERAL Exam, IELTS ACADEMIC Exam, TOEFL Exam, PTE Exam, CELA Exam, CELPIP Exam, CET Exam, CRE Exam, DET Exam, ECCE Exam, ECPE Exam, EFSET Exam, EIKEN Exam, EPT Exam, ESOL Exam, GEPT Exam, LPAT Exam, MELAB Exam, MET Exam, MTELP Exam, MUET Exam, PETS Exam, TEPS Exam, TOEIC Exam

@endsection
@section('content')
    <section class="top-banner">
        <div class="container">
            <img src="/assets/skoodos/assets/img/ForeignExamBanner.png" alt="" class="img-fluid">
        </div>
    </section>


    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Exams</a></li>
                    <li class="breadcrumb-item active">Foreign Language Exams</li>
                </ol>
            </nav>
        </div>
    </div>


    <main id="main">

        <!-- ======= foreign Exam Section ======= -->

        @livewire('exams.foreign')
        <!-- ======= End Entrance Exam Section ======= -->

        {{-- Featured Institutes --}}
        <section class="featured-institutes mt-5 pb-5">
            @if (!empty($institutes) && $institutes->count() > 0)
                <div class="container">
                    <div class="d-flex">
                        <h2>Featured Institutes
                            <hr class="divider">
                        </h2>
                    </div>


                    <div class="row pt-4 mt-4">
                        @foreach ($institutes as $institute)
                            <div class="col-lg-4 mb-4">
                                <div class="card">
                                    @if ($institute->is_recommended)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img src="/assets/skoodos/assets/img/categories/recommended.png"
                                                    alt="">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex p-4 finstitute-line">
                                        <div class="finstitute-img">
                                            <img src="{{ !empty($institute->upload->logo) ? Storage::disk('public')->url($institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                                alt="Logo">
                                            @if (empty($institute->upload->logo))
                                                <div style="position:relative; text-align:center;">
                                                    <h2
                                                        style="font-size: 20px; font-weight:bold;position:relative; margin-top:-52px;">
                                                        @php
                                                            $str = $institute->name;
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
                                        </div>
                                        <div class="finstitute-detail ps-3">
                                            <a href="">
                                                <h4 class="institute-name mb-1">{{ $institute->name }}</h4>
                                            </a>
                                            <ul>
                                                <li><span><i class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                                    {{ $institute->city_name }},
                                                    {{ $institute->state_name }}
                                                </li>
                                                <li><span><i
                                                            class="bi bi-telephone-fill"></i></span>+91-{{ $institute->mobile }}
                                                </li>
                                                <li><span><i class="bi bi-envelope-fill"></i></span>{{ $institute->email }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if (!empty($institute->general))
                                            <p class="card-text finstitute-line p-4">
                                                {!! strlen($institute->general->description) > 250
                                                    ? strip_tags(substr($institute->general->description, 0, 250)) . '...'
                                                    : strip_tags($institute->general->description) !!}
                                            </p>
                                        @endif
                                        <div class="d-flex p-4 justify-content-between align-items-center">
                                            <ul class="d-flex rating">
                                                {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                            </ul>


                                            <a class="view-btn" href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
        <!-- ======= End Featured Institutes ======= -->

        {{-- Featured Coaching Institutes --}}
        @foreach ($streamstobeshown as $stream)
            <section class="featured-institutes mt-5 pb-5">
                <div class="container">
                    <div class="d-flex">
                        <h2>Featured Coaching Institutes of {{ $stream->name }}
                            <hr class="divider">
                        </h2>
                        @php
                            $institutes = \App\Models\Institute::where('is_plan_expired', false)
                                ->where('status', true)
                                ->withWhereHas('streams', function ($query) use ($stream) {
                                    $query
                                        ->where('status', true)
                                        ->where('stream_id', $stream->id)
                                        ->withWhereHas('stream', function ($query) {
                                            $query->where('is_show_categorypage', true);
                                        });
                                })
                                ->take(6)
                                ->get();
                        @endphp
                    </div>

                    <div class="row pt-4 mt-4">
                        @if (!empty($institutes) && $institutes->count() > 0)
                            @foreach ($institutes as $institute)
                                <div class="col-lg-4 mb-4">
                                    <div class="card">
                                        @if ($institute->is_recommended)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <img src="/assets/skoodos/assets/img/explore-listing/recommended.png"
                                                        alt="">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="d-flex p-4 finstitute-line">
                                            <div class="finstitute-img">
                                                <img src="{{ !empty($institute->upload->logo) ? Storage::disk('public')->url($institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                                    alt="Logo">
                                                @if (empty($institute->upload->logo))
                                                    <div style="position:relative; text-align:center;">
                                                        <h2
                                                            style="font-size: 20px; font-weight:bold;position:relative; margin-top:-52px;">
                                                            {{ $institute->nickname() }}</h2>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="finstitute-detail ps-3">
                                                <a href="">
                                                    <h4 class="institute-name mb-1">{{ $institute->name }}</h4>
                                                </a>
                                                <ul>
                                                    <li><span><i
                                                                class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                                        {{ $institute->city_name }},
                                                        {{ $institute->state_name }}
                                                    </li>
                                                    <li><span><i
                                                                class="bi bi-telephone-fill"></i></span>+91-{{ $institute->mobile }}
                                                    </li>
                                                    <li><span><i
                                                                class="bi bi-envelope-fill"></i></span>{{ $institute->email }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (!empty($institute->general->description))
                                                <p class="card-text finstitute-line p-4">
                                                    {!! strlen($institute->general->description) > 250
                                                        ? strip_tags(substr($institute->general->description, 0, 250)) . '...'
                                                        : strip_tags($institute->general->description) !!}
                                                </p>
                                            @endif

                                            <div class="d-flex p-4 justify-content-between align-items-center">
                                                <ul class="d-flex rating">
                                                    {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}


                                                </ul>
                                                <a class="view-btn"
                                                    href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12 mb-4">
                                No Institute is Available
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach
        <!-- ======= End Featured Coaching Institutes ======= -->

    </main><!-- End #main -->
@endsection



@push('scripts')
    <script>
        // --------==== Entrance Slider =======

        $("#categories-foreign-silder")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 6,
                arrows: true,
                autoplay: false,
                responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    },
                }, ],
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
            });



        $("#cat-foreign-featured-slider")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 6,
                arrows: true,
                autoplay: false,
                responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    },
                }, ],
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
            });
    </script>
@endpush

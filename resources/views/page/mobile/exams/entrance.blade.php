@extends('layouts.mobile.sub-master')
@section('title')
    All Recruitment and Entrance Exams in India | Skoodos Bridge
@endsection
@section('metadescription')
    Discover college entrance exams, university entrance exams, competitive entrance exams, medical entrance exams,
    engineering entrance exams, law entrance exams, MBA entrance exams, government entrance exams, entrance exam syllabus,
    entrance and exam dates.
@endsection
@section('keyword')
    entrance exam, entrance exams, MBA entrance exam, engineering entrance exams, MCA entrance exam, medical entrance exam,
    Top Engineering Entrance Exams in India, State Entrance Examination, List of Entrance Exams in India, CUET Entrance
    Exam, CAT Entrance Exam, GMAT Entrance Exam, CMAT Entrance Exam, XAT Entrance Exam, ATMA Entrance Exam, DUET Entrance
    Exam, SNAP Entrance Exam, IMU CET Entrance Exam
@endsection
@section('content')

    <main>

        <!-- ------- Sub Header ----- -->

        <header class="sub-header">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between align-content-center">
                        <a href="/"><i class="bi bi-arrow-left"></i>{{ strtoupper($category->name) }}</a>
                        {{-- <div class="institute-logo d-flex align-items-center gap-3">
                        <img src="/assets/skoodos/assets/img/homepage/EntranceExam/institutes.png"
                            alt="">
                        <p>{{ $instituteCategoryWise }}</p>
                    </div> --}}
                    </div>
                </div>
            </div>
        </header>

        <!-- ------- Hero-banner ----- -->

        <section class="hero-banner">
            <img src="{{ Storage::disk('public')->url($category->mobile_category_page_banner) }}" alt="">

        </section>

        <!-- ------- Hero-banner ----- -->

        <section class="section--exams categories-exams">
            <div class="container">
                <div class="section--exams__card">
                    <div class="section--exams__card__header text-center d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-center align-items-center gap-3">

                            @if (!empty($category->icon))
                                <img src="{{ Storage::disk('public')->url($category->icon) }}" alt=""
                                    class="entrance-logo">
                            @else
                                <img src="/assets/skoodos/assets/img/homepage/entrance-exam.png" alt=""
                                    class="entrance-logo">
                            @endif
                            <h2>{{ strtoupper($category->name) }}</h2>
                        </div>
                        <div class="institute-logo d-flex align-items-center gap-3">
                            <img src="/assets/skoodos/assets/img/homepage/EntranceExam/institutes.png" alt="">
                            {{-- <img src="assets/img/categories/institute.png" alt=""> --}}
                            <p>{{ $instituteCategoryWise }}</p>
                        </div>

                    </div>
                    <div class="row ">
                        @if ($category->streams->count() > 0)
                            @foreach ($category->streams as $stream)
                                <div class="col-6">
                                    <a href="#">
                                        <div class="card--box active">
                                            <div class="card--box__img">
                                                @if (!empty($stream->icon))
                                                    <img src="{{ Storage::disk('public')->url($stream->icon) }}"
                                                        alt="">
                                                @else
                                                    <img src="/assets/skoodos/assets/img/homepage/EntranceExam/Managment.png"
                                                        class="img-1">
                                                @endif

                                            </div>
                                            <div class="card--box__text">
                                                <h2>{{ $stream->name }}</h2>
                                                <p>{{ \App\Helpers\Helper::countInstituteStreamWise($stream->id) }} Institutes
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
        </section>

        <!-- -------------- Featured Institute ---------------->
        <!-- ======= Featured Institutes Section ======= -->
        <div>
            <section class="featured-institute">
                @if (!empty($institutes) && $institutes->count() > 0)
                    <div class="container">
                        <div class="section--heading sub-heading">
                            <h2>Featured Institutes</h2>
                        </div>
                        @foreach ($institutes as $institute)
                            <div class="featured-institute__container ">
                                @if ($institute->is_recommended)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <img src="/assets/skoodos/assets/img/categories/recommended.png"
                                                class="recommended" alt="">
                                        </div>
                                    </div>
                                @endif
                                <ul class="rating _text-end">
                                    {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                </ul>
                                <div class="featured-institute__card">
                                    <div class="featured-institute__img"
                                        style="display: flex;align-items:center;justify-content:center;">
                                        <img src="{{ !empty($institute->upload->logo) ? Storage::disk('public')->url($institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                            alt="">
                                        @if (empty($institute->upload->logo))
                                            <div style="position:absolute; text-align:center;">
                                                <h2 style="font-size: 20px; font-weight:bold;">
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
                                    <div class="featured-institute__text">
                                        <a href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">
                                            <h3>{{ $institute->name }}</h3>
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
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>

        <!-- -------------- Featured Institute ---------------->

    </main>
@endsection

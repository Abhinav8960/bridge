@extends('layouts.master')
@section('title')
    Skoodos Bridge: Explore Exams, Courses, and Top Coaching Institutes in India
@endsection
@section('metadescription')
    Skoodos Bridge: View detailed information about competitive exams, courses, and top coachings in India and abroad. Know
    all about Coaching institutes, fee, batch size, and dates.
@endsection
@section('keyword')
    Best Coaching Nearby, coaching centre near me, coaching classes near me, coaching near me, Best Coaching Classes, Best
    Coaching Institute, Top Coaching Classes, Top 10 Coaching Institutes, Best JEE Advanced Coaching, Best IIT Coaching,
    Best GATE Coaching, Best NEET Coaching, Best AIIMS Coaching, Best NEET PG Coaching, Best CAT Coaching, Best XAT
    Coaching, Best CLAT Coaching, Best LSAT Coaching, Best AILET Coaching, Best IAS Coaching, Best IFS Coaching, Best CPT
    Coaching, Best Bank Coaching, Best SBI PO Coaching, Best IBPS Coaching, Best RBI Assistant Coaching, Best NDA Coaching,
    Best CDS Coaching, Best IAF Airmen Coaching, Best AFCAT Coaching, Best SSC CHSL Coaching, Best SSC Coaching.
@endsection
@section('content')
    <!-- ======= Hero Section ======= -->
    {{-- @dd(auth()); --}}

    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <h1>Find The Best Coaching <br> For <span> Competitive Exams...</span></h1>
                @livewire('search-box')
                {{-- <div class="search_box d-flex align-items-center">
                    <div class="d-flex align-items-center form-select">
                        <a href="explore-listing"> <img
                                src="/assets/skoodos/assets/img/homepage/UpperBanner/location.png" alt="">
                            <span>Near Me</span></a>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control"
                            placeholder="Search By Exam / Stream / Institute / Location">
                        <a href="microsite.html" class="input-group-text py-2 px-4"> <i class="bi bi-search"></i> Find
                            Institute</a>
                    </div>
                </div> --}}
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Best Institutes Section ======= -->

        @livewire('home.best-institutes')


        <!-- ======= Entrance Exam Section ======= -->
        @livewire('home.entrance-exams')
        <!-- ======= Government Exams Section ======= -->

        @livewire('home.government-exams')

        <!-- ======= Foreign Languages Section ======= -->

        @livewire('home.foreign-language-exams')
        <!-- ----------- In Focus Section -------- -->

        @livewire('home.infocus')
        <!-- ------------ End In Focus Section -------- -->

        <!-- ======= Featured Institutes Section ======= -->

        {{-- @livewire('home.featured-institutes') --}}

        <!-- ======= Streams Institutes Section ======= -->

        @livewire('home.streams-institute')

    </main><!-- End #main -->
@endsection

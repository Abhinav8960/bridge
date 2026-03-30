@extends('layouts.mobile.master')
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
    <!-- --------------- Entrance Exams ---------- -->
    @livewire('home.entrance-exams')


    <!-- ----------- Government Exams ------------ -->
    @livewire('home.government-exams')


    <!-- ------------------------- Foregin Exams ---------------- -->

    @livewire('home.foreign-language-exams')


    <!-- -------------- Featured Institute ---------------->
    {{-- @livewire('home.featured-institutes') --}}
    @livewire('home.streams-institute-mobile')
@endsection

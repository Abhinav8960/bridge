@extends('layouts.mobile.sub-master')
@section('title')
    Compare Top Coaching Institutes in India | Skoodos Bridge
@endsection
@section('metadescription')
    Explore and compare coaching institutes in India for various competitive exams. Compare key factors such as reviews,
    fees, faculty, batch size, and infrastructure for exams.
@endsection
@section('keyword')
    Top Coaching Institutes in India, exam preparation, coaching classes in India, top coaching classes in India, top
    Coaching Centers in India, Top Coaching Institutes in India, Coaching Program Comparison, Compare Institutes, Institute
    Comparison, Coaching Comparison, Compare courses, Compare fees
@endsection
@section('content')
    <header class="sub-header">
        <div class="container">
            <div class="row">
                <a href="{{ route('explore.india') }}"><i class="bi bi-arrow-left"></i>Compare</a>
            </div>
        </div>
    </header>
    @livewire('compare')
@endsection

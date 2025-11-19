@extends('layouts.mobile.sub-master')
@section('title')
    Enroll your Coaching Institute | Skoodos Bridge
@endsection
@section('metadescription')
    Discover seamless enrollment for your coaching institute at Skoodos Bridge. Streamline your educational services by
    enrolling with us today. Join a platform designed to elevate your coaching institute's reach and impact.
@endsection
@section('keyword')
    Enrollment, Enrol Now, join us, Registration, Online Enrollment System, Enrol With Us
@endsection

@section('content')
    @livewire('student-profile.profile.enroll-course')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endpush

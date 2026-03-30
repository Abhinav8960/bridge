@extends('institute::layouts.master')

@section('content')
    <!-- Loader -->
    <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    <!-- Page -->
    <div class="page">

        <!-- main-content -->
        <div class="main-content app-content" style="margin-top:5%;">

            <!-- /breadcrumb -->
            <div class="row row-sm">

                <div class="col-xl-8">
                    <!-- container -->
                    <div class="main-container container-fluid">

                        <h5>Exams</h5>
                        <div class="row row-sm">
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('configuration.category.index') }}"><img
                                                    src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard__Exam Categories.png"
                                                    alt="Exam Categories"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Exam Categories</h6>
                                        <h3 class="font-weight-semibold">{{ $examcategory->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('configuration.stream.index') }}"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard__Exam Stream.png"
                                                    alt="Exam Streams"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Exam Streams</h6>
                                        <h3 class="font-weight-semibold">{{ $stream->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('configuration.exam.index') }}"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard__Exam.png"
                                                    alt="Exams"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Exams</h6>
                                        <h3 class="font-weight-semibold">{{ $exam->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <h5>Analytics</h5>
                        <div class="row row-sm">
                            @if ($package->is_showing_review)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body ">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.category.index') }}"><img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Reviews.png"
                                                        alt="Reviews"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Reviews</h6>
                                            <h3 class="font-weight-semibold">{{ $reviews }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($package->is_showing_courses)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body ">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.stream.index') }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Courses.png"
                                                        alt="Courses"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Courses</h6>
                                            <h3 class="font-weight-semibold">{{ $courses }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($package->is_showing_champions)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.exam.index') }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Champions.png"
                                                        alt="Champions"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Champions</h6>
                                            <h3 class="font-weight-semibold">{{ $champions }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($package->is_showing_faculty)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.exam.index') }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Faculty.png"
                                                        alt="Faculty"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Faculty</h6>
                                            <h3 class="font-weight-semibold">{{ $faculty }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($package->is_showing_videos)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.exam.index') }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Videos.png"
                                                        alt="Videos"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Videos</h6>
                                            <h3 class="font-weight-semibold">{{ $videos }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($package->is_showing_alumni)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.exam.index') }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Alumni.png"
                                                        alt="Alumni"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Alumni</h6>
                                            <h3 class="font-weight-semibold">{{ $alumni }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($package->is_course_enrollment)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <a href="{{ route('configuration.exam.index') }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Enrollments.png"
                                                        alt="Enrollments"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">Enrollments</h6>
                                            <h3 class="font-weight-semibold">{{ $enrollments }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('configuration.exam.index') }}"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/institutes/Dashboard_Leads.png"
                                                    alt="Leads"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Leads</h6>
                                        <h3 class="font-weight-semibold">{{ $leads }}</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
                <div class="col-xl-4" style="margin-top: 5px!important;">
                    <img src="/assets/skoodos/assets/img/Admin-Pannel.jpg">
                </div>
            </div>
        </div>
    </div>
@endsection

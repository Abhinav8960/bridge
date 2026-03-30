@extends('backend::layouts.master')

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
                                                    src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Exam Categories.png"
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
                                            <a href="{{ route('configuration.stream.index') }}">
                                                <img src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Exam Stream.png"
                                                    alt="Exam Stream"></a>
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
                                                    src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Exam.png"
                                                    alt="Exam"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Exams</h6>
                                        <h3 class="font-weight-semibold">{{ $exam->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="main-container container-fluid mt-5">

                        <h5>Institutes</h5>

                        <div class="row row-sm">
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('institute.index') }}"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Institutes.png"
                                                    alt="Institutes">
                                            </a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Institutes</h6>
                                        <h3 class="font-weight-semibold">{{ $institutes->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            @foreach ($instPackages as $package)
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body ">
                                            <div class="feature widget-2 text-center mt-0 mb-3">
                                                <?php $url = "/public/institute?pagesize=10&name=&state_id=&city_id=&area=&package_id=$package->package_id'"; ?>
                                                <a href="{{ $url }}"> <img
                                                        src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__{{ $package->package->name }}.png"
                                                        alt="{{ $package->package->name }}"></a>
                                            </div>
                                            <h6 class="mb-1 text-muted">{{ $package->package->name }}</h6>
                                            <h3 class="font-weight-semibold">{{ $package->total }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('institute.index') }}"> <img
                                                src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Expired.png"
                                                alt="Expired"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Expired</h6>
                                        <h3 class="font-weight-semibold">{{ $packagePlan->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('institute.index') }}"> <img
                                                src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Suspended.png"
                                                alt="Suspended"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Suspended</h6>
                                        <h3 class="font-weight-semibold">{{ $instsuspend->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('enrollments') }}"> <img
                                                src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Review.png"
                                                alt="Review"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Review</h6>
                                        <h3 class="font-weight-semibold">{{ $reviews->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('enrollments') }}"> <img
                                                src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Leads.png"
                                                alt="Leads"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Leads</h6>
                                        <h3 class="font-weight-semibold">{{ $paysuccess->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="main-container container-fluid mt-5">

                        <h5>Enrollments</h5>

                        <div class="row row-sm">
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('enrollments') }}"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Course Enrollment.png"
                                                    alt="Course Enrollments"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Course Enrollments</h6>
                                        <h3 class="font-weight-semibold">{{ $paysuccess->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="{{ route('enrollments') }}"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__Failed Enrollment.png"
                                                    alt="Failed Payments"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">Failed Payments</h6>
                                        <h3 class="font-weight-semibold">{{ $payfailure->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="feature widget-2 text-center mt-0 mb-3">
                                            <a href="#"> <img
                                                    src="/assets/img/backend-menu-icon/dashboard/admin/Dashboard__User Registeration.png"
                                                    alt="User Registrations"></a>
                                        </div>
                                        <h6 class="mb-1 text-muted">User Registrations</h6>
                                        <h3 class="font-weight-semibold">{{ $students->count() }}</h3>
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

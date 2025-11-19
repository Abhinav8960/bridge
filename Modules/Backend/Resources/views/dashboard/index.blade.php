@extends('backend::layouts.master')
@livewireStyles
@section('content')
    <!-- Loader -->
    <div id="global-loader">
        <img src="/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- main-content -->
    <div class="main-content app-content">

        <!-- container -->
        <div class="main-container container-fluid">





            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                    <!-- breadcrumb -->

                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Founder's Pen
                                <span class="">
                        </div>
                        {{-- <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog DashBoard</li>
                        </ol>
                    </div> --}}
                    </div>

                    <!-- /breadcrumb -->
                    <div class="row position-relative">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image1">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <a href="{{ route('blog.index') }}">
                                                <div class="">
                                                    <h6 class="mb-2 tx-14 ">Published Blogs</h6>
                                                </div>
                                            </a>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">
                                                        {{ $publishedBlog->count() }}</h4>
                                                </div>
                                                @if ($publishedBlog->count() >= $publishedBeforeWeekBlog->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>

                                                    </p>
                                                    <p class="mb-0"><span class="text-success font-weight-semibold">+
                                                            {{ $publishedBlog->count() - $publishedBeforeWeekBlog->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>

                                                    </p>
                                                    <p class="mb-0"><span class="font-weight-semibold text-danger"> -
                                                            {{ $publishedBeforeWeekBlog->count() - $publishedBlog->count() }}</span>
                                                    </p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-primary-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-shopping-bag tx-16 text-primary"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Published Blogs.png"
                                                alt="published blog">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <a href="{{ route('blog.index') }}">
                                                <div class="">
                                                    <h6 class="mb-2 tx-14">Suspended Blogs</h6>
                                                </div>
                                            </a>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">
                                                        {{ $suspendedBlog->count() }}</h4>
                                                </div>
                                                @if ($suspendedBlog->count() >= $suspendedBeforeWeekBlog->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $suspendedBlog->count() - $suspendedBeforeWeekBlog->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="font-weight-semibold text-danger"> -
                                                            {{ $suspendedBeforeWeekBlog->count() - $suspendedBlog->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-info-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-dollar-sign tx-16 text-info"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Suspended Blogs.png"
                                                alt="suspend blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <a href="{{ route('blog.index') }}">
                                                <div class="">
                                                    <h6 class="mb-2 tx-14">Schuduled Blogs</h6>
                                                </div>
                                            </a>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">{{ $schuldedBlog->count() }}
                                                    </h4>
                                                </div>
                                                @if ($schuldedBlog->count() >= $schuldedBeforeWeekBlog->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $schuldedBlog->count() - $schuldedBeforeWeekBlog->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"><span class="font-weight-semibold text-danger"> -
                                                            {{ $schuldedBeforeWeekBlog->count() - $schuldedBlog->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-external-link tx-16 text-secondary"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Scheduled Blogs.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image4">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <a href="{{ route('blog.category.index') }}">
                                                <div class="">
                                                    <h6 class="mb-2 tx-14">Active Categories</h6>
                                                </div>
                                            </a>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-22 font-weight-semibold mb-2">
                                                        {{ $activeCategories->count() }}</h4>
                                                </div>
                                                @if ($activeCategories->count() >= $activeBeforeWeekCategory->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $activeCategories->count() - $activeBeforeWeekCategory->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="font-weight-semibold text-danger"> -
                                                            {{ $activeBeforeWeekCategory->count() - $activeCategories->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-warning-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-credit-card tx-16 text-warning"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Active Categories.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <a href="{{ route('blog.category.index') }}">

                                                <div class="">
                                                    <h6 class="mb-2 tx-14">Suspended Categories</h6>
                                                </div>
                                            </a>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">
                                                        {{ $suspendCategories->count() }}</h4>
                                                </div>
                                                @if ($suspendCategories->count() >= $suspendBeforeWeekCategory->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $suspendCategories->count() - $suspendBeforeWeekCategory->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="font-weight-semibold text-danger"> -
                                                            {{ $suspendBeforeWeekCategory->count() - $suspendCategories->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-info-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-dollar-sign tx-16 text-info"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Suspended Categories.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <div class="">
                                                <h6 class="mb-2 tx-14">Published Comments</h6>
                                            </div>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">
                                                        {{ $publishedcomment->count() }}</h4>
                                                </div>
                                                @if ($publishedcomment->count() >= $publishedBeforeWeekComment->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $publishedcomment->count() - $publishedBeforeWeekComment->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="font-weight-semibold text-danger"> -
                                                            {{ $publishedBeforeWeekComment->count() - $publishedcomment->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-external-link tx-16 text-secondary"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Published Comments.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <div class="">
                                                <h6 class="mb-2 tx-14">Rejected Comments</h6>
                                            </div>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">
                                                        {{ $rejectcomment->count() }}</h4>
                                                </div>
                                                @if ($rejectcomment->count() >= $rejectBeforeWeekComment->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $rejectcomment->count() - $rejectBeforeWeekComment->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"><span class="font-weight-semibold text-danger"> -
                                                            {{ $rejectBeforeWeekComment->count() - $rejectcomment->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-info-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-dollar-sign tx-16 text-info"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Rejected Comments.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <a href="{{ route('approvalqueue') }}">

                                                <div class="">
                                                    <h6 class="mb-2 tx-14">Hold Comments</h6>
                                                </div>
                                            </a>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">
                                                        {{ $holdcomment->count() }}
                                                    </h4>
                                                </div>
                                                @if ($holdcomment->count() >= $holdBeforeWeekComment->count())
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $holdcomment->count() - $holdBeforeWeekComment->count() }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="font-weight-semibold text-danger"> -
                                                            {{ $holdBeforeWeekComment->count() - $holdcomment->count() }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-external-link tx-16 text-secondary"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Hold Comments.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12">
                            <div class="card sales-card circle-image3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="ps-4 pt-4 pe-3 pb-4">
                                            <div class="">
                                                <h6 class="mb-2 tx-14">Total Views</h6>
                                            </div>
                                            <div class="pb-0 mt-0">
                                                <div class="d-flex">
                                                    <h4 class="tx-20 font-weight-semibold mb-2">{{ $totalViews }}</h4>
                                                </div>
                                                @if ($totalViews >= $totalViewsBeforeweek)
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-up mx-2 text-success"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="text-success font-weight-semibold">+
                                                            {{ $totalViews - $totalViewsBeforeweek }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0 tx-14 text-muted">Last week<i
                                                            class="fa fa-caret-down mx-2 text-danger"></i>
                                                    </P>
                                                    <p class="mb-0"> <span class="font-weight-semibold text-danger"> -
                                                            {{ (int) $totalViewsBeforeweek - (int) $totalViews }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
                                            {{-- <i class="fe fe-external-link tx-16 text-secondary"></i> --}}
                                            <img src="/assets/backend/img/blog-dashboard/Hold Comments.png"
                                                alt="published blog">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">TRENDING pOSTS</h4>
                                    </div>

                                </div><!-- card-header -->
                                <div class="card-body p-0">
                                    <div class="browser-stats">
                                        @foreach ($trendingposts as $post)
                                            <div class=" border-bottom mx-3 mb-3 set-border">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-8 col-lg-8 col-md-8">
                                                        <ul class=" px-4 ms-2 py-2">
                                                            <li style="list-style: square">
                                                                <div>
                                                                    <h6 class="">{{ $post->title }}
                                                                    </h6>
                                                                    <p class="mb-0">
                                                                        {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                                        <div><span class="">{{ $post->views }}</span></div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                                        @php
                                                            $lastview = \App\Helpers\Helper::countweekview($post->id);
                                                        @endphp
                                                        @if ($post->views == $lastview || $lastview == 0)
                                                            @php
                                                                $view = 0;
                                                            @endphp
                                                             <div><span class="text-success fs-15"><i
                                                                class="fe fe-trending-up p-2"></i>{{ $view }}
                                                            %</span></div>
                                                        @else
                                                            @php
                                                                $view = (($post->views) * 100) / $lastview;
                                                            @endphp
                                                            <div><span class="text-success fs-15"><i
                                                                        class="fe fe-trending-up p-2"></i>{{ $view }}
                                                                    %</span></div>
                                                        @endif




                                                        {{-- @if ($post->views > $lastview)
                                                            @php
                                                                $view = (($post->views - $lastview) * 100) / $post->views;
                                                            @endphp
                                                            <div><span class="text-success fs-15"><i
                                                                        class="fe fe-trending-up p-2"></i>{{ $view }}
                                                                    %</span></div>
                                                        @else
                                                            @php
                                                                $view = (($lastview - $post->views) * 100) / $lastview;
                                                            @endphp
                                                            <div><span class="text-danger fs-15"><i
                                                                        class="fe fe-trending-down p-2"></i>{{ $view }}
                                                                    %</span></div>
                                                        @endif --}}
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach

                                        {{-- <div class=" border-bottom mx-3 mb-3 set-border">
                                            <ul class="d-flex justify-content-between align-items-center px-4 ms-2 py-2">
                                                <li style="list-style: square">
                                                    <div>
                                                        <h6 class="">Chrome Mozilla Foundation, IncMozilla
                                                            Foundation, IncMozilla Foundation, IncMozilla Foundation,
                                                        </h6>
                                                        <p class="mb-0">12 June 2023</p>
                                                    </div>
                                                </li>
                                                <div><span class="">35,502</span></div>
                                                <div><span class="text-success fs-15"><i
                                                            class="fe fe-arrow-up"></i>12.75%</span></div>

                                            </ul>

                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">

                    <div class="" style="    position: fixed;
                            right: -39px;"><img
                            src="/assets/backend/img/blog-dashboard/Admin-Banner.jpg" alt=""
                            style="height: 100vh"></div>

                </div>
            </div>



            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                {{-- <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('blog.create') }}">Create</a>
                </div> --}}
                <!-- row -->
                {{-- <div class="row row-sm">
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('blog.index') }}">
                                    <div class="plan-card text-center">
                                        <i class="fas fa-share-alt text-primary plan-icon"></i>
                                        <h6 class="text-drak text-uppercase mt-2">Published Blogs</h6>
                                        <h2 class="mb-2"> {{ $publishedBlog->count() }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('blog.index') }}">

                                    <div class="plan-card text-center">
                                        <i class="fas fa-comments plan-icon text-primary"></i>
                                        <h6 class="text-drak text-uppercase mt-2">Suspended Blogs</h6>
                                        <h2 class="mb-2">{{ $suspendedBlog->count() }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('blog.index') }}">

                                    <div class="plan-card text-center">
                                        <i class="fas fa-thumbs-up plan-icon text-primary"></i>
                                        <h6 class="text-drak text-uppercase mt-2">Scheduled Blogs</h6>
                                        <h2 class="mb-2">{{ $schuldedBlog->count() }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('blog.category.index') }}">
                                    <div class="plan-card text-center">
                                        <i class="fas fa-eye plan-icon text-primary"></i>
                                        <h6 class="text-drak text-uppercase mt-2">Active Categories</h6>
                                        <h2 class="mb-2">{{ $activeCategories->count() }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('blog.category.index') }}">

                                    <div class="plan-card text-center">
                                        <i class="fas fa-share-alt text-primary plan-icon"></i>
                                        <h6 class="text-drak text-uppercase mt-2">Suspended Categories</h6>
                                        <h2 class="mb-2"> {{ $suspendCategories->count() }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="plan-card text-center">
                                    <i class="fas fa-comments plan-icon text-primary"></i>
                                    <h6 class="text-drak text-uppercase mt-2">Published Comments</h6>
                                    <h2 class="mb-2">{{ $publishedcomment->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="plan-card text-center">
                                    <i class="fas fa-thumbs-up plan-icon text-primary"></i>
                                    <h6 class="text-drak text-uppercase mt-2">Rejected Comments</h6>
                                    <h2 class="mb-2">{{ $rejectcomment->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="plan-card text-center">
                                    <i class="fas fa-eye plan-icon text-primary"></i>
                                    <h6 class="text-drak text-uppercase mt-2">Total Views</h6>
                                    <h2 class="mb-2">{{ $totalViews }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-12 col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="card-header pb-1">
                                <div class="card-title mb-2">Trending Posts</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group projects-list border-0">
                                    @foreach ($trendingposts as $post)
                                        <a href="{{ route('founderspen.show', $post->post_slug) }}"
                                            class="list-group-item list-group-item-action flex-column align-items-start border-0">
                                            <div class="d-flex w-100 justify-content-between">
                                                <p class="tx-13 mb-2 font-weight-semibold text-dark">{{ $post->title }}
                                                </p>
                                                <h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">views
                                                    ({{ $post->views }})
                                                </h4>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}
                <!-- /row -->

            </div>

        </div>
    </div>
    @livewireScripts
@endsection
@section('script')
    {{-- <script type="javascript">
    document.onsubmit=function(){
        return confirm('Sure?')
    }
</script> --}}
@endsection

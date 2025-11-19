@extends('layouts.master')
@section('title')
    Skoodos Bridge Blog: Your Source for Exam Tips and Institute Recommendations
@endsection
@section('metadescription')
    Skoodos Bridge Blog is your go-to resource for finding top coaching for any entrance exam, government exams, foreign
    language exams and more. Follow us for the top tips and exam strategies.
@endsection
@section('content')
    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- --------- Breadcrumbs ---------- -->

    <section class="blog">
        <div class="container">
            <div class="row gap-40">
                <div class="col-lg-8">


                    @livewire('blog.blog', ['month' => $month, 'year' => $year])
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-right">
                        @livewire('blog.right-sidebar')
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

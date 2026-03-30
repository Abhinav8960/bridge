@extends('layouts.master')
@section('title')
    {{ $post->meta_title }}
    {{-- @dd($post->meta_title) --}}
@endsection

@section('metadescription')
    {{ $post->meta_description }}
@endsection
@section('keyword')
    {{ $post->meta_keywords }}
@endsection

@section('content')
    <!-- --------- Breadcrumbs ---------- -->


    <!-- --------- Breadcrumbs ---------- -->
    <?php

    $bradcrumbs = [['url' => route('homepage'), 'page' => 'Home'], ['url' => route('blog'), 'page' => 'Blog'], ['page' => ucwords(str_replace('-', ' ', $slug))]];

    ?>


    @include('page._bradcrumb', $bradcrumbs)

    <!-- --------- Breadcrumbs ---------- -->

    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    @livewire('blog.description', ['slug' => $slug])
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-right">
                        @livewire('blog.right-sidebar')

                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </section>
@endsection
@push('style')
    <style>
        .text-editors h3 strong,
        .text-editors h3 {
            font-size: 25px;
            font-weight: 400;
            color: #5f3813;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(".blog-slider").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            dots: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
        });
    </script>
@endpush

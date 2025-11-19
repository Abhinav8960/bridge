@extends('layouts.master')

@section('content')
    <?php

    $bradcrumbs = [['url' => route('homepage'), 'page' => 'Home'], ['url' => route('blog'), 'page' => 'Blog'], ['page' => ucwords(str_replace('-', ' ', $category))]];

    ?>
    @include('page._bradcrumb', $bradcrumbs)


    <!-- --------- Breadcrumbs ---------- -->

    <section class="blog">
        <div class="container">
            <div class="row gap-40">
                <div class="col-lg-8">
                    @livewire('blog.category', ['categoryname' => $category])
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


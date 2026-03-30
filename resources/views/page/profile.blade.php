@extends('layouts.master')

@section('content')
    <section class="top-banner explore-top">
        <div class="container">
            <div class="categories_bg explore-listing-bg"  style="background-image: url({{ '/assets/skoodos/assets/img/defaultImages/Search_Leaderboard.jpg' }});">
                <!-- <div class="col-lg-7">
                    <h1>We are connect with <span>limitless <br> Institutes</span> across India</h1>
                    <div class="row py-3">
                        <div class="col-lg-4 d-flex ">
                            <img src="/assets/skoodos/assets/img/explore-listing/verify.png" alt="">
                            <p>Verified <br> Listing</p>
                        </div>
                        <div class="col-lg-4 d-flex ">
                            <img src="/assets/skoodos/assets/img/explore-listing/limitless.png" alt="">
                            <p>Limitless <br> Options</p>
                        </div>
                        <div class="col-lg-4 d-flex ">
                            <img src="/assets/skoodos/assets/img/explore-listing/experience.png" alt="">
                            <p>Seamless <br> Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                </div> -->
            </div>
        </div>
    </section>

    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ---------End Breadcrumbs ---------- -->

    <div class="my-profile">
        <div class="container">
            <h1 class="heading text-start">My Profile</h1>
        </div>
    </div>

    @livewire('student-profile.profile-tabs')
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endpush

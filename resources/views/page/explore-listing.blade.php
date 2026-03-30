@extends('layouts.master')
@section('title')
    Discover the Best Coaching Institutes in India | Skoodos Bridge
@endsection
@section('metadescription')
    Find Best Coaching Classes in India for Competitive and Recruitment Exams for JEE, NEET, SSC, Bank, GATE, CAT, IAS, CA,
    CLAT with Reviews, Fees, and Exam dates.
@endsection
@section('keyword')
    Competitive Exams, Best JEE Advanced Coaching, Best IIT Coaching, Best NEET Coaching, Best NEET PG Coaching, Best CAT
    Coaching, Best SNAP Coaching, Best CLAT Coaching, Best LSAT Coaching, Best IAS Coaching, Best GRE Coaching, Best IIT-JEE
    Coaching, Best CS Foundation Coaching, Best JEE Coaching, Best Bank Coaching, Best SBI PO Coaching, Best IBPS Coaching,
    Best NTSE Coaching, Best KVPY Coaching, Best NSE Coaching, Best NDA Coaching, Best CDS Coaching, Best CPF Coaching, Best
    SSC Coaching, Best SSC CHSL Coaching, Best SSC Coaching, Best SSC CPO Coaching, Best SSC JE Coaching, Best Coaching
    Classes, Best Coaching Institute
@endsection
@section('content')
    <!-- ======= Hero Section ======= -->



    <section class="top-banner explore-top">
        <div class="container">
            <div class="categories_bg explore-listing-bg" style="background-image: url('{{ $leaderbaord }}');">
                <div class="col-lg-7">
                    {{-- <h1>We are connect with <span>limitless <br> Institutes</span> across India</h1> --}}
                    <div class="row py-3">
                        <div class="col-lg-4 d-flex ">
                            {{-- <img src="/assets/skoodos/assets/img/explore-listing/verify.png" alt="">
                            <p>Verified <br> Listing</p> --}}
                        </div>
                        <div class="col-lg-4 d-flex ">
                            {{-- <img src="/assets/skoodos/assets/img/explore-listing/limitless.png" alt="">
                            <p>Limitless <br> Options</p> --}}
                        </div>
                        <div class="col-lg-4 d-flex ">
                            {{-- <img src="/assets/skoodos/assets/img/explore-listing/experience.png" alt="">
                            <p>Seamless <br> Experience</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                </div>
            </div>
        </div>
    </section>


    <!-- --------- Breadcrumbs ---------- -->

    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    @if (Route::is('explore.india'))
                        <li class="breadcrumb-item active">Coaching Institutes In India</li>
                    @elseif (!empty($rseoprefix))
                        <li class="breadcrumb-item active">
                            {{ ucwords(str_replace('-', ' ', request()->rseoprefix)) }} /
                            {{ ucwords(str_replace('-', ' ', request()->rseoslug)) }}
                        </li>
                    @else
                        <li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', request()->rseoslug)) }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>

    <!-- -------------------- Search Cities ------------ -->

    @livewire('explore.search-institute-by-city', [$rcategory, $rstream, $rexam, $rstate, $rcity, $rarea])


    <!-- --------------=============== Coaching Institutes ==========-------------- -->

    @livewire('explore.intitutes-section', [$rcategory, $rstream, $rexam, $rstate, $rcity, $rarea, $rseourl])
@endsection



@push('scripts')
    <script>
        $(document).on({
            click: function() {
                $('body').toggleClass('fcd-ie8'); //For the stupid ie8
                $(this).toggleClass('open');
                return false;
            }
        }, ".cbxTree-swicth");
        $(document).on({
            change: function() {
                var $node = $(this).closest('.cbxTree-node');
                if ($(this).is(':checked')) {
                    if ($(this).hasClass('parent')) {
                        $('input.cbxTree-cbx').not(this).prop('checked', false);
                    }
                    $node.children('.cbxTree-swicth').addClass('open');
                } else {
                    $node.children('.cbxTree-swicth').addClass('close');
                }
                $node.find('.cbxTree-cbx').prop({
                    checked: $(this).is(':checked')
                });
            }
        }, ".cbxTree-cbx");
    </script>

    <!-- -- Exam Check box---- -->

    <script>
        $("#select-all-institute").on('click', function() {
            $(".cbinstitute").prop('checked', true);
        });

        $("#select-all-stream").on('click', function() {
            $(".select-cb-stream").prop('checked', true);
        });

        $("#select-all-sub-stream").on('click', function() {
            $(".select-cb-sub-stream").prop('checked', true);
        });

        $("#select-all-exam").on('click', function() {
            $(".select-cb-exam").prop('checked', true);
        });

        $("#select-all-features").on('click', function() {
            $(".select-cb-features").prop('checked', true);
        });

        $("#select-all-area").on('click', function() {
            $(".select-cb-area").prop('checked', true);
        });
        $("#select-all-state").on('click', function() {
            $(".select-cb-state").prop('checked', true);
        });
        $("#select-all-city").on('click', function() {
            $(".select-cb-city").prop('checked', true);
        });
    </script>

    <script>
        $(".cities-slider").slick({
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 6,
            arrows: false,
            autoplay: false,
            dots: true,
            responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 4,
                    },
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 4,
                    },
                },
            ],

        });
    </script>
@endpush

@extends('layouts.mobile.sub-master')
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
    <!-- --------------=============== Coaching Institutes ==========-------------- -->

    @livewire('explore.institutesmobile-section', [$rcategory, $rstream, $rexam, $rstate, $rcity, $rarea, $rseourl])


    <!-- ---------------- Top Institutes ----------- -->


    <!-- --------------- Footer ---------------- -->

    <footer class="footer">
        <a href="{{route('homepage')}}"><img src="/assets/skoodos/assets/img/footer-logo.png" alt=""></a>
    </footer>



    <!-- --------------- Footer ---------------- -->
@endsection


@push('scripts')
    <script src="{{ asset('js/share.js') }}"></script>
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
    <style>
        .footer {
            background-image: url(/assets/skoodos/assets/img/footer-bg.png)
        }
    </style>
@endpush

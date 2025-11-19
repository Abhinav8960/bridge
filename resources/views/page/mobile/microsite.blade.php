@extends('layouts.mobile.microsite-master')
    @section('title'){{ $institute->name }}@endsection
    @section('description'){{ strip_tags($institute->general->description) ?? '' }}@endsection
    @section('og')
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta property="og:title" content="{{ $institute->name }}" />
        <meta property="og:description" content="{{ strip_tags($institute->general->description) ?? '' }}" />
        <meta property="og:image"
            content="{{ !empty($uploads->leaderboard) ? Storage::disk('public')->url($uploads->leaderboard) : env('APP_URL').'/assets/skoodos/assets/img/defaultImages/Institute_LeaderBoard.jpg' }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website">
        <meta property="og:updated_time" content="{{ strtotime($institute->updated_at) }}" />
    @endsection()
@section('content')
    <!-- ------------------------ Microsite TAB ------------------------- -->

    @livewire('institute.microsite', ['institute' => $institute])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".exam-card-slider")
                .slick({
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: false,
                    responsive: [{
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 475,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 1,
                            },
                        },
                    ],
                    prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                    nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
                });
        });

        $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
            $('.exam-card-slider').slick('setPosition');
        });
        $('#engineer-btn-more').click(function() {
            $('.exam-card-slider').slick('setPosition');
        })
    </script>
    <script>
        $('#gallery-btn-more').click(function(e) {
            e.preventDefault();
            $('.gallery-show-more').slideToggle("slow");
            if ($('#gallery-course').val() == 1) {
                $('#gallery-btn-more').text(" ");
                $('#gallery-course').val(0);
                $('#gallery-btn-more').text("View less");

            } else {
                $('#gallery-btn-more').text(" ");
                $('#engineering-course').val(1);
                $('#gallery-btn-more').text("View More");
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $('#microsite-option-model').modal('show');
            $(".select2").select2();

            // Enables popover
            $("[data-toggle=popover]").popover();

            $('.star-icon').each(function() {
                $(this).hover(function() {
                    $(this).prevAll().addBack().css("color", "#d0de29");
                }, function() {
                    if (!$(this).parent().attr("data-rating")) {
                        $(this).prevAll().addBack().css("color", "#a5a5a5");
                    } else {
                        $(this).siblings().addBack().each(function(index) {
                            index + 1 <= $(this).parent().attr("data-rating") ?
                                $(this).css("color", "#d0de29") : $(this).css("color",
                                    "#a5a5a5");
                        });
                    }
                }).click(function() {
                    $(this).parent().attr("data-rating", $(this).prevAll().length + 1);
                });
            });
        });

        $('#microsite-option-model button').click(function() {
            $('#microsite-option-model').modal('hide');
            $('main').removeClass('d-none')
        });


        $('.gallery-section').slickLightbox({
            src: 'src',
            itemSelector: '.gallery__item img',
            background: 'rgba(0, 0, 0, .7)'
        });
    </script>
    <script>
        function openModal() {
            document.getElementById("gallery-modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("gallery-modal").style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
@endpush

@extends('layouts.master')

@section('title')
    {{ $generalsData->meta_title }}
@endsection
@section('metadescription')
    {{ $generalsData->meta_description }}
@endsection
@section('keyword')
    {{ $generalsData->meta_keywords }}
@endsection

@section('content')
    <!-- ------------------------ Microsite TAB ------------------------- -->

    @livewire('institute.microsite', ['institute' => $institute, 'coursesTab' => request()->coursesTab])
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@push('scripts')
    <script>
        $("#micro-features-slider")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                arrows: true,
                autoplay: false,
                responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    },
                }, ],
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
            });



        $('#micro-features-slider').slickLightbox({
            src: 'src',
            itemSelector: '.card img',
            background: 'rgba(0, 0, 0, .7)'
        });
    </script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
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
    </script>
    <!-- --------------------  Course Collapse------------ -->


    <!-- ------------ Faculty Collapse ------------ -->

    <script>
        $('#faculty-btn-more').click(function(e) {
            e.preventDefault();
            $('.faculty-show-more').slideToggle("fast");
            if ($('#faculty-card').val() == 1) {
                $('#faculty-card').val(0);
                $('#faculty-btn-more').text("Collapse");
            } else {
                $('#faculty-card').val(1);
                $('#faculty-btn-more').text("Show More");
            }
        });
    </script>

    <!-- ------------ alumni Collapse ------------ -->

    <script>
        $('#alumni-btn-more').click(function(e) {
            e.preventDefault();
            $('.alumni-show-more').slideToggle("fast");
            if ($('#alumni-card').val() == 1) {
                $('#alumni-card').val(0);
                $('#alumni-btn-more').text("Collapse");
            } else {
                $('#alumni-card').val(1);
                $('#alumni-btn-more').text("Show More");
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>

    <script>
        function examsliknow() {
            setTimeout(function() {
                $(".exam-card-slider")
                    .slick({
                        infinite: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        arrows: true,
                        autoplay: false,
                        responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4,
                            },
                        }, ],
                        prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                        nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
                    });
            }, 1000);
        }
        examsliknow();

        // $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
        //     $('.exam-card-slider').slick('setPosition');
        // });

        // $('#engineer-btn-more').click(function() {
        //     $('.exam-card-slider').slick('setPosition');
        // })
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

<div>
    <section class="best-institutes">
        <div class="container">
            <h1>The Best Institutes Across All India</h1>
            <hr class="divider text-center mt-2">
            <p class="w-75 m-auto mt-4 text-center">
                Skoodos Bridge, your premier guide in the maze of 80,000+ coaching institutes across India, is
                here to simplify your search. Whether you’re gearing up for engineering, medical, management,
                or law entrance exams, explore in-depth details on top institutes. From fees to batch sizes,
                Skoodos Bridge is your one-stop solution for finding the ideal coaching institute. Your journey to
                academic excellence starts here.</p>


            <div id="cities-silder" class="cards d-flex align-items-center mt-4">
                @if ($popularCityOptions->count() > 0)
                    @foreach ($popularCityOptions as $popularCity)
                        <a href="{{ route('explore.institute', [$rcategory, $rstream, $rexam, $popularCity->state_id, $popularCity->city_id, $rarea, \App\Helpers\Helper::SeoUrl(['state'=>$popularCity->state_id,'city'=>$popularCity->city_id])]) }}">

                            <div class="card">
                                @if (!empty($popularCity->icon))
                                        <img src="{{ Storage::disk('public')->url($popularCity->icon) }}" alt="..."
                                        class="img-fluid">
                                @else

                                        <img src="/assets/skoodos/assets/img/homepage/BestInstitute/delhi.png" alt="..."
                                            class="img-fluid">
                                @endif
                                <div class="card-body text-center">
                                    <p>{{ $popularCity->city_name }} <span>({{ $popularCity->institutesCount() }})</span></p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function(event) {
                Livewire.hook('message.processed', () => {
                    sliderActivate();
                });
            });

            function sliderActivate() {
                $("#cities-silder")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        slidesToShow: 5,
                        slidesToScroll: 5,
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
            }
            sliderActivate();
        </script>
    @endpush

</div>

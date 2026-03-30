<div>
    @if ($desktopResult)
        <section class="featured-institutes mt-5 pb-5">
            @if (!empty($institutes) && $institutes->count() > 0)
                <div class="container">
                    <div class="d-flex">
                        <h2>Featured Institutes
                            <hr class="divider">
                        </h2>
                    </div>


                    <div class="row pt-4 mt-4">
                        @foreach ($institutes as $institute)
                            <div class="col-lg-4 mb-4">
                                <div class="card">
                                    @if ($institute->is_recommended)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img src="/assets/skoodos/assets/img/categories/recommended.png"
                                                    alt="">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex p-4 finstitute-line">
                                        <div class="finstitute-img">
                                            <img src="{{ !empty($institute->upload->logo) ? Storage::disk('public')->url($institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                                alt="Logo">
                                            @if (empty($institute->upload->logo))
                                                <div style="position:relative; text-align:center;">
                                                    <h2
                                                        style="font-size: 20px; font-weight:bold;position:relative; margin-top:-52px;">
                                                        @php
                                                            $str = $institute->name;
                                                            echo implode(
                                                                '',
                                                                array_map(function ($v) {
                                                                    return $v[0];
                                                                }, explode(' ', $str)),
                                                            );
                                                        @endphp
                                                    </h2>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="finstitute-detail ps-3">
                                            <a href="">
                                                <h4 class="institute-name mb-1">{{ $institute->name }}</h4>
                                            </a>
                                            <ul>
                                                <li><span><i
                                                            class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                                    {{ $institute->city_name }},
                                                    {{ $institute->state_name }}
                                                </li>
                                                <li><span><i
                                                            class="bi bi-telephone-fill"></i></span>+91-{{ $institute->mobile }}
                                                </li>
                                                <li><span><i
                                                            class="bi bi-envelope-fill"></i></span>{{ $institute->email }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if (!empty($institute->general))
                                            <p class="card-text finstitute-line p-4">
                                                {{ strlen($institute->general->description) > 250 ? substr($institute->general->description, 0, 250) . '...' : $institute->general->description }}
                                            </p>
                                        @endif
                                        <div class="d-flex p-4 justify-content-between align-items-center">
                                            <ul class="d-flex rating">
                                                {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                            </ul>


                                            <a class="view-btn" href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @elseif ($mobileResult)
        <section class="featured-institute">
            @if (!empty($institutes) && $institutes->count() > 0)
                <div class="container">
                    <div class="section--heading sub-heading">
                        <h2>Featured Institutes</h2>
                    </div>
                    @foreach ($institutes as $institute)
                        <div class="featured-institute__container ">
                            @if ($institute->is_recommended)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <img src="/assets/skoodos/assets/img/categories/recommended.png"
                                            class="recommended" alt="">
                                    </div>
                                </div>
                            @endif
                            <ul class="rating _text-end">
                                {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                            </ul>
                            <div class="featured-institute__card">
                                <div class="featured-institute__img"
                                    style="display: flex;align-items:center;justify-content:center;">
                                    <img src="{{ !empty($institute->upload->logo) ? Storage::disk('public')->url($institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                        alt="">
                                    @if (empty($institute->upload->logo))
                                        <div style="position:absolute; text-align:center;">
                                            <h2 style="font-size: 20px; font-weight:bold;">
                                                @php
                                                    $str = $institute->name;
                                                    echo implode(
                                                        '',
                                                        array_map(function ($v) {
                                                            return $v[0];
                                                        }, explode(' ', $str)),
                                                    );
                                                @endphp
                                            </h2>
                                        </div>
                                    @endif
                                </div>
                                <div class="featured-institute__text">
                                    <a href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">
                                        <h3>{{ $institute->name }}</h3>
                                    </a>
                                    <ul>
                                        <li><span><i class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                            {{ $institute->city_name }},
                                            {{ $institute->state_name }}
                                        </li>
                                        <li><span><i
                                                    class="bi bi-telephone-fill"></i></span>+91-{{ $institute->mobile }}
                                        </li>
                                        <li><span><i class="bi bi-envelope-fill"></i></span>{{ $institute->email }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function(event) {
            Livewire.hook('message.processed', () => {
                featuredsliderActivate();
            });
        });

        function featuredsliderActivate() {
            $("#categories-bise-featured-slider")
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
        featuredsliderActivate();
    </script>
@endpush
@push('style')
    <style>
        .img {
            position: top;
        }
    </style>
@endpush
</div>

<div>
    @if ($visibility == true)
        @if ($desktopResult)
            <section class="featured-institutes mt-5 pb-5">
                <div class="container">
                    <div class="d-flex">
                        <h2>Featured Institutes
                            <hr class="divider">
                        </h2>
                        {{-- <div class="featured-dd ms-4">
                        <select class="form-select" aria-label="Default select example" wire:model="category">
                            @foreach ($categoryOptions as $key => $categ)
                                <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    </div>
                    {{-- <div id="featured-silder" class="cards slider-cards d-flex align-items-center mt-4">
                    @if ($streamOptions->count() > 0)
                        @foreach ($streamOptions as $stream)
                            <a wire:click="showInstitutes({{ $stream->id }})">
                                <div class="card @if ($selectedStream == $stream->id) active @endif"">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            @if (!empty($stream->icon))
                                                <img src="{{ Storage::disk('public')->url($stream->icon) }}"
                                                    class="exam-img-1" alt="">
                                            @else
                                                <img src="/assets/skoodos/assets/img/homepage/EntranceExam/Managment.png"
                                                    class="exam-img-1" alt="">
                                            @endif
                                            @if (!empty($stream->icon_hover))
                                                <img src="{{ Storage::disk('public')->url($stream->icon_hover) }}"
                                                    class="exam-img-2" alt="">
                                            @else
                                                <img src="/assets/skoodos/assets/img/homepage/EntranceExam/Management-Hover.png"
                                                    class="exam-img-2" alt="">
                                            @endif
                                        </div>
                                        <div class="">
                                            <h3>{{ $stream->name }}</h3>
                                            <p>{{ \App\Helpers\Helper::countFeaturedIntituteByStream($stream->id) }}
                                                Institutes</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div> --}}
                    <div class="row pt-4 mt-4">
                        @if (!empty($institutes) && $institutes->count() > 0)
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
                                            @if (!empty($institute->general->description))
                                                <p class="card-text finstitute-line p-4">
                                                    {!! strlen($institute->general->description) > 250 ? substr($institute->general->description, 0, 250) . '...' : $institute->general->description !!}
                                                </p>
                                            @endif
                                            <div class="d-flex p-4 justify-content-between align-items-center">
                                                <ul class="d-flex rating">
                                                    {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                                </ul>
                                                <a class="view-btn"
                                                    href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        @elseif ($mobileResult)
            <!-- -------------- Featured Institute ---------------->
            <section class="featured-institute" style="background-color: #ffff;">
                <div class="container">
                    <div class="section--heading sub-heading">
                        <h2>Featured Institutes</h2>
                    </div>
                    @if (!empty($institutes) && $institutes->count() > 0)
                        @foreach ($institutes as $institute)
                            <div class="featured-institute__container ">
                                @if ($institute->is_recommended)
                                    <img src="/assets/skoodos/assets/img/categories/recommended.png" class="recommended"
                                        alt="">
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
                    @endif
                </div>
            </section>
        @endif
    @endif
</div>

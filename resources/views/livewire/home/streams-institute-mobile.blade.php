<div>
    @if ($visibility == true)
    @foreach ($streamstobeshown as $stream)

            <!-- -------------- Featured Institute ---------------->
            <section class="featured-institute" style="background-color: #ffff;">
                <div class="container">
                    <div class="section--heading sub-heading">
                        <h2>Featured Institutes  {{ $stream->name }}</h2>
                        @php
                        $institutes = \App\Models\Institute::where('is_plan_expired', false)
                            ->where('status', true)
                            ->withWhereHas('streams', function ($query) use($stream){
                                $query->where('status', true)->where('stream_id', $stream->id)->withWhereHas('stream', function ($query){
                                    $query->where('is_show_homepage', true);
                                });
                            })
                            ->inRandomOrder()->limit(3)
                            ->get();
                    @endphp
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
                        @else
                        <div class="col-lg-12 mb-4">
                            No Institute is Available
                        </div>
                    @endif
                </div>
            </section>
            @endforeach
    @endif
</div>

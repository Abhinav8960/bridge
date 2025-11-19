<div>
    @if ($visibility == true)
        @foreach ($streamstobeshown as $stream)
            <section class="featured-institutes mt-5 pb-5">
                <div class="container">
                    <div class="d-flex">
                        <h2>Featured Coaching Institutes of {{ $stream->name }}
                            <hr class="divider">
                        </h2>
                        @php
                            $institutes = \App\Models\Institute::where('is_plan_expired', false)
                                ->where('status', true)
                                ->withWhereHas('streams', function ($query) use($stream){
                                    $query->where('status', true)->where('stream_id', $stream->id)->withWhereHas('stream', function ($query){
                                        $query->where('is_show_homepage', true);
                                    });
                                })
                                ->take(6)->get();
                        @endphp
                    </div>

                    <div class="row pt-4 mt-4">
                        @if (!empty($institutes) && $institutes->count() > 0)
                            @foreach ($institutes as $institute)
                                <div class="col-lg-4 mb-4">
                                    <div class="card">
                                        @if ($institute->is_recommended)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <img src="/assets/skoodos/assets/img/explore-listing/recommended.png"
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
                                                        {{ $institute->nickname() }}    
                                                        </h2>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="finstitute-detail ps-3">
                                                <a href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">
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
                                                {!! strlen($institute->general->description) > 250 ? strip_tags(substr($institute->general->description, 0, 250)) . '...' : strip_tags($institute->general->description) !!}
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
                                @else
                                <div class="col-lg-12 mb-4">
                                    No Institute is Available
                                </div>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach
    @endif
</div>

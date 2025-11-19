<div>
    <!-- ----------- In Focus Section -------- -->
    @if ($visibility == true)
        <section class="focus-section mt-5">
            <div class="container">
                <div class="row">
                    <div class="focus-section-heading">
                        <a href="foreign_language.html">
                            <h2 class="heading">In Focus
                                <hr class="divider">
                            </h2>
                        </a>
                    </div>
                    @if (!empty($institutes) && $institutes->count() > 0)
                        @foreach ($institutes as $institute)
                            <?php
                            $instituteReviewedBystudent = App\Models\InstituteReview::select('student_id')
                                ->where('institute_id', $institute->id)
                                ->distinct()
                                ->count('student_id');

                            ?>
                            <div class="focus-section-container">
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <div class="focus-section-img">
                                            <img src="{{ !empty($institute->upload->logo) ? Storage::disk('public')->url($institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                                alt="">
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
                                    </div>
                                    <div class="col-9 p-0">
                                        <div class="row ">
                                            <div class="col-12">
                                                @if ($institute->is_recommended == true)
                                                    <div class="sticky-recom-img">
                                                        <img src="/assets/skoodos/assets/img/categories/recommended.png"
                                                            alt="">
                                                    </div>
                                                @endif
                                                <div class="row focus-section-content">
                                                    <div class="col-8 col-xxl-9">
                                                        <div class="focus-section-text">
                                                            <h3>{{ $institute->name }}</h3>
                                                            <p><span><i
                                                                        class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                                                {{ $institute->city_name }},
                                                                {{ $institute->state_name }}</p>
                                                            <div class="d-flex gap-3">
                                                                <p><span><i
                                                                            class="bi bi-telephone-fill"></i></span>+91-{{ $institute->mobile }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex gap-3">
                                                                <p><span><i
                                                                            class="bi bi-globe"></i></span>https://rpsbcd.com
                                                                </p>
                                                                <p><span><i
                                                                            class="bi bi-envelope-fill"></i></span>{{ $institute->email }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-xxl-3">
                                                        <div class="focus-section-btn">
                                                            <ul class="d-flex rating">
                                                                {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                                                <li class="ms-2">
                                                                    {{ $instituteReviewedBystudent }} Views
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-wrapper">
                                                            <a class="yellow-btn" href="">Enroll Now</a>
                                                            <a class="view-btn"
                                                                href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (!empty($institute->general->description))
                                                    <div class="row focus-section-content">
                                                        <div class="col-12">
                                                            {{-- <p> {{ strlen($institute->general->description) > 250 ? strip_tags(substr($institute->general->description, 0, 250)) . '...' : strip_tags($institute->general->description) }}
                                                            </p> --}}
                                                            <p> {!! strlen($institute->general->description) > 250 ? strip_tags(substr($institute->general->description, 0, 250)) . '...' : strip_tags($institute->general->description) !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <?php $features = App\Models\Institute\Information\InstituteFeature::where('institute_id', $institute->id)
                                        ->where('status', true)
                                        ->get(); ?>
                                    @if ($features->count() > 0)
                                        <div class="row focus-section-details ">
                                            @foreach ($features as $key => $feature)
                                                <div class="col-lg-3 d-flex mt-4">
                                                    <div class="m-stream-icon">
                                                        <img src="{{ Storage::disk('public')->url($feature->info->icon) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="m-stream-detail">
                                                        <h4>{{ $feature->info->name }}</h4>
                                                        @if ($feature->info->name == 'Founded')
                                                            <p>{{ $feature->value == 1 ? 'Yes' : $feature->value }}</p>
                                                        @else
                                                            <p>{{ $feature->value == 1 ? 'Yes' : 'No' }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif


    <!-- ------------ End In Focus Section -------- -->
</div>

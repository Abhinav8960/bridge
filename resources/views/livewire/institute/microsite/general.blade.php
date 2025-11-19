<div>

    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">

            <!--------------=================== General Microsite ==================----------  -->

            <div class="m-about-institute mt-5">
                <h2 class="micro-heading">About Institute</h2>
                <hr class="divider">
                <p>{!! $generals->description !!}</p>
                <div class="row mt-4 mb-5">
                    @if ($generals->admission_screening)
                        <div class="col-lg-6">
                            <div class="admsn-screen-bg"
                                style="background-image: url({{ !empty($generals->admission_screening_image) ? Storage::disk('public')->url($generals->admission_screening_image) : '../img/microsite/general/about-institute/Artwork-1.png' }});">
                                <h4>Admission</h4>
                                <h3>Screening</h3>
                                <p>{!! $generals->admission_screening_description !!}</p>
                                <a class="yellow-btn" href="{{ $generals->admission_screening_url }}">Click
                                    Here</a>
                            </div>
                        </div>
                    @endif
                    @if ($generals->mock_test)
                        <div class="col-lg-6">
                            <div class="mock-text-bg"
                                style="background-image: url({{ !empty($generals->mock_test_image) ? Storage::disk('public')->url($generals->mock_test_image) : '../img/microsite/general/about-institute/Artwork.png' }});">
                                <h4>For Free</h4>
                                <h3>Mock Test</h3>
                                <p>{!! $generals->mock_test_description !!}</p>
                                <a class="yellow-btn" href="{{ $generals->mock_test_url }}">Click
                                    Here</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @dd($features); --}}
            @if ($features->count() > 0)
                <div class="m-features mb-5">
                    <h2 class="micro-heading">Features</h2>
                    <hr class="divider">
                    <?php $feature_count = 1;
                    $feature_count_array = [1];
                    ?>
                    @foreach ($features as $key => $feature)
                        @if (in_array($feature_count, $feature_count_array))
                            <div class="features-cards d-flex mt-5">
                        @endif
                        @if ($key % 2 == 0)
                            <div class="card text-center features-card-bg">
                                <img src="{{ Storage::disk('public')->url($feature->info->icon) }}" alt=""
                                    height="43px">
                                <h3>{{ $feature->info->name }}</h3>
                                @if ($feature->info->field_type == 1)
                                    <p>{{ $feature->value == 1 ? 'Yes' : 'No' }}</p>
                                @else
                                    <p>{{ $feature->value }}</p>
                                @endif
                            </div>
                        @else
                            <div class="card text-center">
                                <img src="{{ Storage::disk('public')->url($feature->info->icon) }}" alt=""
                                    height="43px">
                                <h3>{{ $feature->info->name }}</h3>
                                @if ($feature->info->field_type == 1)
                                    <p>{{ $feature->value == 1 ? 'Yes' : 'No' }}</p>
                                @else
                                    <p>{{ $feature->value }} sdf</p>
                                @endif
                            </div>
                        @endif
                        @if ($feature_count % 4 == 0)
                            @php array_push($feature_count_array,$feature_count+1) @endphp
                </div>
            @endif
            @php $feature_count++; @endphp
    @endforeach
</div>
@endif

<!-- -------------------- Leadership --------------------->

@if (!empty($generals->leadership_name))
<div class="m-leadership mt-5 mb-5">
    <h2 class="micro-heading">Leadership</h2>
    <hr class="divider">

    <div class="leadership-box d-flex">
        <div class="co-founder text-center mt-4">
            <img src="{{ !empty($generals->leadership_image) ? Storage::disk('public')->url($generals->leadership_image) : '../assets/skoodos/assets/img/defaultImages/Leadership.jpg' }}"
                alt="">
            <h3>{{ $generals->leadership_name }}</h3>
            <p>{{ $generals->leadership_designation }}</p>
        </div>
        <div class="leadership-text mt-4">
            {!! $generals->leadership_description !!}
        </div>
    </div>
</div>
@endif
{{-- <div class="m-leadership mt-5 mb-5">
    <h2 class="micro-heading">Leadership</h2>
    <hr class="divider">

    <div class="leadership-box d-flex">
        <div class="co-founder text-center mt-4">
            <img src="{{ !empty($generals->leadership_image) ? Storage::disk('public')->url($generals->leadership_image) : '../assets/skoodos/assets/img/defaultImages/Leadership.jpg' }}"
                alt="">
            <h3>{{ $generals->leadership_name }}</h3>
            <p>{{ $generals->leadership_designation }}</p>
        </div>
        <div class="leadership-text mt-4">
            {!! $generals->leadership_description !!}
        </div>
    </div>
</div> --}}
<style>
    .m-features .card {
        margin: 0 3%;
    }
</style>
</div>
@elseif ($mobileResult)
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">

        <!-- ------------- About Institute ---------- -->

        <section class="about-institute-section">
            <div class="container">
                <div class="about-institute">
                    <div class="section--heading sub-heading">
                        <h2>About Institutes</h2>
                    </div>
                    <p>{{ $generals->description }}</p>
                    <div class="about-institute-img-text">
                        <img src="{{ !empty($generals->admission_screening_image) ? Storage::disk('public')->url($generals->admission_screening_image) : '../img/microsite/admsn-1.png' }}"
                            alt="">
                        <div class="about-institute-text">
                            <h3>ADMISSION</h3>
                            <h4>SCREENING </h4>
                            <p>{!! $generals->admission_screening_description !!}</p>
                            <a href="{{ $generals->admission_screening_url }}" class="btn btn-yellow">Click Here</a>
                        </div>
                    </div>
                    <div class="about-institute-img-text">
                        <img src="{{ !empty($generals->mock_test_image) ? Storage::disk('public')->url($generals->mock_test_image) : '../img/microsite/Mock-Test.png' }}"
                            alt="">
                        <div class="about-institute-text">
                            <h3>FOR FREE</h3>
                            <h4>MOCK TEST </h4>
                            <p>{!! $generals->mock_test_description !!} </p>
                            <a href="{{ $generals->mock_test_url }}" class="btn btn-yellow">Click Here</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ------------- About Institute ---------- -->
        @if ($features->count() > 0)
            <div class="microsite-features-section">
                <div class="container">
                    <div class="microsite-features">
                        <div class="section--heading sub-heading">
                            <h2>Features</h2>
                        </div>
                        <div class="row ">
                            @foreach ($features as $key => $feature)
                                <div class="col-4">
                                    <div class="microsite-features__item">
                                        <img src="{{ Storage::disk('public')->url($feature->info->icon) }}"
                                            alt="">
                                        <h3>{{ $feature->info->name }}</h3>
                                        @if ($feature->info->name == 'Founded')
                                            <p>{{ $feature->value == 1 ? 'Yes' : $feature->value }}</p>
                                        @else
                                            <p>{{ $feature->value == 1 ? 'Yes' : 'No' }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <!-- ----------- Leadership -------- -->

        <section class="ledership-card-section">
            <div class="container">
                <div class="leadership__content">
                    <div class="section--heading sub-heading">
                        <h2>Leadership</h2>
                    </div>
                    <div class="row leadership__card mt-5  g-0 ">
                        <div class="col-6">
                            <div class="leadership__card__img">
                                <img src="{{ !empty($generals->leadership_image) ? Storage::disk('public')->url($generals->leadership_image) : '../assets/skoodos/assets/img/microsite/brij.png' }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="leadership__card__text">
                                <h3>{{ $generals->leadership_name }}</h3>
                                <h4>{{ $generals->leadership_designation }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="leadership__card__details">

                        <p>{!! $generals->leadership_description !!} </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
@endif
</div>

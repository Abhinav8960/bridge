<div>
    @if ($desktopResult)

        <section class="top-banner explore-top">
            <div class="container">
                <div class="categories_bg explore-listing-bg"
                    style="background-image: url({{ '/assets/skoodos/assets/img/defaultImages/Search_Leaderboard.jpg' }});">
                    <!-- <div class="col-lg-7">
                    <h1>We are connect with <span>limitless <br> Institutes</span> across India</h1>
                    <div class="row py-3">
                        <div class="col-lg-4 d-flex ">
                            {{-- <img src="/assets/skoodos/assets/img/explore-listing/verify.png" alt="">
                            <p>Verified <br> Listing</p> --}}
                        </div>
                        <div class="col-lg-4 d-flex ">
                            {{-- <img src="/assets/skoodos/assets/img/explore-listing/limitless.png" alt="">
                            <p>Limitless <br> Options</p> --}}
                        </div>
                        <div class="col-lg-4 d-flex ">
                            {{-- <img src="/assets/skoodos/assets/img/explore-listing/experience.png" alt="">
                            <p>Seamless <br> Experience</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                </div> -->
                </div>
            </div>
        </section>

        <main>

            <!-- --------- compare institutes -->

            <section class="institute-compare-sec">
                <div class="container">
                    <div class="row comparerow">


                        <div class="col-lg-12">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="font-size: 1.6rem;display: table-cell;vertical-align: middle;">
                                        <h1 style="font-size: 1.6rem;display: table-cell;vertical-align: middle;">
                                            Institute Comparison
                                        </h1>
                                    </th>
                                    @if ($institute_list)
                                        @foreach ($institute_list as $key => $institute)
                                            <th>
                                                <div class="text-center">
                                                    <a
                                                        href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}">
                                                        <h2>{{ $institute->name }}</h2>
                                                    </a>
                                                    <p><i class="bi bi-geo-alt-fill"></i> {{ $institute->area }},
                                                        {{ $institute->city_name }},
                                                        {{ $institute->state_name }}</p>

                                                    <button type="submit" class="btn btn-main"
                                                        wire:click.prevent="deleteSearch({{ $key }})"
                                                        style="width: 100%;">Remove</button>
                                                </div>
                                            </th>
                                        @endforeach
                                    @endif

                                </tr>
                            </table>
                        </div>



                    </div>
                </div>
            </section>

            @if ($institute_list)

                <section class="comparison-sec">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="{{ count($institute_list) + 1 }}">Key Feature</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>{{ $institute->name }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Streams</td>
                                            @foreach ($institute_list as $key => $institute)
                                                @isset($institute->streams)
                                                    @php $s = ''; @endphp
                                                    <td>
                                                        @foreach ($institute->streams as $key => $streams)
                                                            {{ $s }}{{ $streams->stream->name }}
                                                            @php $s = ', '; @endphp
                                                        @endforeach
                                                    </td>
                                                @endisset
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Area</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    {{ $institute->area }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>City, State</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    {{ $institute->city_name }}, {{ $institute->state_name }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    {{ $institute->mobile }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    {{ $institute->email }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Website</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    @if (!empty($institute->general->website))
                                                        <a href="{{ $institute->general->website }}"
                                                            target="_blank">{{ $institute->general->website }}</a>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Rating</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    <ul class="d-flex rating">
                                                        {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                                    </ul>
                                                </td>
                                            @endforeach

                                        </tr>
                                        <tr>
                                            <td>Admission Screening</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    @if (isset($institute->general->admission_screening))
                                                        {{ 'Yes' }}
                                                    @else
                                                        {{ 'No' }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Mock Tests</td>
                                            @foreach ($institute_list as $key => $institute)
                                                <td>
                                                    @if (isset($institute->general->mock_test))
                                                        {{ 'Yes' }}
                                                    @else
                                                        {{ 'No' }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>


                                        {{-- // Master Feater Loop --}}
                                        @foreach ($masterFeatures as $features)
                                            <tr>
                                                <td>{{ $features->name }}</td>
                                                @foreach ($institute_list as $institute)
                                                    <td>
                                                        @php
                                                            $instiute_feater = App\Models\Institute\Information\InstituteFeature::where('institute_id', $institute->id)
                                                                ->where('features_id', $features->id)
                                                                ->first();
                                                            if ($features->field_type == 2 && $instiute_feater) {
                                                                echo $instiute_feater->value;
                                                            } else {
                                                                if ($instiute_feater) {
                                                                    echo 'Yes';
                                                                } else {
                                                                    echo 'No';
                                                                }
                                                            }

                                                        @endphp
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </main>
    @elseif ($mobileResult)
        @php
            $totalinstitute = count($institute_list);
            $comapareclass = 'col-4';

            if ($totalinstitute == 1) {
                $comapareclass = 'col-12';
            }
            if ($totalinstitute == 2) {
                $comapareclass = 'col-6';
            }
            if ($totalinstitute == 3) {
                $comapareclass = 'col-4';
            }
        @endphp
        <section class="institute-compare-sec">
            <div class="container">
                @if ($institute_list)

                    <div class="row">
                        @foreach ($institute_list as $key => $institute)
                            <div class="{{ $comapareclass }} compare-field ">
                                <div class="institute-compare-box">
                                    <h2>{{ $institute->name }}</h2>
                                    <button type="submit" class="btn btn-main"
                                        wire:click.prevent="deleteSearch({{ $key }})"><i
                                            class="bi
                                    bi-x-lg"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="row compare-list">
                    <div class="col-12">
                        <h2>Key Feature</h2>
                    </div>
                    <div class="col-12">
                        <p>Name</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>{{ $institute->name }}</p>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <p>Streams</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        @isset($institute->streams)
                            @php $s = ''; @endphp
                            <div class="{{ $comapareclass }}">
                                <p>
                                    @foreach ($institute->streams as $key => $streams)
                                        {{ $s }}{{ $streams->stream->name }}
                                        @php $s = ', '; @endphp
                                    @endforeach
                                </p>
                            </div>
                        @endisset
                    @endforeach
                    <div class="col-12">
                        <p>Areas</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>{{ $institute->area }}</p>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <p>City, State</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>{{ $institute->city_name }}, {{ $institute->state_name }}
                            </p>
                        </div>
                    @endforeach

                    <div class="col-12">
                        <p>Phone</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>{{ $institute->mobile }}</p>
                        </div>
                    @endforeach

                    <div class="col-12">
                        <p>Email</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>{{ $institute->email }}</p>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <p>Website</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            @if (!empty($institute->general->website))
                                <a href="{{ $institute->general->website }}"
                                    target="_blank">{{ $institute->general->website }}</a>
                            @endif
                        </div>
                    @endforeach

                    <div class="col-12">
                        <p>Rating</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <ul class="d-flex rating">
                                {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                            </ul>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <p>Admission Screening</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>
                                @if (isset($institute->general->admission_screening))
                                    {{ 'Yes' }}
                                @else
                                    {{ 'No' }}
                                @endif
                            </p>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <p>Mock Tests</p>
                    </div>
                    @foreach ($institute_list as $key => $institute)
                        <div class="{{ $comapareclass }}">
                            <p>
                                @if (isset($institute->general->mock_test))
                                    {{ 'Yes' }}
                                @else
                                    {{ 'No' }}
                                @endif
                            </p>
                        </div>
                    @endforeach
                    @foreach ($masterFeatures as $features)
                        <div class="col-12">
                            <p>{{ $features->name }}</p>
                        </div>
                        @foreach ($institute_list as $institute)
                            <div class="{{ $comapareclass }}">
                                <p> @php
                                    $instiute_feater = App\Models\Institute\Information\InstituteFeature::where('institute_id', $institute->id)
                                        ->where('features_id', $features->id)
                                        ->first();
                                    if ($features->field_type == 2 && $instiute_feater) {
                                        echo $instiute_feater->value;
                                    } else {
                                        if ($instiute_feater) {
                                            echo 'Yes';
                                        } else {
                                            echo 'No';
                                        }
                                    }

                                @endphp</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
@push('styles')

<style>
    .institute-compare-sec .compare-list .col-12,.institute-compare-sec .compare-list .col-6,.institute-compare-sec .compare-list .col-4 {
        border: 1px solid #ddd;
        padding: 14px 10px;
        text-align: center;
    }
</style>
@endpush

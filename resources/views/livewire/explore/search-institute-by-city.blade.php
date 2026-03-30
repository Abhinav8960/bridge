<div>
    @if ($desktopResult)
        <section class="search_cities">
            <div class="container">
                <div class="row align-items-center">
                    {{-- <div class="col-lg-3">
                    <div class="input-group">
                        <i class="bi bi-search"></i>
                        <input type="search" class="form-control" placeholder="Enter Name" id="#">
                    </div>
                </div> --}}
                    <div class="col-lg-12 d-flex align-items-center neraby_cities">
                        <div class="cities-left">
                            <ul class="cities-name justify-content-between align-items-center">

                                @if ($haveUserLoacation)
                                    <li class="nearme-color"><a class="@if (Route::is('explore.institute.nearme')) active @endif"
                                            href="{{ route('explore.institute.nearme', [$rcategory, $rstream, $rexam, \App\Helpers\Helper::SeoUrl(['category' => $rcategory, 'stream' => $rstream, 'exam' => $rexam, 'nearme' => 1])]) }}"><img
                                                src="/assets/skoodos/assets/img/homepage/UpperBanner/location.png"
                                                alt="">Search Coaching Institute Near Me</a></li>
                                @endif


                            </ul>
                        </div>
                        <div class="cities-right">
                            @if ($popularCityOptions->count() > 0)
                                <ul class="cities-name cities-slider justify-content-between align-items-center">
                                    <li>
                                        <a class="@if ($rstate == 0 && $rcity == 0 && $rarea == 0 && !Route::is('explore.institute.nearme')) active @endif"
                                            href="{{ route('explore.institute', [$rcategory, $rstream, $rexam, 0, 0, 0, \App\Helpers\Helper::SeoUrl(['category' => $rcategory, 'stream' => $rstream, 'exam' => $rexam])]) }}">All
                                            India</a>
                                    </li>
                                    @foreach ($popularCityOptions as $option)
                                        <li><a class="@if ($city == $option->city_id) active @endif"
                                                href="{{ route('explore.institute', [$rcategory, $rstream, $rexam, $option->state_id, $option->city_id, \App\Helpers\Helper::NOT_NEEDED, \App\Helpers\Helper::SeoUrl(['category' => $rcategory, 'stream' => $rstream, 'exam' => $rexam, 'state' => $option->state_id, 'city' => $option->city_id, 'area' => 0])]) }}">{{ $option->city_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif ($mobileResult)
        <!-- --------------- Explore Search --------------->

        <section class="explore--search">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control"
                                placeholder="Search For Exams  / Categories / Institutes" wire:model="searchText">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- --------------- End Explore Search --------------->
        <!-- --------------- Popular Search ----------- -->
        @if (!empty($popularsearches))
            <section class="popular--search">
                <div class="container">
                    <div class="section--heading">
                        <h2>Popular Searches</h2>
                    </div>

                    <div class="popular--search__content">
                        <ul>
                            @foreach ($popularsearches as $searches)
                                <a
                                    href="{{ route('explore.institute', [$searches->rcategory, $searches->rstream, $searches->rexam, $searches->rstate, $searches->rcity, \App\Helpers\Helper::NOT_NEEDED, \App\Helpers\Helper::SeoUrl(['category' => $searches->rcategory, 'stream' => $searches->rstream, 'exam' => $searches->rexam, 'state' => $searches->rstate, 'city' => $searches->rcity, 'area' => 0])]) }}">
                                    <li>{{ $searches->search }}
                                        <i class="bi bi-arrow-right"></i>
                                    </li>
                                </a>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </section>
        @endif

        <!-- --------------- Popular Search ----------- -->
    @endif
</div>

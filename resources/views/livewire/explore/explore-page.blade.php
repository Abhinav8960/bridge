<div>
    <main>

        <!-- ---------------- Top Institutes ----------- -->

        <section class="top-institute">
            <div class="container">
                <div class="section--heading">
                    <h2>FIND TOP INSTITUTES IN CITIES</h2>
                </div>
                <div class="row top-institute__cards">
                    <div class="col-6 mb-4">
                        <div class="cards__content">
                            <div class="cards__content__img">
                                <img src="/assets/skoodos/assets/img/explore-listing/img-1.png" alt="">
                            </div>
                            <div class="cards__content__text">
                                <p>Nearby</p>
                            </div>
                        </div>
                    </div>
                    @if (!empty($cities))
                        @foreach ($cities as $city)
                            <div class="col-6 mb-4">
                                <div class="cards__content">
                                    <div class="cards__content__img w-100">
                                        @if (!empty($city->icon))
                                            <img src="{{ Storage::disk('public')->url($city->icon) }}" alt="">
                                        @else
                                            <img src="/assets/skoodos/assets/img/explore/img-2.png" alt="">
                                        @endif
                                    </div>
                                    <div class="cards__content__text">
                                        <p>{{ $city->city_name }}<span>({{ $city->institutes ? count($city->institutes) : '' }})</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>
</div>

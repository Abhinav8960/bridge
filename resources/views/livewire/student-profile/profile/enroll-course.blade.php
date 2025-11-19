<div>
    @if ($desktopResult)
        <div class="tab-pane fade  show active" id="pills-enroll" role="tabpanel" aria-labelledby="pills-enroll-tab">
            <div class="profile-enroll">
                @if (!empty($enrollment))
                    @if ($enrollment->count())
                        @foreach ($enrollment as $enrollment)
                            <div class="profile-enroll-item ">
                                <div class="profile-enroll-item-bg">
                                    <div class="row ">
                                        <div class="col-lg-8">
                                            <h2>{{ $enrollment->course_title }}
                                                ({{ $enrollment->duration }}
                                                months)
                                            </h2>
                                            <h3><span> {{ $enrollment->institute->name }} - </span>
                                                {{ $enrollment->institute->area }},{{ $enrollment->institute->city_name }},{{ $enrollment->institute->state_name }}
                                            </h3>

                                        </div>
                                        <div class="col-lg-4 d-flex align-items-center justify-content-center">
                                            <a href="{{ route('payment.invoice', encrypt($enrollment->payment_request_id)) }}"
                                                target="_blank" class="yellow-btn">Download Invoice</a>
                                        </div>
                                    </div>
                                    <hr class="dashed-line">
                                    <div class="row ">
                                        <div class="col-lg-3  d-flex">
                                            <div class="m-stream-icon">
                                                <img src="/assets/skoodos/assets/img/microsite/caurses/booking.png"
                                                    alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Booking Fee</h4>

                                                <p>Rs. {{ $enrollment->amount_without_tax }}
                                                    @if ($enrollment->tax)
                                                        (+{{ $enrollment->tax->name }}:
                                                        Rs.{{ $enrollment->amount - $enrollment->amount_without_tax }})
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex">
                                            <div class="m-stream-icon">
                                                <img src="/assets/skoodos/assets/img/microsite/caurses/fee.png"
                                                    alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Total Fee</h4>
                                                <p>
                                                    {{-- @dump( $enrollment ) --}}
                                                    @if ($enrollment->course_discount_percentage > 0)
                                                        <span class="strikeout"> Rs:
                                                            {{ $enrollment->course_fees }}</span>
                                                    @endif

                                                    Rs.
                                                    {{ $enrollment->netfees() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  d-flex">
                                            <div class="m-stream-icon">
                                                <img src="/assets/skoodos/assets/img/microsite/caurses/booking.png"
                                                    alt="">
                                            </div>
                                            <div class="m-stream-detail">
                                                <h4>Booking Date</h4>
                                                <p>{{ \Carbon\Carbon::parse($enrollment->booking_date)->format('d M Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        @if ($enrollment->course_discount_percentage > 0)
                                            <div class="col-lg-3  d-flex">
                                                <div class="m-stream-icon-bg">
                                                    <p><span><b>{{ $enrollment->course_discount_percentage }}</b><sup>%</sup></span>
                                                        Discount
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif

            </div>
        </div>
    @elseif($mobileResult)
        <main>

            <!-- ------- Sub Header ----- -->

            <header class="sub-header">
                <div class="container">
                    <div class="row">
                        <a href="{{ route('student.profile') }}"><i class="bi bi-arrow-left"></i>My Enrolled Course</a>
                    </div>
                </div>
            </header>

            <!-- ------- Sub Header ----- -->


            <!-- ---------- Enrolled Courses ---------->
            <section>
                <div class="container">
                    @if (!empty($enrollment))
                        @if ($enrollment->count())
                            @foreach ($enrollment as $enrollment)
                                <div class="enroll-container">
                                    <div class="enroll-card">
                                        <h2>{{ $enrollment->course_title }}
                                            ({{ $enrollment->duration }}
                                            months)
                                        </h2>
                                        <div class="courses-card__icons-text courses-card ">
                                            <div class="m-stream-icon-bg mt-2"
                                                style="background-image: url(/assets/skoodos/assets/img/enroll-discount.png);">
                                                <p><span><b>{{ $enrollment->discount }}</b><sup>%</sup></span>
                                                    Discount
                                                </p>
                                            </div>
                                        </div>
                                        <h3><span> {{ $enrollment->institute->name }} - </span>
                                            {{ $enrollment->institute->area }},{{ $enrollment->institute->city_name }},{{ $enrollment->institute->state_name }}
                                        </h3>
                                        <div class="items mt-4">
                                            <div class="item">
                                                <div class="courses-card__icons-text">
                                                    <img src="/assets/skoodos/assets/img/microsite/caurses/booking.png"
                                                        alt="">
                                                    <h3>Booking Fee</h3>
                                                    <p>Rs. {{ $enrollment->amount }}</p>
                                                </div>
                                                <div class="courses-card__icons-text">
                                                    <img src="/assets/skoodos/assets/img/microsite/caurses/fee.png"
                                                        alt="">
                                                    <h3>Total Fee</h3>

                                                    <p>
                                                        @if ($enrollment->discount > 0)

                                                        <span class="strikeout"> Rs:
                                                            {{ $enrollment->course_fees }}</span>
                                                        @endif
                                                        Rs.
                                                        {{ $enrollment->netfees() }}</p>
                                                </div>
                                                <div class="courses-card__icons-text">
                                                    <img src="/assets/skoodos/assets/img/microsite/caurses/booking.png"
                                                        alt="">
                                                    <h3>Booking Date</h3>
                                                    <p>{{ \Carbon\Carbon::parse($enrollment->booking_date)->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <hr class="dashed-line">
                                            <a href="{{ route('payment.invoice', encrypt($enrollment->payment_request_id)) }}"
                                                class="btn-yellow">Download Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12 text-center">
                                <img src="/assets/skoodos/assets/img/defaultImages/No Results/No-Wishlist.jpg">
                                <h5>No Enrolled Courses Found</h5>
                            </div>
                        @endif
                    @endif
                </div>
            </section>
        </main>
    @endif
</div>

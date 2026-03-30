<div>
    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-centers" role="tabpanel" aria-labelledby="pills-centers-tab">

            <!------------====================== Centers Microsite ==============--------------------  -->

            <div class="m-centers">
                {{-- @dd($center); --}}
                @foreach ($centerOptions as $centeropt)
                    <div class="center-box">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 class="micro-heading">
                                    {{ $centeropt->name() }} -
                                    {{ $centeropt->branch_type == App\Models\Institute\Information\Center::CORPORATE_HEADQUARTER ? 'Corporate Headquarter' : 'Branch' }}
                                </h2>
                                <hr class="divider">
                            </div>
                            @if ($loop->first)
                                <div class="m-dropdown">
                                    @if ($institute->centers->count() > 0)
                                        {{-- @dd($institute->centers); --}}
                                        <select class="form-select select2" aria-label="Default select example"
                                            wire:model="center">
                                            <option value="">Select City</option>
                                            @foreach ($institute->centers as $centercity)
                                                <option value="{{ $centercity->city_id }}">{{ $centercity->city_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="container-box">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 mb-5">
                                            <div class="centers_address d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/location.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details">
                                                    <h3>Address</h3>
                                                    <p>{{ $centeropt->google_business_address }}
                                                    </p>
                                                    <!-- <a class="viewall" href="">Get Directions</a> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="m_center_head d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/company_representative.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details">
                                                    <h3>Centre Head</h3>
                                                    <p>{{ $centeropt->center_head }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="m_center_contact d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/call.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details ">
                                                    <h3>Phone</h3>
                                                    @if ($centeropt->phone_type_1 == 2)
                                                        <a href="tel:{{ $centeropt->phone_number_1 }}">
                                                            <p><img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                                    alt="">
                                                                {{ $centeropt->phone_number_1 }}
                                                            </p>
                                                        </a>
                                                    @endif
                                                    @if ($centeropt->phone_type_2 == 2)
                                                        <a href="tel:{{ $centeropt->phone_number_2 }}">
                                                            <p><img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                                    alt="">
                                                                {{ $centeropt->phone_number_2 }}
                                                            </p>
                                                        </a>
                                                    @endif
                                                    @if ($centeropt->phone_type_1 == 1)
                                                        <a href="tel:{{ $centeropt->phone_number_1 }}">
                                                            <p> <img src="/assets/skoodos/assets/img/Mobile-Icon.png"
                                                                    alt="">
                                                                {{ $centeropt->phone_number_1 }}
                                                            </p>
                                                        </a>
                                                    @endif
                                                    @if ($centeropt->phone_type_2 == 1)
                                                        <a href="tel:{{ $centeropt->phone_number_2 }}">
                                                            <p> <img src="/assets/skoodos/assets/img/Mobile-Icon.png"
                                                                    alt="">
                                                                {{ $centeropt->phone_number_2 }}
                                                            </p>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="m_cp_website d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/Timing_Icon.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details centers-weblink">
                                                    <h3 class="">Timing</h3>
                                                    <table class="table">
                                                        <tr>
                                                            <th class="weeks">Monday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->monday == true ? \Carbon\carbon::parse($centeropt->monday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->monday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="weeks">Tuesday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->tuesday == true ? \Carbon\carbon::parse($centeropt->tuesday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->tuesday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="weeks">Wednesday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->wednesday == true ? \Carbon\carbon::parse($centeropt->wednesday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->wednesday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="weeks">Thursday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->thursday == true ? \Carbon\carbon::parse($centeropt->thursday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->thursday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="weeks">Friday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->friday == true ? \Carbon\carbon::parse($centeropt->friday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->friday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="weeks">Saturday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->saturday == true ? \Carbon\carbon::parse($centeropt->saturday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->saturday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="weeks">Sunday:</th>
                                                            <td class="week">
                                                                {{ $centeropt->sunday == true ? \Carbon\carbon::parse($centeropt->sunday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->sunday_close)->format('g:i A') : 'Close' }}
                                                            </td>
                                                        </tr>
                                                        {{-- <p>Monday:
                                                        {{ $centeropt->monday == true ? \Carbon\carbon::parse($centeropt->monday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->monday_close)->format('g:i A') : 'Close' }}

                                                    </p>
                                                    <p>Tuesday:
                                                        {{ $centeropt->tuesday == true ? \Carbon\carbon::parse($centeropt->tuesday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->tuesday_close)->format('g:i A') : 'Close' }}

                                                    </p>
                                                    <p>Wednesday:
                                                        {{ $centeropt->wednesday == true ? \Carbon\carbon::parse($centeropt->wednesday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->wednesday_close)->format('g:i A') : 'Close' }}

                                                    </p>
                                                    <p>Thursday:
                                                        {{ $centeropt->thursday == true ? \Carbon\carbon::parse($centeropt->thursday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->thursday_close)->format('g:i A') : 'Close' }}
                                                    </p>
                                                    <p>Friday:
                                                        {{ $centeropt->friday == true ? \Carbon\carbon::parse($centeropt->friday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->friday_close)->format('g:i A') : 'Close' }}
                                                    </p>
                                                    <p>Saturday:
                                                        {{ $centeropt->saturday == true ? \Carbon\carbon::parse($centeropt->saturday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->saturday_close)->format('g:i A') : 'Close' }}
                                                    </p>
                                                    <p>Sunday:
                                                        {{ $centeropt->sunday == true ? \Carbon\carbon::parse($centeropt->sunday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->sunday_close)->format('g:i A') : 'Close' }}
                                                    </p> --}}
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="m_center_email d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/mail.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details">
                                                    <h3>Email</h3>
                                                    <a href="mailto:{{ $centeropt->email_1 }}">
                                                        <p>{{ $centeropt->email_1 }}</p>
                                                    </a>
                                                    <a href="mailto:{{ $centeropt->email_2 }}">
                                                        <p>{{ $centeropt->email_2 }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="m_center_icon d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/social.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details">
                                                    <h3>Social Links</h3>
                                                    <div class="centers_social">
                                                        <ul class="centers_social_links">
                                                            @if (!empty($centeropt->facebook_url))
                                                                <li><a href="{{ $centeropt->facebook_url }}"
                                                                        class="facebook"><i
                                                                            class="bi bi-facebook"></i></a>
                                                                </li>
                                                            @endif
                                                            @if (!empty($centeropt->instagram_url))
                                                                <li><a href="{{ $centeropt->instagram_url }}"
                                                                        class="instagram"><i
                                                                            class="bi bi-instagram"></i></a></li>
                                                            @endif

                                                            @if (!empty($centeropt->youtube_url))
                                                                <li><a href="{{ $centeropt->youtube_url }}"
                                                                        class="youtube"><i
                                                                            class="bi bi-youtube"></i></a>
                                                                </li>
                                                            @endif
                                                            @if (!empty($centeropt->linkedin_url))
                                                                <li><a href="{{ $centeropt->linkedin_url }}"
                                                                        class="linkedin"><i
                                                                            class="bi bi-linkedin"></i></a>
                                                                </li>
                                                            @endif
                                                            @if (!empty($centeropt->twitter_url))
                                                                <li><a href="{{ $centeropt->twitter_url }}"
                                                                        class="twitter"><i
                                                                            class="bi bi-twitter"></i></a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="microsite_centers_details microsite_map">
                                        <h3>Google Direction</h3>
                                        <iframe
                                            src="https://maps.google.com/maps?q={{ $centeropt->latitude }},{{ $centeropt->longitude }}&hl=es;z=14&amp;output=embed"></iframe>

                                        {{-- <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14035.34429624174!2d77.107557!3d28.4242028!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x66f70b002eba8467!2sSkoodos!5e0!3m2!1sen!2sin!4v1655530858269!5m2!1sen!2sin"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- ------------------------- Center ---------------------- -->

        <div class="tab-pane  fade show active" id="pills-centers" role="tabpanel"
            aria-labelledby="pills-centers-tab">

            <div class="centers-dropdown m-dropdown text-center">
                @if ($institute->centers->count() > 0)
                    <select class="form-select select2" aria-label="Default select example" wire:model="center">
                        <option value="">Select City</option>
                        @foreach ($institute->centers as $centercity)
                            <option value="{{ $centercity->city_id }}">{{ $centercity->city_name }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>


            @foreach ($centerOptions as $centeropt)
                <section class="centers-section">
                    <div class="container">
                        <div class="microstite-container">
                            <div class="section--heading sub-heading">
                                <h2>{{ $centeropt->name() }}-
                                    {{ $centeropt->branch_type == App\Models\Institute\Information\Center::CORPORATE_HEADQUARTER ? 'Corporate Headquarter' : 'Branch' }}
                                </h2>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/location.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Address</h3>
                                            <p>{{ $centeropt->google_business_address }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/company_representative.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Centre Head</h3>
                                            <p>{{ $centeropt->center_head }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/microsite/telephone.png "
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Phone</h3>
                                            @if ($centeropt->phone_type_1 == 2)
                                                <a href="tel:{{ $centeropt->phone_number_1 }}" class="d-flex gap-2">
                                                    <p><img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                            alt="">
                                                        {{ $centeropt->phone_number_1 }}
                                                    </p>
                                                </a>
                                            @endif
                                            @if ($centeropt->phone_type_2 == 2)
                                                <a href="tel:{{ $centeropt->phone_number_2 }}" class="d-flex gap-2">
                                                    <p><img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                            alt="">
                                                        {{ $centeropt->phone_number_2 }}
                                                    </p>
                                                </a>
                                            @endif
                                            @if ($centeropt->phone_type_1 == 1)
                                                <a href="tel:{{ $centeropt->phone_number_1 }}" class="d-flex gap-2">
                                                    <p> <img src="/assets/skoodos/assets/img/Mobile-Icon.png"
                                                            alt="">
                                                        {{ $centeropt->phone_number_1 }}
                                                    </p>
                                                </a>
                                            @endif
                                            @if ($centeropt->phone_type_2 == 1)
                                                <a href="tel:{{ $centeropt->phone_number_2 }}" class="d-flex gap-2">
                                                    <p> <img src="/assets/skoodos/assets/img/Mobile-Icon.png"
                                                            alt="">
                                                        {{ $centeropt->phone_number_2 }}
                                                    </p>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/Timing_Icon.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Timing</h3>
                                            <p>Monday - Saturday: <br>
                                                10 AM to 8 PM
                                            </p>
                                            <p>Sunday: <br>
                                                {{ $centeropt->sunday == true ? \Carbon\carbon::parse($centeropt->sunday_open)->format('g:i A') . ' To ' . \Carbon\carbon::parse($centeropt->sunday_close)->format('g:i A') : 'Close' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/mail.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Email</h3>
                                            <a href="mailto:www.info{{ '@' . $centeropt->email_1 }}">
                                                <p>info{{ '@' . $centeropt->email_1 }}</p>
                                            </a>
                                            <a href="mailto:www.mailto{{ '@' . $centeropt->email_2 }}">
                                                <p>mailto{{ '@' . $centeropt->email_2 }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/social.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Social Links</h3>
                                            <ul class="center-content__social-icon">
                                                <li><a href="{{ $centeropt->facebook_url }}" class="facebook"><i
                                                            class="bi bi-facebook"></i></a>
                                                </li>
                                                <li><a href="{{ $centeropt->instagram_url }}" class="instagram"><i
                                                            class="bi bi-instagram"></i></a></li>
                                                <li><a href="{{ $centeropt->youtube_url }}" class="youtube"><i
                                                            class="bi bi-youtube"></i></a>
                                                </li>
                                                <li><a href="{{ $centeropt->linkedin_url }}" class="linkedin"><i
                                                            class="bi bi-linkedin"></i></a>
                                                </li>
                                                <li><a href="{{ $centeropt->twitter_url }}" class="twitter"><i
                                                            class="bi bi-twitter"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 center-content">
                                    <iframe
                                        src="https://maps.google.com/maps?q={{ $centeropt->latitude }},{{ $centeropt->longitude }}&hl=es;z=14&amp;output=embed"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>


                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <!-- ------------------------- Center ---------------------- -->
    @endif
</div>
<style>
    .week {
        width: 100% !important;
        border: none;
    }

    .weeks {
        border: none;
    }
</style>

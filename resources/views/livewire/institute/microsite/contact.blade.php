<div>
    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

            <!--------------------------------------- Contacts ------------------------------->
            <div class="m-contact mt-5">
                <h2 class="micro-heading">Direct Query</h2>

                <hr class="divider">
                @include('layouts.flash-message')
                <form method="post" wire:submit.prevent="submit">
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" wire:model="name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputNumber" class="form-label">Phone</label>
                                <input type="text" maxlength="10" class="form-control" id="phone"
                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                    onpaste="return false" required="" wire:model="phone">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    wire:model="email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 form-grup">
                                <label for="exampleFormControlsubject" class="form-label">Subject</label>
                                <select class="form-select" aria-label="Default select example" wire:model="subject">
                                    <option selected="" value="">------------</option>
                                    <option value="ENTRANCE EXAMS">ENTRANCE EXAMS</option>
                                    <option value="GOVERNMENT EXAMS">GOVERNMENT EXAMS</option>
                                    <option value="FOREIGN LANGUAGE EXAMS">FOREIGN LANGUAGE EXAMS</option>
                                </select>
                                @error('subject')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Query</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" wire:model="mesaage"></textarea>
                                @error('mesaage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3" wire:ignore>
                            {!! NoCaptcha::display(['data-callback' => 'onCallback']) !!}

                        </div> --}}
                            @error('recaptcha')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="yellow-btn contact---yellow-btn float-end">Submit</button>
                        </div>
                    </div>
                </form>
                @if (!empty($corporateOffice))

                    <div class="contact-center mt-5">
                        <h2 class="micro-heading">Corporate Office</h2>
                        <hr class="divider">
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
                                                    <p>{{ $corporateOffice->address }}</p>
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
                                                    <p>{{ $corporateOffice->center_head }}</p>
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
                                                    @if (!empty($corporateOffice->phone_number_1))
                                                        <a href="tel:{{ $corporateOffice->phone_number_1 }}">
                                                            <p><img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                                    alt="">
                                                                {{ $corporateOffice->phone_number_1 }}
                                                            </p>
                                                        </a>
                                                    @endif
                                                    @if (!empty($corporateOffice->phone_number_2))
                                                        <a href="tel:{{ $corporateOffice->phone_number_2 }}">
                                                            <p> <img src="/assets/skoodos/assets/img/Mobile-Icon.png"
                                                                    alt="">
                                                                {{ $corporateOffice->phone_number_2 }}
                                                            </p>
                                                        </a>
                                                    @endif
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
                                                    @if (!empty($corporateOffice->email_1))
                                                        <a href="mailto:{{ $corporateOffice->email_1 }}">
                                                            <p>{{ $corporateOffice->email_1 }}</p>
                                                        </a>
                                                    @endif
                                                    @if (!empty($corporateOffice->email_2))
                                                        <a href="mailto:{{ $corporateOffice->email_2 }}">
                                                            <p>{{ $corporateOffice->email_2 }}</p>
                                                        </a>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="m_cp_website d-flex">
                                                <div class="center_contact_icon">
                                                    <img src="/assets/skoodos/assets/img/Social-location-icons/website.png"
                                                        alt="">
                                                </div>
                                                <div class="microsite_centers_details centers-weblink">
                                                    <h3 class="">Website</h3>
                                                    <a href="{{ $corporateOffice->institute->general->website }}"
                                                        target="_blank">{{ $corporateOffice->institute->general->website }}</a>
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
                                                            @if (!empty($corporateOffice->facebook_url))
                                                                <li><a href="{{ $corporateOffice->facebook_url }}"
                                                                        target="_blank" class="facebook"><i
                                                                            class="bi bi-facebook"></i></a></li>
                                                            @endif
                                                            @if (!empty($corporateOffice->instagram_url))
                                                                <li><a href="{{ $corporateOffice->instagram_url }}"
                                                                        target="_blank" class="instagram"><i
                                                                            class="bi bi-instagram"></i></a></li>
                                                            @endif
                                                            @if (!empty($corporateOffice->youtube_url))
                                                                <li><a href="{{ $corporateOffice->youtube_url }}"
                                                                        target="_blank" class="youtube"><i
                                                                            class="bi bi-youtube"></i></a></li>
                                                            @endif
                                                            @if (!empty($corporateOffice->linkedin_url))
                                                                <li><a href="{{ $corporateOffice->linkedin_url }}"
                                                                        target="_blank" class="linkedin"><i
                                                                            class="bi bi-linkedin"></i></a></li>
                                                            @endif
                                                            @if (!empty($corporateOffice->twitter_url))
                                                                <li><a href="{{ $corporateOffice->twitter_url }}"
                                                                        target="_blank" class="twitter"><i
                                                                            class="bi bi-twitter"></i></a></li>
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
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14035.34429624174!2d77.107557!3d28.4242028!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x66f70b002eba8467!2sSkoodos!5e0!3m2!1sen!2sin!4v1655530858269!5m2!1sen!2sin"
                                            style="border:0;" allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- ----------------------- Contact --------------- -->

        <div class="tab-pane fade show active" id="pills-contact" role="tabpanel"
            aria-labelledby="pills-contact-tab">

            <section class="contact-section">
                <div class="container">
                    <div class="section--heading sub-heading">
                        <h2>Direct Query</h2>
                    </div>
                    @include('layouts.flash-message')

                    <form method="post" wire:submit.prevent="submit">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                wire:model="name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input type="text" class="form-control" id="exampleInputName" placeholder="Name"> --}}
                        </div>
                        <div class="mb-3">
                            <input type="text" maxlength="10" class="form-control" id="phone"
                                onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                onpaste="return false" required="" placeholder="Phone" wire:model="phone">
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input type="text" class="form-control" id="exampleInputPhone" placeholder="Phone"> --}}
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="Email" wire:model="email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email"> --}}
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" wire:model="subject">
                                <option selected="" value="">Subject</option>
                                <option value="ENTRANCE EXAMS">ENTRANCE EXAMS</option>
                                <option value="GOVERNMENT EXAMS">GOVERNMENT EXAMS</option>
                                <option value="FOREIGN LANGUAGE EXAMS">FOREIGN LANGUAGE EXAMS</option>
                            </select>
                            @error('subject')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Query"
                                wire:model="mesaage"></textarea>
                            @error('mesaage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Query"></textarea> --}}
                        </div>
                        @error('recaptcha')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn-yellow" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- ----------------------- Contact --------------- -->
            @if (!empty($corporateOffice))
                <section class="centers-section contact-center-section">
                    <div class="container">
                        <div class="microstite-container">
                            <div class="section--heading sub-heading">
                                <h2>Corporate Office</h2>
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
                                            <p>{{ $corporateOffice->address }}</p>
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
                                            <p>{{ $corporateOffice->center_head }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/call.png "
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Phone</h3>
                                            @if (!empty($corporateOffice->phone_number_1))
                                                <a href="tel:{{ $corporateOffice->phone_number_1 }}"
                                                    class="d-flex gap-2">
                                                    <p><img src="/assets/skoodos/assets/img/Landline_Icon.png"
                                                            alt="">
                                                        {{ $corporateOffice->phone_number_1 }}
                                                    </p>
                                                </a>
                                            @endif
                                            @if (!empty($corporateOffice->phone_number_2))
                                                <a href="tel:{{ $corporateOffice->phone_number_2 }}"
                                                    class="d-flex gap-2">
                                                    <p> <img src="/assets/skoodos/assets/img/Mobile-Icon.png"
                                                            alt="">
                                                        {{ $corporateOffice->phone_number_2 }}
                                                    </p>
                                                </a>
                                            @endif
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
                                            @if (!empty($corporateOffice->email_1))
                                                <a href="mailto:{{ $corporateOffice->email_1 }}">
                                                    <p>{{ $corporateOffice->email_1 }}</p>
                                                </a>
                                            @endif
                                            @if (!empty($corporateOffice->email_2))
                                                <a href="mailto:{{ $corporateOffice->email_2 }}">
                                                    <p>{{ $corporateOffice->email_2 }}</p>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/website.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Website</h3>
                                            <a href="{{ $corporateOffice->institute->general->website }}"
                                                target="_blank">
                                                <p>{{ $corporateOffice->institute->general->website }}</p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="center-content">
                                        <div class="center-content__icon">
                                            <img src="/assets/skoodos/assets/img/Social-location-icons/social.png"
                                                alt="">
                                        </div>
                                        <div class="center-content__text">
                                            <h3>Social Links</h3>
                                            <ul class="center-content__social-icon">
                                                @if (!empty($corporateOffice->facebook_url))
                                                    <li><a href="{{ $corporateOffice->facebook_url }}"
                                                            target="_blank" class="facebook"><i
                                                                class="bi bi-facebook"></i></a></li>
                                                @endif
                                                @if (!empty($corporateOffice->instagram_url))
                                                    <li><a href="{{ $corporateOffice->instagram_url }}"
                                                            target="_blank" class="instagram"><i
                                                                class="bi bi-instagram"></i></a></li>
                                                @endif
                                                @if (!empty($corporateOffice->youtube_url))
                                                    <li><a href="{{ $corporateOffice->youtube_url }}" target="_blank"
                                                            class="youtube"><i class="bi bi-youtube"></i></a></li>
                                                @endif
                                                @if (!empty($corporateOffice->linkedin_url))
                                                    <li><a href="{{ $corporateOffice->linkedin_url }}"
                                                            target="_blank" class="linkedin"><i
                                                                class="bi bi-linkedin"></i></a></li>
                                                @endif
                                                @if (!empty($corporateOffice->twitter_url))
                                                    <li><a href="{{ $corporateOffice->twitter_url }}" target="_blank"
                                                            class="twitter"><i class="bi bi-twitter"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 center-content">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14035.34429624174!2d77.107557!3d28.4242028!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x66f70b002eba8467!2sSkoodos!5e0!3m2!1sen!2sin!4v1655530858269!5m2!1sen!2sin"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    @endif
    <!--------------------------------------- End Contacts ---------------------------->
</div>
{{-- {!! NoCaptcha::renderJs() !!}
@push('scripts')

    <script type="text/javascript">
        var onCallback = function() {
            @this.set('recaptcha', grecaptcha.getResponse());
        };
    </script>
@endpush --}}

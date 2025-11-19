<div>
    {{-- @dump($generalTab, $galleryTab, $coursesTab, $championsTab, $facultyTab, $centersTab, $videosTab, $reviewTab, $alumniTab, $contactTab)
    @dump('chnages') --}}
    @if ($visibility == true)
        @if ($coursesTab)
            <?php $name = 'Courses'; ?>
        @elseif ($generalTab)
            <?php $name = 'General'; ?>
        @elseif ($championsTab)
            <?php $name = 'Champions'; ?>
        @elseif ($videosTab)
            <?php $name = 'Videos'; ?>
        @elseif ($facultyTab)
            <?php $name = 'Faculty'; ?>
        @elseif ($centersTab)
            <?php $name = 'Centers'; ?>
        @elseif ($reviewTab)
            <?php $name = 'Reviews'; ?>
        @elseif ($galleryTab)
            <?php $name = 'Gallery'; ?>
        @elseif ($alumniTab)
            <?php $name = 'Alumni'; ?>
        @elseif ($contactTab)
            <?php $name = 'Contact'; ?>
        @endif

        <!-- ------- Sub Header ----- -->

        <!-- ------------ Broucher Card ------------- -->
        @if ($coursesTab || $videosTab)
        @else
            <header class="sub-header">
                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <a href="/"><i class="bi bi-arrow-left"></i> Microsite: {{ $name }}</a>
                            <div class="d-flex gap-4">
                                {{-- @if (Route::is('configuration.*')) --}}
                                @if ($coursesTab || $videosTab)
                                    <a href="microsite.html" wire:click="showMobileFilter()" data-bs-toggle="modal"
                                        data-bs-target="#microsite-filter"><i class="bi bi-funnel-fill"></i></a>
                                    {{-- <a wire:click="showMobileFilter()" data-bs-toggle="modal"
                                    data-bs-target="#microsite-filter"><i class="bi bi-funnel-fill"></i></a> --}}
                                @endif
                                <a href="" data-bs-toggle="modal" data-bs-target="#microsite-option-model"><img
                                        src="/assets/skoodos/assets/img/microsite/Menu.png" alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>
        @endif
        @if ($coursesTab || $videosTab)
        @else
            <section class="broucher-section">
                <div class="container">
                    <div class="broucher-card">
                        <img src="/assets/skoodos/assets/img/explore-listing/recommended.png" alt=""
                            class="recomended">
                        <div class="institute-details">
                            <div class="institute-img" style="display: flex;align-items:center;justify-content:center;">
                                <img src="{{ !empty($uploads->logo) ? Storage::disk('public')->url($uploads->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                    alt="">
                                @if (empty($uploads->logo))
                                    <div style="position:absolute; text-align:center;">
                                        <h2 style="font-size: 20px; font-weight:bold;">
                                            {{ $institute->nickname() }}

                                        </h2>
                                    </div>
                                @endif
                            </div>
                            <div class="institute-text">
                                @student
                                    @if ($isWishlited)
                                        <a style="cursor: pointer;"
                                            wire:click="removefromwishlist({{ $institute->id }})"><img
                                                src="/assets/skoodos/assets/img/Wishlist-Icon-a.png" alt=""></a>

                                        @if ($confirmNow)
                                            <div class="modal fade modal-splash show" id="staticBackdrop"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog"
                                                style="display: block;">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="modal-title" id="staticBackdropLabel">
                                                                <div class="row">
                                                                    {{-- <div class="col-lg-3">
                                                                        <img src="/assets/skoodos/assets/img/modal-logo.png"
                                                                            alt="">
                                                                    </div> --}}
                                                                    <div class="col-lg-9">
                                                                        <h5>Remove From Wishlist</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                                wire:click="ConfirmNewModelClose()"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-splash-text">
                                                                <p class="d-flex">
                                                                    Are you sure you want to delete {{ $institute->name }}
                                                                    from
                                                                    your wishlist?
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="model-footer text-center p-2 ">

                                                            <button type="button" class="btn yellow-btn mx-2"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                wire:click="removeinstitteFroWishlistAgree()">Yes</button>
                                                            <button type="button" class="btn yellow-btn mx-2"
                                                                wire:click="ConfirmNewModelClose()">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-backdrop fade show"></div>
                                        @endif
                                    @else
                                        <a style="cursor: pointer;" wire:click="wishlistnow({{ $institute->id }})"><img
                                                src="/assets/skoodos/assets/img/microsite/WishList.png" alt=""></a>
                                    @endif
                                @endstudent
                                {{-- <img src="/assets/skoodos/assets/img/microsite/WishList.png" alt=""> --}}
                                <h2>{{ !empty($institute->name) ? $institute->name : '' }}</h2>
                                <ul class="rating">
                                    {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}
                                </ul>
                                <ul class="broucher-card-text">
                                    <li><span><i class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                        {{ $institute->city_name }}, {{ $institute->state_name }}
                                    </li>
                                    <li><span><i class="bi bi-telephone-fill"></i></span>+91
                                        {{ $institute->general->phone_number_1 }}
                                    </li>
                                    <li><span><i
                                                class="bi bi-envelope-fill"></i></span>{{ $institute->general->email_1 }}
                                        @if (!empty($institute->general->email_2))
                                            , {{ $institute->general->email_2 }}
                                        @endif
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="broucher-btn">
                            @if (!empty($uploads->corporate_brochure))
                                <a class="blue-btn mt-2"
                                    href="{{ Storage::disk('public')->url($uploads->corporate_brochure) }}"
                                    target="_blank">Download Brochure</a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <div class="tab-content" id="pills-tabContent">


            @if ($generalTab)
                {{-- general --}}
                @livewire('institute.microsite.general', ['institute' => $institute])

                <!--------------=================== End General Microsite ==================----------  -->
            @endif
            @if ($championsTab)
                {{-- champion --}}
                @livewire('institute.microsite.champions', ['institute' => $institute])
                <!------------====================== End Champions Microsite ==============--------------------  -->
            @endif

            @if ($facultyTab)
                {{-- Faculty --}}
                @livewire('institute.microsite.faculty', ['institute' => $institute])
                <!------------====================== End Faculty Microsite ==============--------------------  -->
            @endif

            @if ($centersTab)
                {{-- centers --}}
                @livewire('institute.microsite.centers', ['institute' => $institute])
                <!------------====================== End Centers Microsite ==============--------------------  -->
            @endif

            @if ($videosTab)
                {{-- Videos --}}
                @livewire('institute.microsite.videos', ['institute' => $institute])
                <!------------====================== End Videos Microsite ==============--------------------  -->
            @endif

            @if ($reviewTab)
                {{-- Videos --}}
                @livewire('institute.microsite.review', ['institute' => $institute])
                <!------------====================== End Videos Microsite ==============--------------------  -->
            @endif
            @if ($galleryTab)
                {{-- gallery --}}
                @livewire('institute.microsite.gallery', ['institute' => $institute])
                <!------------====================== End gallery Microsite ==============--------------------  -->
            @endif

            @if ($alumniTab)
                {{-- gallery --}}
                @livewire('institute.microsite.alumni', ['institute' => $institute])
                <!------------====================== End gallery Microsite ==============--------------------  -->
            @endif

            @if ($coursesTab)
                {{-- courses --}}
                @livewire('institute.microsite.courses', ['institute' => $institute])
                <!------------====================== End courses Microsite ==============--------------------  -->
            @endif

            @if ($contactTab)
                {{-- courses --}}
                @livewire('institute.microsite.contact', ['institute' => $institute])
                <!------------====================== End courses Microsite ==============--------------------  -->
            @endif

        </div>
        </main>

        <!-- -------- Microsite Options Modal ----->

        <div class="modal fade microsite-option" id="microsite-option-model" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" style="font-size: 29px;">Microsite</a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @if ($institute->package->is_showing_general && $institute->is_showing_general)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($generalTab) active @endif"
                                        id="pills-general-tab" data-bs-toggle="pill" data-bs-target="#pills-general"
                                        type="button" role="tab" aria-controls="pills-general"
                                        aria-selected="true" wire:click="GeneralShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/General.png"
                                                alt="">General</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif

                            @if ($institute->package->is_showing_uploads && $institute->is_showing_uploads)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link  @if ($galleryTab) active @endif"
                                        id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery"
                                        type="button" role="tab" aria-controls="pills-gallery"
                                        aria-selected="true" wire:click="GalleryShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/gallery.png"
                                                alt="">Gallery</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif
                            @if ($institute->package->is_showing_courses && $institute->is_showing_courses)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link  @if ($coursesTab) active @endif"
                                        id="pills-courses-tab" data-bs-toggle="pill" data-bs-target="#pills-courses"
                                        type="button" role="tab" aria-controls="pills-courses"
                                        aria-selected="false" wire:click="CoursesShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Courses.png"
                                                alt="">Courses</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif
                            @if ($institute->package->is_showing_champions && $institute->is_showing_champions)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($championsTab) active @endif"
                                        id="pills-champions-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-champions" type="button" role="tab"
                                        aria-controls="pills-champions" aria-selected="false"
                                        wire:click="ChampionsShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Icon-Champion.png"
                                                alt="">Champions</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif

                            @if ($institute->package->is_showing_faculty && $institute->is_showing_faculty)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($facultyTab) active @endif"
                                        id="pills-faculty-tab" data-bs-toggle="pill" data-bs-target="#pills-faculty"
                                        type="button" role="tab" aria-controls="pills-faculty"
                                        aria-selected="false" wire:click="FacultyShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Faculty.png"
                                                alt="">Faculty</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif
                            @if ($institute->package->is_showing_centers && $institute->is_showing_centers)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link  @if ($centersTab) active @endif"
                                        id="pills-centers-tab" data-bs-toggle="pill" data-bs-target="#pills-centers"
                                        type="button" role="tab" aria-controls="pills-centers"
                                        aria-selected="false" wire:click="CentersShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Centres.png"
                                                alt="">Centers</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif

                            @if ($institute->package->is_showing_videos && $institute->is_showing_videos)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($videosTab) active @endif"
                                        id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos"
                                        type="button" role="tab" aria-controls="pills-videos"
                                        aria-selected="false" wire:click="VideosShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Videos.png"
                                                alt="">Videos</span><i class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif

                            @if ($institute->package->is_showing_review)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($reviewTab) active @endif"
                                        id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews"
                                        type="button" role="tab" aria-controls="pills-reviews"
                                        aria-selected="false" wire:click="ReviewShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Reviews.png"
                                                alt="">Reviews</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif

                            @if ($institute->package->is_showing_alumni && $institute->is_showing_alumni)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link  @if ($alumniTab) active @endif"
                                        id="pills-alumni-tab" data-bs-toggle="pill" data-bs-target="#pills-alumni"
                                        type="button" role="tab" aria-controls="pills-alumni"
                                        aria-selected="false" wire:click="AlumniShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Alumni.png"
                                                alt="">Alumni</span><i class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif

                            @if ($institute->package->is_showing_contact)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if ($contactTab) active @endif"
                                        id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                                        type="button" role="tab" aria-controls="pills-contact"
                                        aria-selected="false" wire:click="ContactShowNow()"><span>
                                            <img src="/assets/skoodos/assets/img/microsite/Contact.png"
                                                alt="">Contact</span><i
                                            class="bi bi-arrow-right"></i></button>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- -------- End Microsite Options Modal ----->

        <!-- --------------- Modal Filter----------->

        <div class="modal fade filter_modal" id="microsite-filter" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="/" class="modal-title" id="staticBackdropLabel"><img
                                src="/assets/skoodos/assets/img/back_btn.png" alt=""><span>Filters</span></a>
                        <a href="">Apply</a>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="filter-location">
                                <div class="accordion" id="accordionExample">

                                    <!-- ------ Exam Category  ---- -->

                                    <div class="select-stream">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">Exam Category </h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For Exam Category">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row filters mt-3">
                                                        <div class="col-6">
                                                            <a class="active" href="javascript:void(0)">CAT 2023
                                                                FULL
                                                                COURSE</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="javascript:void(0)">CAT 2021 + ADVANCE
                                                                COURSE</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="filter_bar">

                                    <!------ Exam Stream ------>

                                    <div class="filter_cat">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFive">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="false" aria-controls="collapseFive">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">Exam Stream</h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseFive" class="accordion-collapse collapse"
                                                aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For Exam Stream">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row filters text-center mt-3">
                                                        <div class="col-6">
                                                            <a href="javascript:void(0)">Management</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a class="active"
                                                                href="javascript:void(0)">Engeneering</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="filter_bar">

                                    <!----------============= Exams =================---------- -->

                                    <div class="select-exam">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSix">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                    aria-expanded="false" aria-controls="collapseSix">
                                                    <div class="filter-header">
                                                        <h2 class="m-heading">Exam</h2>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseSix" class="accordion-collapse collapse"
                                                aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-xs-12">
                                                            <div class="search">
                                                                <i class="bi bi-geo-alt"></i>
                                                                <input type="search" class="form-control"
                                                                    placeholder="Search For Exam">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" row filters mt-3">
                                                        <div class="col-6">
                                                            <a class="active" href="javascript:void(0)">CAT</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="javascript:void(0)">XAT</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="javascript:void(0)">SNAP</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="filter_bar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endif
    <style>
        .yellow-btn {
            background-color: #d0de29 !important;
            color: var(--primary) !important;
            padding: 6px 58px;
            border-radius: 6px;
            font-size: 16px;
            display: inline-block;
            border: 1px solid var(--yellow);
        }
    </style>
</div>
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

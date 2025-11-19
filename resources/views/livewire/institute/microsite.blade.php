<div>
    @section('title')
        {{ $institute->name }}
    @endsection
    @section('description')
        {{ strip_tags($institute->general->description ?? '') }}
    @endsection
    @section('og')
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta property="og:title" content="{{ $institute->name }}" />
        <meta property="og:description" content="{{ strip_tags($institute->general->description ?? '') }}" />
        <meta property="og:image"
            content="{{ !empty($uploads->leaderboard) ? Storage::disk('public')->url($uploads->leaderboard) : env('APP_URL') . '/assets/skoodos/assets/img/defaultImages/Institute_LeaderBoard.jpg' }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website">
        <meta property="og:updated_time" content="{{ strtotime($institute->updated_at) }}" />
    @endsection()
    @if ($visibility == true)
        <section class="top-banner">
            <div class="container">
                <div class="categories_bg microsite-bg"
                    style="background-image: url({{ !empty($uploads->leaderboard) ? Storage::disk('public')->url($uploads->leaderboard) : '../assets/skoodos/assets/img/defaultImages/Institute_LeaderBoard.jpg' }});">
                    <div class="col-lg-12 d-flex"
                        style="width: 100%; height:100%; justify-content: center; align-items: center;">
                        @if (empty($uploads->leaderboard))
                            <h2 style="font-size: 70px; font-weight:bold;">{{ $institute->name }}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- --------- Breadcrumbs ---------- -->
        <div id="breadcrumbs">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('explore.institute', ['rcategory' => \App\Helpers\Helper::NOT_NEEDED, 'rstream' => \App\Helpers\Helper::NOT_NEEDED, 'rexam' => \App\Helpers\Helper::NOT_NEEDED, 'rstate' => $institute->state_id, 'rcity' => \App\Helpers\Helper::NOT_NEEDED, 'rarea' => \App\Helpers\Helper::NOT_NEEDED, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => \App\Helpers\Helper::NOT_NEEDED, 'stream' => \App\Helpers\Helper::NOT_NEEDED, 'exam' => \App\Helpers\Helper::NOT_NEEDED, 'state' => $institute->state_id, 'city' => \App\Helpers\Helper::NOT_NEEDED, 'area' => \App\Helpers\Helper::NOT_NEEDED])]) }}">{{ $institute->state_name }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('explore.institute', ['rcategory' => \App\Helpers\Helper::NOT_NEEDED, 'rstream' => \App\Helpers\Helper::NOT_NEEDED, 'rexam' => \App\Helpers\Helper::NOT_NEEDED, 'rstate' => $institute->state_id, 'rcity' => $institute->city_id, 'rarea' => \App\Helpers\Helper::NOT_NEEDED, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => \App\Helpers\Helper::NOT_NEEDED, 'stream' => \App\Helpers\Helper::NOT_NEEDED, 'exam' => \App\Helpers\Helper::NOT_NEEDED, 'state' => $institute->state_id, 'city' => $institute->city_id, 'area' => \App\Helpers\Helper::NOT_NEEDED])]) }}">{{ $institute->city_name }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('explore.institute', ['rcategory' => \App\Helpers\Helper::NOT_NEEDED, 'rstream' => \App\Helpers\Helper::NOT_NEEDED, 'rexam' => \App\Helpers\Helper::NOT_NEEDED, 'rstate' => $institute->state_id, 'rcity' => $institute->city_id, 'rarea' => $institute->area_id, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => \App\Helpers\Helper::NOT_NEEDED, 'stream' => \App\Helpers\Helper::NOT_NEEDED, 'exam' => \App\Helpers\Helper::NOT_NEEDED, 'state' => $institute->state_id, 'city' => $institute->city_id, 'area' => $institute->area_id])]) }}">{{ $institute->area }}</a>
                        </li>
                        {{-- <li class="breadcrumb-item"><a href="#">Coaching Institute</a></li> --}}
                        {{-- <li class="breadcrumb-item"><a href="#">Management</a></li> --}}
                        <li class="breadcrumb-item active">{{ $institute->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- ------------------------------ Instittute Details ---------------------  -->

        <section class="micro-institute-deatils">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <img src="/assets/skoodos/assets/img/explore-listing/recommended.png" alt=""
                            class="m-recommended">
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-9 d-flex">
                        <img src="{{ !empty($uploads->logo) ? Storage::disk('public')->url($uploads->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                            alt="" style="height: 135px;">
                        @if (empty($uploads->logo))
                            <div style="position:relative; text-align:center;">
                                <h2
                                    style="font-size: 20px; font-weight:bold;position:relative; margin-top:50px; margin-left:-145px;">
                                    {{ $institute->nickname() }}

                                </h2>
                            </div>
                        @endif

                        <div class="m-institute-text">
                            <h1>{{ !empty($institute->name) ? $institute->name : '' }}</h1>

                            <ul class="d-flex rating align-items-center">
                                {!! \App\Helpers\Helper::printStar($institute->netrating(), $institute->package->is_showing_review) !!}

                            </ul>
                            <ul>
                                <li><span><i class="bi bi-geo-alt-fill"></i></span>{{ $institute->area }},
                                    {{ $institute->city_name }}, {{ $institute->state_name }}</li>

                                <li><span><i class="bi bi-telephone-fill"></i></span>+91
                                    {{ $institute->general->phone_number_1 }}
                                    @if ($institute->general->phone_number_2)
                                        <img src="/assets/skoodos/assets/img/Landline_Icon.png" alt="">
                                        +011 {{ $institute->general->phone_number_2 }}
                                    @endif
                                </li>
                                <li><span><i class="bi bi-envelope-fill"></i></span>{{ $institute->general->email_1 }}
                                    @if (!empty($institute->general->email_2))
                                        , {{ $institute->general->email_2 }}
                                    @endif

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">

                        @if (!empty($uploads->corporate_brochure))
                            <a class="blue-btn mt-2" href="{{Storage::disk('public')->url($uploads->corporate_brochure)}}" target="_blank">Download Brochure</a>
                        @endif
                        <div class="wishlist-icon d-flex align-items-center justify-content-between mt-2">
                            @student
                                @if ($isWishlited)
                                    <a style="cursor: pointer;" wire:click="removefromwishlist({{ $institute->id }})"><img
                                            src="/assets/skoodos/assets/img/microsite/wishlist.png"
                                            alt="">Wishlisted</a>

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
                                                                <div class="col-lg-3">
                                                                    <img src="/assets/skoodos/assets/img/modal-logo.png"
                                                                        alt="">
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <h5>Remove From Wishlist</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" wire:click="ConfirmNewModelClose()"></button>
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
                                                    <div class="model-footer text-end p-2 d-flex">

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
                                            src="/assets/skoodos/assets/img/microsite/wishlist.png"
                                            alt="">Wishlist</a>
                                @endif
                            @endstudent

                            {!! $institute->socialshare(request()->url()) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ------------------------ Microsite TAB ------------------------- -->
        <section class="micro-tabs">
            <div class="tab-bg">
                <div class="container">
                    <ul class="nav nav-pills justify-content-start " id="pills-tab" role="tablist">

                        @if ($institute->package->is_showing_general && $institute->is_showing_general)
                            <li class="nav-item mx-2" role="presentation">
                                <button class="nav-link @if ($generalTab) active @endif"
                                    id="pills-general-tab" data-bs-toggle="pill" data-bs-target="#pills-general"
                                    type="button" role="tab" aria-controls="pills-general" aria-selected="true"
                                    wire:click="GeneralShowNow()">General</button>
                            </li>
                        @endif


                        @if ($institute->package->is_showing_uploads && $institute->is_showing_uploads)
                            <li class="nav-item mx-2" role="presentation">
                                <button class="nav-link @if ($galleryTab) active @endif"
                                    id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery"
                                    type="button" role="tab" aria-controls="pills-gallery"
                                    aria-selected="false" @isAuthenticated wire:click="GalleryShowNow()"
                                    @else title="Login Mandatory To View The Tab!"
                                    @endisAuthenticated>Gallery
                                    @isAuthenticated
                                    @else
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    @endisAuthenticated
                                </button>
                            </li>
                        @endif


                        @if ($institute->package->is_showing_courses && $institute->is_showing_courses)
                            <li class="nav-item mx-2" role="presentation">
                                <button class="nav-link @if ($coursesTab) active @endif"
                                    id="pills-courses-tab" data-bs-toggle="pill" data-bs-target="#pills-courses"
                                    type="button" role="tab" aria-controls="pills-courses"
                                    aria-selected="false" @isAuthenticated wire:click="CoursesShowNow()"
                                    onclick="examsliknow();" @else title="Login Mandatory To View The Tab!"
                                    @endisAuthenticated>Courses
                                    @isAuthenticated
                                    @else
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    @endisAuthenticated
                                </button>
                            </li>
                        @endif
                        @if ($institute->package->is_showing_champions && $institute->is_showing_champions)
                            <li class="nav-item mx-2" role="presentation">
                                <button class="nav-link @if ($championsTab) active @endif"
                                    id="pills-chaimpions-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-chaimpions" type="button" role="tab"
                                    aria-controls="pills-chaimpions" aria-selected="false" @isAuthenticated
                                    wire:click="ChampionsShowNow()" @else title="Login Mandatory To View The Tab!"
                                    @endisAuthenticated>Champions
                                    @isAuthenticated
                                    @else
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    @endisAuthenticated
                                </button>
                            </li>
                        @endif


                        @if ($institute->package->is_showing_faculty && $institute->is_showing_faculty)
                            <li class="nav-item mx-2" role="presentation">
                                <button class="nav-link @if ($facultyTab) active @endif"
                                    id="pills-faculty-tab" data-bs-toggle="pill" data-bs-target="#pills-faculty"
                                    type="button" role="tab" aria-controls="pills-faculty" aria-selected="true"
                                @isAuthenticated wire:click="FacultyShowNow()" @else
                                title="Login Mandatory To View The Tab!" @endisAuthenticated>Faculty
                                @isAuthenticated
                                @else
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                @endisAuthenticated
                            </button>
                        </li>
                    @endif

                    @if ($institute->package->is_showing_centers && $institute->is_showing_centers)
                        <li class="nav-item mx-2" role="presentation">
                            <button class="nav-link @if ($centersTab) active @endif"
                                id="pills-centers-tab" data-bs-toggle="pill" data-bs-target="#pills-centers"
                                type="button" role="tab" aria-controls="pills-centers" aria-selected="true"
                            @isAuthenticated wire:click="CentersShowNow()" @else
                            title="Login Mandatory To View The Tab!" @endisAuthenticated>Centers
                            @isAuthenticated
                            @else
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            @endisAuthenticated
                        </button>
                    </li>
                @endif

                @if ($institute->package->is_showing_videos && $institute->is_showing_videos)
                    <li class="nav-item mx-2" role="presentation">
                        <button class="nav-link @if ($videosTab) active @endif"
                            id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos"
                            type="button" role="tab" aria-controls="pills-videos" aria-selected="true"
                        @isAuthenticated wire:click="VideosShowNow()" @else
                        title="Login Mandatory To View The Tab!" @endisAuthenticated>Videos
                        @isAuthenticated
                        @else
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        @endisAuthenticated
                    </button>
                </li>
            @endif

            @if ($institute->package->is_showing_review)

                <li class="nav-item mx-2" role="presentation">
                    <button class="nav-link @if ($reviewTab) active @endif"
                        id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews"
                        type="button" role="tab" aria-controls="pills-reviews" aria-selected="true"
                    @isAuthenticated wire:click="ReviewShowNow()" @else
                    title="Login Mandatory To View The Tab!" @endisAuthenticated>Reviews
                    @isAuthenticated
                    @else
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    @endisAuthenticated
                </button>
            </li>
        @endif

        @if ($institute->package->is_showing_alumni && $institute->is_showing_alumni)
            <li class="nav-item mx-2" role="presentation">
                <button class="nav-link @if ($alumniTab) active @endif"
                    id="pills-alumni-tab" data-bs-toggle="pill" data-bs-target="#pills-alumni"
                    type="button" role="tab" aria-controls="pills-alumni" aria-selected="true"
                @isAuthenticated wire:click="AlumniShowNow()" @else
                title="Login Mandatory To View The Tab!" @endisAuthenticated>Alumni
                @isAuthenticated
                @else
                    <i class="fa fa-lock" aria-hidden="true"></i>
                @endisAuthenticated
            </button>
        </li>
    @endif

    @if ($institute->package->is_showing_contact)

        <li class="nav-item mx-2" role="presentation">
            <button class="nav-link @if ($contactTab) active @endif"
                id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                type="button" role="tab" aria-controls="pills-contact" aria-selected="true"
            @isAuthenticated wire:click="ContactShowNow()" @else
            title="Login Mandatory To View The Tab!" @endisAuthenticated>Contact
            @isAuthenticated
            @else
                <i class="fa fa-lock" aria-hidden="true"></i>
            @endisAuthenticated
        </button>

    </li>
@endif


</ul>
</div>
</div>
<div class="container">
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
</div>
</section>

@endif
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
</div>

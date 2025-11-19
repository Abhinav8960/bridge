<div>
    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">

            <!-- ------------------------ Videos----------------------- -->
            <div class="videos mt-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="micro-heading">Fabulous Videos</h2>
                        <hr class="divider">
                    </div>
                    <div class="d-flex gap-3">
                        <div class="m-dropdown">
                            <select class="form-select select2" aria-label="Default select example"
                                wire:model="category">
                                <option value="">Select Exam Category</option>
                                @foreach ($categoryOptions as $categ)
                                    <option value="{{ $categ->category_id }}">{{ $categ->category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-dropdown">
                            @if (!empty($streamOptions))
                                <select class="form-select select2" aria-label="Default select example"
                                    wire:model="stream">
                                    <option value="">Select Exam Stream</option>
                                    @foreach ($streamOptions as $stream)
                                        <option value="{{ $stream->stream_id }}">{{ $stream->stream->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="m-dropdown">
                            @if (!empty($examOptions))
                                <select class="form-select select2" aria-label="Default select example"
                                    wire:model="exam">
                                    <option value="">Select Exam</option>
                                    @foreach ($examOptions as $exam)
                                        <option value="{{ $exam->exam_id }}">{{ $exam->exam->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container-box">
                    <div class="row">
                        @if (!empty($videoes) && $videoes->count() > 0)
                            @foreach ($videoes as $vid)
                                <div class="col-lg-6">
                                    <div class="card" style="height:200px !important">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <iframe
                                                    src="@if (!empty($vid->video_link)) https://www.youtube.com/embed/{{ \App\Helpers\Helper::VideoCode($vid->video_link) }} @else

                                            https://www.youtube.com/embed/{{ $vid->video_code }} @endif"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3>{{ $vid->video_title }}</h3>
                                                    <p>{{ $vid->description }}</p>
                                                    <p class="footer-text">Published On:
                                                        {{ Carbon\Carbon::parse($vid->created_at)->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- -------------------------- Videos ----------------------- -->
        <header class="sub-header">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <a href="/"><i class="bi bi-arrow-left"></i> Microsite: Videos</a>
                        <div class="d-flex gap-4">
                            {{-- @if (Route::is('configuration.*')) --}}
                            <a href="microsite.html" wire:click="showMobileFilter()" data-bs-toggle="modal"
                                data-bs-target="#microsite-filter"><i class="bi bi-funnel-fill"></i></a>
                            {{-- <a wire:click="showMobileFilter()" data-bs-toggle="modal"
                                    data-bs-target="#microsite-filter"><i class="bi bi-funnel-fill"></i></a> --}}
                            <a href="" data-bs-toggle="modal" data-bs-target="#microsite-option-model"><img
                                    src="/assets/skoodos/assets/img/microsite/Menu.png" alt=""></a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
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
                                    <a style="cursor: pointer;" wire:click="removefromwishlist({{ $institute->id }})"><img
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
                                <li><span><i class="bi bi-envelope-fill"></i></span>{{ $institute->general->email_1 }}
                                    @if (!empty($institute->general->email_2))
                                        , {{ $institute->general->email_2 }}
                                    @endif
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="broucher-btn">
                        <a href="">Download Brochure</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="tab-pane fade show active" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">

            <section class="videos">
                <div class="container">
                    <div class="microstite-container">
                        <div class="section--heading sub-heading">
                            <h2>Fabulous Videos</h2>
                        </div>
                        <div class="row videos-card">
                            @if (!empty($videoes) && $videoes->count() > 0)
                                @foreach ($videoes as $vid)
                                    <div class="col-12 videos__card">
                                        <div class="row ">
                                            <div class="col-5">
                                                <iframe
                                                    src="@if (!empty($vid->video_link)) https://www.youtube.com/embed/{{ \App\Helpers\Helper::VideoCode($vid->video_link) }} @else
                                                    https://www.youtube.com/embed/{{ $vid->video_code }} @endif"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen=""></iframe>
                                            </div>
                                            <div class="col-7 p-0">
                                                <div class="videos__card__text">
                                                    <h3>{{ $vid->video_title }}</h3>
                                                    <h4>MANAGEMENT / ENGINEERING</h4>
                                                    <p>{{ $vid->description }}</p>
                                                    <span>Published On:
                                                        {{ Carbon\Carbon::parse($vid->created_at)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{-- @if ($paginator->hasMorePages()) --}}
                        @if (!empty($videoes))
                            <div class="more-btn">
                                <button class="btn btn-link" wire:click="nextPage">View More</button>
                            </div>
                        @endif
                        {{-- @endif --}}
                    </div>
                </div>
            </section>
        </div>

        <!-- -------------------------- Videos ----------------------- -->


        <!-- --------------- Modal Filter----------->
        @if ($mobileFilter)
            <div class="modal fade filter_modal  show" id="microsite-filter" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                style="display: block ">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href="/" class="modal-title" id="staticBackdropLabel"><img
                                    src="/assets/skoodos/assets/img/back_btn.png"
                                    alt=""><span>Filters</span></a>
                            <a wire:click="hideMobileFilter()">Apply</a>
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
                                                            @foreach ($categoryOptions as $categ)
                                                                <div class="col-6">
                                                                    {{-- <a class="active" value="{{ $categ->category_id }}"
                                                                wire:click="category({{ $categ->category_id }})">{{ $categ->category->name }}</a> --}}
                                                                    <button type="button" class="active"
                                                                        value="{{ $categ->category_id }}"
                                                                        wire:click="category({{ $categ->category_id }})">{{ $categ->category->name }}</button>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="filter_bar">
                                        <!------ Exam Stream ------>
                                        @if (!empty($streamOptions))
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
                                                        aria-labelledby="headingFive"
                                                        data-bs-parent="#accordionExample">
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
                                                                @foreach ($streamOptions as $stream)
                                                                    <div class="col-6">
                                                                        <a wire:click="stream({{ $stream->stream_id }})"
                                                                            value="{{ $stream->stream_id }}">{{ $stream->stream->name }}</a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <hr class="filter_bar">

                                        <!----------============= Exams =================---------- -->
                                        @if (!empty($examOptions))
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
                                                        aria-labelledby="headingSix"
                                                        data-bs-parent="#accordionExample">
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
                                                                @foreach ($examOptions as $exam)
                                                                    <div class="col-6">
                                                                        <a class="active"
                                                                            value="{{ $exam->exam_id }}"
                                                                            wire:model="exam({{ $exam->exam_id }})">{{ $exam->exam->name }}</a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <hr class="filter_bar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    <style>
        .filter_modal .modal-dialog .modal-content .modal-body .accordion-item .accordion-body .filters button {
            border: 1px solid #f2f2f2;
            background-color: #f2f2f2;
            padding: 6px 6px;
            font-size: 12px;
            text-align: center;
            display: block;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

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

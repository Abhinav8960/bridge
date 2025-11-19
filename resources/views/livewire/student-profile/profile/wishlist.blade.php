<div>
    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-wish" role="tabpanel" aria-labelledby="pills-wish-tab">
            <div class="wishlist-container">
                <div class="wishlist-content">
                    <div class="m-dropdown">
                        <select class="form-select select2" aria-label="Default select example">
                            <option selected="">Management</option>
                            <option value="1">Engineering</option>
                        </select>
                    </div>
                    <div class="empty">
                        <a style="cursor: pointer" wire:click="emptyWishlist()"><img
                                src="/assets/skoodos/assets/img/empty.png" alt="">Empty
                            Wishlist</a>
                        @if ($confirmNow)
                            <div class="modal fade modal-splash show" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-modal="true" role="dialog" style="display: block;">
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
                                                    Are you sure you want to empty your wishlist?
                                                </p>
                                            </div>
                                        </div>
                                        <div class="model-footer text-end p-2">
                                            <button type="button" class="btn yellow-btn" data-bs-dismiss="modal"
                                                aria-label="Close"
                                                wire:click="removeinstitteFroWishlistAgree()">Yes</button>
                                            <button type="button" class="btn yellow-btn"
                                                wire:click="ConfirmNewModelClose()">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-backdrop fade show"></div>
                        @endif
                    </div>
                </div>
                <div class="row featured-institutes">
                    @if ($wishlists->count() > 0)
                        @foreach ($wishlists as $wishlist)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="">
                                        <a wire:click="removefromwishlist({{ $wishlist->institute_id }})"><i
                                                class="bi bi-x-lg"></i></a>
                                    </div>
                                    <div class="d-flex finstitute-line p-4 finstitute-top">
                                        <div class="finstitute-img">
                                            <img src="{{ !empty($wishlist->institute->upload->logo) ? Storage::disk('public')->url($wishlist->institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                                alt="Logo">
                                            @if (empty($wishlist->institute->upload->logo))
                                                <div style="position:relative; text-align:center;">
                                                    <h2
                                                        style="font-size: 20px; font-weight:bold;position:relative; margin-top:-52px;">
                                                        {{ $wishlist->institute->nickname() }}
                                                    </h2>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="finstitute-detail ps-3">
                                            <a href="">
                                                <h2 class="institute-name mb-1">{{ $wishlist->institute->name }}</h2>
                                            </a>
                                            <ul>
                                                <li><span><i
                                                            class="bi bi-geo-alt-fill"></i></span>{{ $wishlist->institute->area }},
                                                    {{ $wishlist->institute->city_name }},
                                                    {{ $wishlist->institute->state_name }}</li>
                                                <li><span><i
                                                            class="bi bi-telephone-fill"></i></span>{{ $wishlist->institute->mobile }}
                                                </li>
                                                <li><span><i
                                                            class="bi bi-envelope-fill"></i></span>{{ $wishlist->institute->email }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text finstitute-line p-4">
                                            {{ strlen($wishlist->institute->general->description) > 250 ? substr($wishlist->institute->general->description, 0, 250) . '...' : $wishlist->institute->general->description }}
                                        </p>
                                        <div
                                            class="finstitute-line d-flex p-4 justify-content-between align-items-center">
                                            <ul class="d-flex rating">
                                                {!! \App\Helpers\Helper::printStar(
                                                    $wishlist->institute->netrating(),
                                                    $wishlist->institute->package->is_showing_review,
                                                ) !!}
                                            </ul>
                                            <a class="view-btn"
                                                href="{{ route('institute.microsite', ['slug' => $wishlist->institute->slug]) }}">View
                                                Details</a>
                                        </div>
                                        <div class="stream p-4">
                                            <p><span>Stream :</span>
                                                @foreach ($wishlist->institute->streams as $streams)
                                                    {{ $streams->stream->name }}
                                                    @if (!$loop->last)
                                                        /
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 text-center">
                            <img src="/assets/skoodos/assets/img/defaultImages/No Results/No-Wishlist.jpg">
                            <h5>No Institutes Found</h5>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    @elseif($mobileResult)
        <main>

            <!-- ------- Sub Header ----- -->

            <header class="sub-header">
                <div class="container">
                    <div style="display: flex !important;justify-content: space-between;">
                        <a href="{{ route('student.profile') }}"><i class="bi bi-arrow-left"></i>My Wish List</a>
                        <a style="cursor: pointer;float:right;" wire:click="emptyWishlist()" style="float-end"><img
                                src="/assets/skoodos/assets/img/Remove-Icon.png" alt=""></a>
                    </div>
                </div>
            </header>

            <!-- ------- Sub Header ----- -->

            <!-- ------ Wishlist------- -->

            {{-- <section class="wishlist">
                <div class="container">
                    <div class="wishlist-container">
                        <div class="wishlist-content">
                            <div class="empty">
                                <a style="cursor: pointer" wire:click="emptyWishlist()"><img
                                        src="/assets/skoodos/assets/img/Remove-Icon.png" alt="">Empty
                                    Wishlist</a>
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
                                                        aria-label="Close"
                                                        wire:click="ConfirmNewModelClose()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-splash-text">
                                                        <p class="d-flex">
                                                            Are you sure you want to empty your wishlist?
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="model-footer text-end p-2">
                                                    <button type="button" class="btn yellow-btn"
                                                        data-bs-dismiss="modal" aria-label="Close"
                                                        wire:click="removeinstitteFroWishlistAgree()">Yes</button>
                                                    <button type="button" class="btn yellow-btn"
                                                        wire:click="ConfirmNewModelClose()">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-backdrop fade show"></div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </section> --}}

            <!-- --------- End My Wishlist ------- -->

            <section class="featured-institute p-0" style="background-color: #ffff;">
                <div class="container">
                    @if ($wishlists->count() > 0)
                        @foreach ($wishlists as $wishlist)
                            <div class="featured-institute__container ">
                                <img src="/assets/skoodos/assets/img/categories/recommended.png" class="recommended"
                                    alt="">
                                <ul class="rating _text-end">
                                    {!! \App\Helpers\Helper::printStar(
                                        $wishlist->institute->netrating(),
                                        $wishlist->institute->package->is_showing_review,
                                    ) !!}
                                </ul>
                                <div class="featured-institute__card">
                                    <div class="featured-institute__img"
                                        style="display: flex;align-items:center;justify-content:center;">
                                        <img src="{{ !empty($wishlist->institute->upload->logo) ? Storage::disk('public')->url($wishlist->institute->upload->logo) : '../assets/skoodos/assets/img/defaultImages/Logo.jpg' }}"
                                            alt="">
                                        @if (empty($wishlist->institute->upload->logo))
                                            <div style="position:absolute; text-align:center;">
                                                <h2 style="font-size: 20px; font-weight:bold;">
                                                    {{ $wishlist->institute->nickname() }}
                                                </h2>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="featured-institute__text">
                                        <a href="microsite.html">
                                            <h3>{{ $wishlist->institute->name }}</h3>
                                        </a>
                                        <ul>
                                            <li><span><i
                                                        class="bi bi-geo-alt-fill"></i></span>{{ $wishlist->institute->area }},
                                                {{ $wishlist->institute->city_name }},
                                                {{ $wishlist->institute->state_name }}
                                            </li>
                                            <li><span><i
                                                        class="bi bi-telephone-fill"></i></span>+91-{{ $wishlist->institute->mobile }}
                                            </li>
                                            <li><span><i
                                                        class="bi bi-envelope-fill"></i></span>{{ $wishlist->institute->email }}
                                            </li>
                                        </ul>
                                    </div>
                                    @if ($confirmNow)
                                        <div class="modal fade modal-splash show" id="staticBackdrop"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog"
                                            style="display: block;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title" id="staticBackdropLabel">
                                                            <div class="d-flex">
                                                                <div class="col-lg-3">
                                                                    <img src="/assets/skoodos/assets/img/modal-logo.png"
                                                                        alt="">
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <h5>Remove From Wishlist</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"
                                                            wire:click="ConfirmNewModelClose()"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-splash-text">
                                                            <p class="d-flex">
                                                                Are you sure you want to empty your wishlist?
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="model-footer text-end p-2">
                                                        <button type="button" class="btn yellow-btn"
                                                            data-bs-dismiss="modal" aria-label="Close"
                                                            wire:click="removeinstitteFroWishlistAgree()">Yes</button>
                                                        <button type="button" class="btn yellow-btn"
                                                            wire:click="ConfirmNewModelClose()">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-backdrop fade show"></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 text-center">
                            <img src="/assets/skoodos/assets/img/defaultImages/No Results/No-Wishlist.jpg">
                            <h5>No Institutes Found</h5>
                        </div>
                    @endif
                </div>
            </section>
        </main>
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

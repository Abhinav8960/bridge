<div>
    @if ($desktopResult)
        <!-- ------------------------------- Reviews --------------------------- -->
        <div class="tab-pane fade show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
            <div class="review mt-5">
                <div class="container">
                    @student
                        @if (empty($canReview))
                            <h2 class="micro-heading">Write A Review</h2>
                            <hr class="divider">
                            @include('layouts.flash-message')
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="title"
                                                placeholder="Title Of Your Review" wire:model="title" required>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" id="review" rows="8" placeholder="Write A Review" wire:model="review" required></textarea>
                                            @error('review')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[0]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="OverallRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($overallrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[1]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="courseStructureRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($coursestructurerating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[2]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="facultyRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($facultyrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[3]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="infrastructureRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($infrastructurerating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[4]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="doubtSessionsRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($doubtsessionsrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[5]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="studymaterialRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($studymaterialrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <button class="yellow-btn float-end" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endstudent

                    <div class="m-rating-reviews mt-4">
                        <div class="d-flex">
                            <h2 class="micro-heading">Ratings & Reviews
                                <hr class="divider">
                            </h2>
                        </div>
                        <div class="review-rate re mt-4 text-center">
                            <div class="row">
                                <div class="col-lg-5 d-flex justify-content-center align-items-center">
                                    <div class="review-left-box d-flex align-items-center justify-content-center">
                                        <h3>{{ round($instituteavgrating) ? round($instituteavgrating , 1) : 0 }}</h3>
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                    <p>{{ $instituteReviewedBystudent }} People Reviewed</p>
                                </div>
                                <div class="col-lg-1 review-vertical">
                                    <div class="vl"></div>
                                </div>
                                <div class="col-lg-6 text-center d-flex justify-content-center flex-column">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <span>5 Star</span>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percentage5Rating }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <span>{{ round($percentage5Rating,1) }}%</span>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <span>4 Star</span>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percentage4Rating }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <span>{{ round($percentage4Rating,1) }}%</span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <span>3 Star</span>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percentage3Rating }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <span>{{ round($percentage3Rating,1) }}%</span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <span>2 Star</span>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percentage2Rating }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <span>{{ round($percentage2Rating,1) }}%</span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <span>1 Star</span>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percentage1Rating }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <span>{{ round($percentage1Rating,1) }}%</span>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>


                        @foreach ($reviewandratings as $rating)
                            <div class="container-box mt-4">
                                <div class="review-top d-flex justify-content-between align-items-center">
                                    <ul class="rating user-rating">
                                        {!! \App\Helpers\Helper::printStar(
                                            $rating->average_rating,
                                            $rating->institute ? $rating->institute->package->is_showing_review : '',
                                        ) !!}

                                        {{ $rating->average_rating }}
                                    </ul>
                                    <p>{{ $rating->created_at->diffForHumans() }}</p>
                                </div>
                                <h3>"{{ $rating->title }}"</h3>
                                <p>{{ $rating->review }}</p>

                                <div class="review-details mt-4 d-flex justify-content-between align-items-center">
                                    <div class="review-image d-flex align-items-end">
                                        {{-- <img src="/assets/skoodos/assets/img/defaultImages/Default Reviews.png"
                                            alt=""> --}}
                                        <div class="user-name">
                                            <p>{{ !empty($rating->student->name) ? $rating->student->name : 'Anonymous' }}
                                            </p>
                                            {{-- <a href="">{{ $rating->student->reviews->count() }} Review(s)</a> --}}
                                            {{ $rating->student ? $rating->student->reviews->count() : '' }} Review(s)
                                        </div>
                                    </div>
                                    {{-- <div class="like-dislike d-flex align-items-center">
                                <a href="JavaScript:void(0);"><span class="change-icon"><i
                                            class="bi bi-hand-thumbs-up"></i><i class="bi bi-hand-thumbs-up-fill"></i>
                                        45</span></a>
                                <a href="JavaScript:void(0);"><span class="change-icon "><i
                                            class="bi bi-hand-thumbs-down"></i><i
                                            class="bi bi-hand-thumbs-down-fill"></i>
                                        15</span></a>
                            </div> --}}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- -------------------- Reviews ------------------- -->

        <div class="tab-pane fade show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">

            <div class="reviews">
                <div class="container">
                    <div class="section--heading sub-heading">
                        <h2>RATING & REVIEWS</h2>
                        @student
                            @if (empty($canReview))
                                <button class="btn-yellow" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-backdrop="static" data-keyboard="false">Write
                                    A Review</button>
                            @endif
                        @endstudent
                    </div>
                    <div class="people-review">
                        <div class="people-review__rating">
                            <a href="">{{ round($instituteavgrating) ? round($instituteavgrating,1) : 0 }}<i
                                    class="bi bi-star-fill"></i></a>
                            <p>{{ $instituteReviewedBystudent }} People Reviewed</p>
                        </div>
                    </div>
                    <div class="row reviews-progress-bar">
                        <div class="col-12 text-center d-flex justify-content-center flex-column">
                            <div class="progress-box">
                                <span>5 Star</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $percentage5Rating }}%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>{{ round($percentage5Rating,1) }}%</span>
                            </div>
                            <div class="progress-box">
                                <span>4 Star</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width:{{ $percentage4Rating }}%" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <span>{{ round($percentage4Rating,1) }}%</span>
                            </div>
                            <div class="progress-box">
                                <span>3 Star</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $percentage3Rating }}%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>{{ round($percentage3Rating,1) }}%</span>
                            </div>
                            <div class="progress-box">
                                <span>2 Star</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $percentage2Rating }}%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>{{ round($percentage2Rating,1) }}%</span>
                            </div>
                            <div class="progress-box">
                                <span>1 Star</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $percentage1Rating }}%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>{{ round($percentage1Rating,1) }}%</span>
                            </div>
                        </div>
                    </div>

                    @foreach ($reviewandratings as $rating)
                        <div class="student-review microstite-container">
                            <div class=" d-flex align-items-center justify-content-between">
                                <div class="star">
                                    {!! \App\Helpers\Helper::mobileprintStar(
                                        $rating->average_rating,
                                        $rating->institute ? $rating->institute->package->is_showing_review : '',
                                    ) !!}

                                    <a href=""><span>{{ $rating->average_rating }}</span></a>
                                </div>
                                <p>{{ $rating->created_at->diffForHumans() }}</p>
                            </div>

                            <div class="student-review__text">
                                <h3>“{{ $rating->title }}”</h3>
                                {{-- <h4>Course Name: <span>CAT (2022)</span></h4> --}}
                                <p>{{ $rating->review }}</p>
                            </div>
                            <div class="student-details">
                                <div class="student-details__left-box">
                                    {{-- <img src="/assets/skoodos/assets/img/explore-listing/champ/champ1.png"
                                        alt=""> --}}
                                    <div>
                                        <h5>{{ !empty($rating->student->name) ? $rating->student->name : 'Anonymous' }}
                                        </h5>
                                        @if ($rating->student)
                                            <a href=""><span>{{ $rating->student ? $rating->student->reviews->count() : '0' }}</span>
                                                @if ($rating->student->reviews->count() > 1)
                                                    Reviews
                                                @else
                                                    Review
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="student-details__right-box">
                                    <a href="JavaScript:void(0);"><span class="change-icon"><i
                                                class="bi bi-hand-thumbs-up"></i><i
                                                class="bi bi-hand-thumbs-up-fill"></i>
                                            45</span></a>
                                    <a href="JavaScript:void(0);"><span class="change-icon "><i
                                                class="bi bi-hand-thumbs-down"></i><i
                                                class="bi bi-hand-thumbs-down-fill"></i>
                                            15</span></a>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- -------------------- Reviews ------------------- -->
        <!-- --------------- Write Review Modal -------- -->
        <div class="modal fade filter_modal review-modal" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
            wire:ignore>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="{{ route('institute.microsite', ['slug' => $institute->slug]) }}"
                            class="modal-title" id="staticBackdropLabel"><img
                                src="/assets/skoodos/assets/img/back_btn.png" alt=""><span>Write A
                                Review</span></a>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form wire:submit.prevent="submit">
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="title"
                                                placeholder="Title Of Your Review" wire:model="title" required>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <input type="email" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Title Of Your Review"> --}}
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" id="review" rows="6" placeholder="Write A Review" wire:model="review"
                                                required></textarea>
                                            @error('review')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Write A Review"></textarea> --}}
                                        </div>
                                    </div>
                                    <hr class="review-modal-divider">
                                    <div class="col-12">
                                        <div class=" m-rating ">
                                            <ul>
                                                <li>{{ $parameters[0]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="OverallRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($overallrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[1]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span
                                                                wire:click="courseStructureRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($coursestructurerating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[2]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="facultyRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($facultyrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[3]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="infrastructureRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($infrastructurerating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[4]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="doubtSessionsRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($doubtsessionsrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class=" m-rating">
                                            <ul>
                                                <li>{{ $parameters[5]['title'] }}
                                                    <div class="pull-right">
                                                        @for ($i = 1; $i <= $maxrating; $i++)
                                                            <span wire:click="studymaterialRate({{ $i }})"
                                                                class="bi bi-star-fill star-icon"
                                                                @if ($studymaterialrating >= $i) style="color: #d0de29;" @endif></span>
                                                        @endfor
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="text-center mt-4 mb-4">
                                            <button class="btn-yellow" data-bs-dismiss="modal"
                                                type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- --------------- End Write Review Model -------- -->
    @endif
    <!-- ------------------------------- End Reviews --------------------------- -->
</div>

@push('styles')
    <style>
        .star-icon:hover {
            color: #d0de29;
        }
    </style>
@endpush

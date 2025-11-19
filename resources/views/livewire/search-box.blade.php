<div>
    <div class="search_box d-flex  align-items-center">
        {{-- <div class="d-flex align-items-center form-select">
            <div> <img src="/assets/skoodos/assets/img/homepage/UpperBanner/location.png" alt="">
                <span>Near Me</span>
            </div>
        </div> --}}
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search By Exam / Stream / Institute / Location"
                wire:model="searchText">
            <a wire:click="SearchNow()" class="input-group-text py-2 px-4" data-bs-toggle="modal" href="#searchbox"
                role="button"> <i class="bi bi-search"></i> Find
                Institute</a>
        </div>

    </div>

    @if ($results)
        <div class="modal fade show" id="searchbox" aria-labelledby="searchboxLabel" tabindex="-1" aria-modal="true"
            role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" wire:click="SearchNowClose()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" wire:model="searchText">
                                    <label>Search By Exam / Stream / Institute / Location</label>
                                </div>
                            </div>
                        </div>
                        @if (!empty($institutesOptions) && $institutesOptions->count() > 0)

                            <div class="card my-1">
                                <div class="card-header">
                                    Institutes
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($institutesOptions as $option)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ route('institute.microsite', ['slug' => $option->institute->slug]) }}">{{ $option->institute->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                        @if (!empty($examOptions) && $examOptions->count() > 0)

                            <div class="card my-1">
                                <div class="card-header">
                                    Exams
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($examOptions as $option)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ route('explore.institute', ['rcategory' => $option->category_id, 'rstream' => $option->stream_id, 'rexam' => $option->id, 'rstate' => 0, 'rcity' => 0, 'rarea' => 0, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => $option->category_id, 'stream' => $option->stream_id, 'exam' => $option->id, 'state' => 0, 'city' => 0, 'area' => 0])]) }}">{{ $option->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                        @if (!empty($streamOptions) && $streamOptions->count() > 0)

                            <div class="card my-1">
                                <div class="card-header">
                                    Streams
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($streamOptions as $option)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ route('explore.institute', ['rcategory' => $option->category_id, 'rstream' => $option->id, 'rexam' => 0, 'rstate' => 0, 'rcity' => 0, 'rarea' => 0, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => $option->category_id, 'stream' =>  $option->id, 'exam' => 0, 'state' => 0, 'city' => 0, 'area' => 0])]) }}">{{ $option->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                        @if (!empty($stateOptions) && $stateOptions->count() > 0)

                            <div class="card my-1">
                                <div class="card-header">
                                    State
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($stateOptions as $option)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ route('explore.institute', ['rcategory' => 0, 'rstream' => 0, 'rexam' => 0, 'rstate' => $option->state_id, 'rcity' => 0, 'rarea' => 0, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => 0, 'stream' => 0, 'exam' => 0, 'state' => $option->state_id, 'city' => 0, 'area' => 0])]) }}">{{ $option->state_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif

                        @if (!empty($cityOptions) && $cityOptions->count() > 0)

                            <div class="card my-1">
                                <div class="card-header">
                                    City
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($cityOptions as $option)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ route('explore.institute', ['rcategory' => 0, 'rstream' => 0, 'rexam' => 0, 'rstate' => $option->state_id, 'rcity' => $option->city_id, 'rarea' => 0, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => 0, 'stream' => 0, 'exam' => 0, 'state' => $option->state_id, 'city' => $option->city_id, 'area' => 0])]) }}">{{ $option->city_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif

                        @if (!empty($areaOptions) && $areaOptions->count() > 0)

                            <div class="card my-1">
                                <div class="card-header">
                                    Area
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($areaOptions as $option)
                                        <li class="list-group-item">
                                            <a
                                                href="{{ route('explore.institute', ['rcategory' => 0, 'rstream' => 0, 'rexam' => 0, 'rstate' => $option->state_id, 'rcity' => $option->city_id, 'rarea' => $option->id, 'rseoslug' => \App\Helpers\Helper::SeoUrl(['category' => 0, 'stream' => 0, 'exam' => 0, 'state' => $option->state_id, 'city' => $option->city_id, 'area' => $option->area_id])]) }}">{{ $option->area }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
        <style>
            .modal-body {
                max-height: 500px;
                overflow: auto;
            }
        </style>
    @endif

</div>

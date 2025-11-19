<div>

    @if ($visibility == true)
        @if ($desktopResult)
            @if (!empty($category) && $category->is_show_homepage == 1)

                <section class="exams-card">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="e-exams-top d-flex justify-content-between align-items-center">
                                    <div class="e-exams-left d-flex align-items-center">
                                        @if (!empty($category->icon))
                                            <img src="{{ Storage::disk('public')->url($category->icon) }}"
                                                class="heading-logo" alt="">
                                        @else
                                            <img src="/assets/skoodos/assets/img/homepage/EntranceExam/entrance.png"
                                                alt="" class="heading-logo">
                                        @endif

                                        <a
                                            href="{{ route('explore.institute', [$category->id, $rstream, $rexam, $rstate, $rcity, $rarea, \App\Helpers\Helper::SeoUrl(['category' => $category->id])]) }}">
                                            <h2 class="heading">{{ strtoupper($category->name) }}
                                                <hr class="divider">
                                            </h2>
                                        </a>

                                    </div>
                                    <div class="e-exams-right d-flex align-items-center">
                                        <img src="/assets/skoodos/assets/img/homepage/EntranceExam/institutes.png"
                                            alt="" class="institute-logo">
                                        <h3 class="institute-text">Institutes : <span
                                                class="i-number">{{ $instituteCategoryWise }}</span> </h3>
                                    </div>
                                </div>
                                <p>{!! $category->description !!}</p>

                                <div id="entrance-silder" class="cards slider-cards mt-4 d-flex">
                                    @if ($category->streams->count() > 0)
                                        @foreach ($category->streams as $stream)
                                            <a wire:click="showExams({{ $stream->id }})">
                                                <div class="card @if ($selectedStream == $stream->id) active @endif">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="">
                                                            @if (!empty($stream->icon))
                                                                <img src="{{ Storage::disk('public')->url($stream->icon) }}"
                                                                    class="exam-img-1" alt="">
                                                            @else
                                                                <img src="/assets/skoodos/assets/img/homepage/EntranceExam/Managment.png"
                                                                    class="exam-img-1" alt="">
                                                            @endif
                                                            @if (!empty($stream->icon_hover))
                                                                <img src="{{ Storage::disk('public')->url($stream->icon_hover) }}"
                                                                    class="exam-img-2" alt="">
                                                            @else
                                                                <img src="/assets/skoodos/assets/img/homepage/EntranceExam/Management-Hover.png"
                                                                    class="exam-img-2" alt="">
                                                            @endif

                                                        </div>
                                                        <div class="">
                                                            <h3>{{ $stream->name }}</h3>
                                                            <p>{{ $this->countInstituteStreamWise($stream->id) }}
                                                                Institutes
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="result-institutes mt-5">
                                    <div class="d-flex align-items-center mb-5">
                                        <h2>Result:</h2>&nbsp;
                                        <p><span>

                                                {{ $this->countInstituteStreamWise($selectedStream) }} institutes

                                            </span> | @if (!empty($exams) && $exams->total() > 0)
                                                {{ $exams->total() }} Exams
                                            @else
                                                0 Exam
                                            @endif
                                        </p>
                                    </div>
                                    @if (!empty($exams) && $exams->count() > 0)
                                        <div class="result-cards">
                                            <ul>
                                                @foreach ($exams as $exam)
                                                    <li>
                                                        <div class="card text-center mb-5" title="{{ strtoupper($exam->fullname) }}">
                                                            @if (!empty($exam->icon) && Storage::disk('public')->exists($exam->icon))
                                                                <img src="{{ Storage::disk('public')->url($exam->icon) }}"
                                                                    class="card-img-top" alt="...">
                                                            @endif

                                                            <h4>{{ strtoupper($exam->name) }}</h4>
                                                            <div class="card-body">
                                                                <a
                                                                    href="{{ route('explore.institute', [
                                                                        'rcategory' => $exam->category_id,
                                                                        'rstream' => $exam->stream_id,
                                                                        'rexam' => $exam->id,
                                                                        'rstate' => \App\Helpers\Helper::NOT_NEEDED,
                                                                        'rcity' => \App\Helpers\Helper::NOT_NEEDED,
                                                                        'rarea' => \App\Helpers\Helper::NOT_NEEDED,
                                                                        'rseoslug' => \App\Helpers\Helper::SeoUrl([
                                                                            'category' => $exam->category_id,
                                                                            'stream' => $exam->stream_id,
                                                                            'exam' => $exam->id,
                                                                            'state' => \App\Helpers\Helper::NOT_NEEDED,
                                                                            'city' => \App\Helpers\Helper::NOT_NEEDED,
                                                                            'area' => \App\Helpers\Helper::NOT_NEEDED,
                                                                        ]),
                                                                    ]) }}"><b>{{ $this->countInstituteExamWise($exam->id) }}</b>
                                                                    Institutes</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    {{-- @if (!empty($exams) && $exams->count() > 10)
                                <div class="text-center mt-3">
                                    <a class="viewall" href="/exams/entrance-exam">View More</a>
                                </div>
                            @endif --}}
                                    <div class="text-center mt-3">
                                        <a class="viewall" href="{{ route('exams.entrance-exam') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @elseif ($mobileResult)
            @if (!empty($category) && $category->is_show_homepage == 1)

                <section class="section--exams">
                    <div class="container">
                        <div class="section--exams__card">
                            <div class="section--exams__card__header text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    @if (!empty($category->icon))
                                        <img src="{{ Storage::disk('public')->url($category->icon) }}" alt="">
                                    @else
                                        <img src="assets/img/homepage/entrance-exam.png" alt="">
                                    @endif
                                    <h2>{{ strtoupper($category->name) }}</h2>
                                </div>
                                <p>{{ $category->teasure_line }}</b></p>
                            </div>
                            <div class="row ">
                                @if (!empty($category->streams))
                                    @if ($category->streams->count() > 0)
                                        @foreach ($category->streams as $stream)
                                            <div class="col-6">
                                                <a
                                                    href="{{ route('explore.institute', [$category->id, $stream->id, 0, 0, 0, \App\Helpers\Helper::NOT_NEEDED, \App\Helpers\Helper::SeoUrl(['category' => $category->id, 'stream' => $stream->id, 'exam' => 0, 'state' => 0, 'city' => 0, 'area' => 0])]) }}">
                                                    <div class="card--box active">
                                                        <div class="card--box__img">
                                                            @if (!empty($stream->icon))
                                                                <img src="{{ Storage::disk('public')->url($stream->icon) }}"
                                                                    alt="" class="img-1">
                                                            @else
                                                                <img src="assets/img/homepage/Managment-a.png"
                                                                    alt="" class="img-2">
                                                            @endif
                                                        </div>
                                                        <div class="card--box__text">
                                                            <h2>{{ $stream->name }}</h2>
                                                            <p>{{ $this->countInstituteStreamWise($stream->id) }}
                                                                Institutes
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                                <div class="text-center btn-wrapper">
                                    <a href="{{ route('exams.entrance-exam') }}">View More</a>
                                </div>
                            </div>
                            <div class="bottom-img">
                                @if (!empty($category->mobile_dashboard_banner))
                                    <img src="{{ Storage::disk('public')->url($category->mobile_dashboard_banner) }}"
                                        alt="" class="w-100">
                                @else
                                    <img src="assets/img/homepage/entrance-artwork.png" alt="" class="w-100">
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endif
    @endif
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function(event) {
                Livewire.hook('message.processed', () => {
                    entrancesliderActivate();
                });
            });

            function entrancesliderActivate() {
                $("#entrance-silder")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        arrows: true,
                        autoplay: false,
                        responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4,
                            },
                        }, ],
                        prevArrow: '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
                        nextArrow: '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
                    });
            }
            entrancesliderActivate();
        </script>
    @endpush

</div>

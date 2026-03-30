<div>

    <!-- ======= Government Exams Section ======= -->

    <section class="exams-card mt-5">
        <div class="container">
            <div class="e-exams-top d-flex justify-content-between align-items-center">
                <div class="e-exams-left d-flex align-items-center">

                    {{-- <img src="/assets/skoodos/assets/img/homepage/GovernmentExams/gov.png" alt="" class="heading-logo">
                <h1 class="heading">Government Exams
                  <hr class="divider">
                </h1> --}}
                    @if (!empty($category->icon))
                        <img src="{{ Storage::disk('public')->url($category->icon) }}" class="heading-logo" alt="">
                    @else
                        <img src="/assets/skoodos/assets/img/homepage/EntranceExam/entrance.png" alt=""
                            class="heading-logo">
                    @endif

                    <a
                        href="{{ route('explore.institute', [$category->id, $rstream, $rexam, $rstate, $rcity, $rarea, \App\Helpers\Helper::SeoUrl(['category' => $category->id])]) }}">
                        <h2 class="heading">{{ strtoupper($category->name) }}
                            <hr class="divider">
                        </h2>
                    </a>
                </div>
                <div class="e-exams-right d-flex align-items-center">
                    <img src="/assets/skoodos/assets/img/homepage/EntranceExam/institutes.png" alt=""
                        class="institute-logo">
                    <h3 class="institute-text">Institutes : <span class="i-number">{{ $instituteCategoryWise }}</span>
                    </h3>
                </div>
            </div>
            <p>{{ $category->description }}</p>

            <div id="government-silder" class="cards slider-cards d-flex align-items-center mt-4">
                @if ($category->streams->count() > 0)
                    @foreach ($category->streams as $stream)
                        <a wire:click="showExams({{ $stream->id }})">
                            <div class="card @if ($selectedStream == $stream->id) active @endif">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
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
                                    <div class="col-lg-8">
                                        <h3>{{ $stream->name }}</h3>
                                        <p>{{ $this->countInstituteStreamWise($stream->id) }} Institutes</p>
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
                    <p><span>{{ $this->countInstituteStreamWise($selectedStream) }} Institutes</span> |
                        @if (!empty($exams) && $exams->count() > 0)
                            {{ $exams->count() }} Exams
                        @else
                            0 Exam
                        @endif
                    </p>
                </div>
                @if (!empty($exams) && $exams->count() > 0)
                    <div class="result-cards mt-2 d-flex">
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
            </div>
        </div>
    </section>



    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function(event) {
                Livewire.hook('message.processed', () => {
                    governmentsliderActivate();
                });
            });

            function governmentsliderActivate() {
                $("#government-silder")
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
            governmentsliderActivate();
        </script>
    @endpush
</div>

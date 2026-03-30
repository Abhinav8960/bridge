<div>
    @if ($desktopResult)
        <div class="tab-pane fade show active" id="pills-chaimpions" role="tabpanel" aria-labelledby="pills-chaimpions-tab">

            <!------------====================== Champions Course Microsite ==============------------- -->

            <div class="Champions mt-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="micro-heading">Our Champions</h2>
                        <hr class="divider">
                    </div>

                    <div class="m-dropdown">
                        @if ($InstituteStreams->count() > 0)
                            <select class="form-select select2" aria-label="Default select example"
                                wire:model="selectedStream">
                                @foreach ($InstituteStreams as $stream)
                                    <option value="{{ $stream->exam_stream_id }}">
                                        {{ $stream->stream->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                </div>
                <div class="container-box mt-4">
                    @if (!empty($exams) && $exams->count() > 0)
                        <div id="exam-card-slider" class="m-exams-btn d-flex flex-wrap">
                            @foreach ($exams as $exam)
                                <a class="view-btn @if ($selectedExam == $exam->exam_id) active @endif"
                                    wire:click="showChampions({{ $exam->exam_id }})">{{ $exam->exam->name }}</a>
                            @endforeach
                        </div>
                    @endif
                    <div class="student-profile text-center">
                        @if (!empty($champions) && $champions->count() > 0)
                            <div class="row pb-5">
                                @foreach ($champions as $champion)
                                    <div class="col-lg-3 mt-5">
                                        <img src="{{ !empty($champion->candidate_image) ? Storage::disk('public')->url($champion->candidate_image) : '../assets/skoodos/assets/img/defaultImages/Champion-Profile.jpg' }}"
                                            alt="" style="width: 96px; height:96px">
                                        <h3>{{ $champion->candidate_name }}</h3>
                                        <p>Rank {{ $champion->rank }} ({{ $champion->exam->name }}) |
                                            {{ $champion->year }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- ----------------------- Champions ----------------------->

        <div class="tab-pane fade show active" id="pills-champions" role="tabpanel"
            aria-labelledby="pills-champions-tab">

            <section class="champions-section">
                <div class="container">
                    <div class="microstite-container">
                        <div class="section--heading sub-heading d-flex justify-content-between">
                            <h2>Our Champions</h2>
                        </div>
                        <div class="btnn d-flex">
                            @if (!empty($exams) && $exams->count() > 0)
                                @foreach ($exams as $exam)
                                    <a class="view-btn @if ($selectedExam == $exam->exam_id) active @endif"
                                        wire:click="showChampions({{ $exam->exam_id }})">{{ $exam->exam->name }}</a>
                                @endforeach
                            @endif
                        </div>
                        <div class="row students-card">
                            @if (!empty($champions) && $champions->count() > 0)
                                @foreach ($champions as $champion)
                                    <div class="col-4">
                                        <div class="students-card__content">
                                            <img src="{{ !empty($champion->candidate_image) ? Storage::disk('public')->url($champion->candidate_image) : '../assets/skoodos/assets/img/defaultImages/Champion-Profile.jpg' }}"
                                                alt="">
                                            <h3>{{ $champion->candidate_name }}</h3>
                                            <p>Rank : {{ $champion->rank }} ({{ $champion->exam->name }}) |
                                                {{ $champion->year }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </section>

        </div>

        <!-- ----------------------- Champions ----------------------->
    @endif
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function(event) {
                Livewire.hook('message.processed', () => {
                    examsliderActivate();
                });
            });

            function examsliderActivate() {
                $("#exam-card-slider")
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
            examsliderActivate();
        </script>
    @endpush
    {{-- @push('scripts')
        <script>
            $(document).ready(function() {
                $(".exam-card-slider")
                    .slick({
                        infinite: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
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
            });

            $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
                $('.exam-card-slider').slick('setPosition');
            });
            $('#engineer-btn-more').click(function() {
                $('.exam-card-slider').slick('setPosition');
            })
        </script>
    @endpush --}}
    <style>
        .champions-section .btnn {
            gap: 10px;
            flex-flow: wrap;
            padding-top: 2rem;
        }
    </style>
</div>

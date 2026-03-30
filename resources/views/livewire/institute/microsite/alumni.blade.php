<div>
    @if ($desktopResult)

        <div class="tab-pane fade show active" id="pills-alumni" role="tabpanel" aria-labelledby="pills-alumni-tab">

            <!-- -----------------------------------Alumni ------------------------ -->

            <div class="m-faculty m--alumni mt-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="micro-heading">Alumni</h2>
                        <hr class="divider">
                    </div>

                    <div class="m-dropdown">
                        @if ($institute->alumniswithsamestream->count() > 0)
                            <select class="form-select select2" aria-label="Default select example" wire:model="stream">
                                <option value="">Select Exam Stream</option>
                                @foreach ($institute->alumniswithsamestream as $alumnistream)
                                    <option value="{{ $alumnistream->exam_stream_id }}">
                                        {{ $alumnistream->stream->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="container-box mt-4">
                    <div class="row">
                        {{-- <input type="hidden" id="alumni-card" value="1"> --}}
                        @if (!empty($alumnies) && $alumnies->count() > 0)
                            @foreach ($alumnies as $alumni)
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ !empty($alumni->alumni_image) ? Storage::disk('public')->url($alumni->alumni_image) : '../assets/skoodos/assets/img/defaultImages/Alumni-Icon.jpg' }}"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3>{{ $alumni->name }}</h3>
                                                    <h4>{{ $alumni->designation }} {{ $alumni->company }}</h4>
                                                    <h5>{{ $alumni->exam->name }} ({{ $alumni->year }})</h5>
                                                    <p>{{ $alumni->profile }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if (!empty($alumnies) && $alumnies->count() > 10)
                            <div class="text-center mt-5">
                                <a wire:click="showMore({{ $selectedStream }})" id="alumni-btn-more">Show More</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif ($mobileResult)
        <!-- --------------------- Alumni ------------------- -->

        <div class="tab-pane fade show active" id="pills-alumni" role="tabpanel" aria-labelledby="pills-alumni-tab">
            <section class="alumni-section faculty-section">
                <div class="container">
                    <div class="microstite-container">
                        <div class="section--heading sub-heading d-flex justify-content-between">
                            <h2>Our Star Faculty</h2>
                        </div>
                        @if (!empty($alumnies) && $alumnies->count() > 0)
                            @foreach ($alumnies as $alumni)
                                <div class="faculty-card">
                                    <div class="faculty-card__img">
                                        <img src="{{ !empty($alumni->alumni_image) ? Storage::disk('public')->url($alumni->alumni_image) : '../assets/skoodos/assets/img/defaultImages/Alumni-Icon.jpg' }}"
                                            alt="">
                                    </div>
                                    <div class="faculty-card__text">
                                        <h3>{{ $alumni->name }}</h3>
                                        <h4>{{ $alumni->designation }} {{ $alumni->company }}</h4>
                                        <h5>{{ $alumni->exam->name }} ({{ $alumni->year }})</h5>
                                        <p>{{ $alumni->profile }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>

        </div>

        <!-- --------------------- Alumni ------------------- -->
    @endif
</div>
@push('script')
    <script>
        $('#alumni-btn-more').click(function(e) {
            e.preventDefault();
            $('.alumni-show-more').slideToggle("fast");
            if ($('#alumni-card').val() == 1) {
                $('#alumni-card').val(0);
                $('#alumni-btn-more').text("Collapse");
            } else {
                $('#alumni-card').val(1);
                $('#alumni-btn-more').text("Show More");
            }
        });
    </script>
@endpush

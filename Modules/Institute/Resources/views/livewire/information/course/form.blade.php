<div>
    {{-- @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif --}}
    <div class="row">
        <div class="col-md-12">
            @include('institute::layouts.flash-message')
        </div>
    </div>
    <div class="card custom-card shadow-1">
        <div class="card-header d-flex custom-card-header border-bottom-0 ">
            <h3 class="card-title">Exams Tagging</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    {{-- @dd($categoryOptions); --}}
                    <label for="exam_category_id" class="form-label">Exam Category</label>
                    <select name="exam_category_id" id="exam_category_id"
                        class="form-control @error('examCategoryId') is-invalid @enderror"
                        aria-label="Default select example" wire:model="examCategoryId">
                        <option value="">--Select--</option>

                        @foreach ($categoryOptions as $key => $categ)
                            <option value="{{ $categ->category_id }}">{{ $categ->category->name }}</option>
                        @endforeach
                    </select>
                    @error('examCategoryId')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('exam_category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="exam_stream_id" class="form-label">Exam Stream</label>

                    <select name="exam_stream_id" id="exam_stream_id"
                        class="form-control @error('examStreamId') is-invalid @enderror"
                        aria-label="Default select example" wire:model="examStreamId">
                        <option value="">--Select--</option>

                        @foreach ($streamOptions as $stream)
                            <option value="{{ $stream->stream_id }}">{{ $stream->stream->name }}</option>
                        @endforeach
                    </select>
                    @error('examStreamId')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('exam_stream_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="exam" class="form-label">Exam</label>
                    @foreach ($selectedExams as $selectedExam)
                        <input type="hidden" name="exam[]" value="{{ $selectedExam }}">
                    @endforeach
                    <select id="exam"
                        class="form-control select2 class_SelectMultiple  @error('exam') is-invalid @enderror"
                        aria-label="Default select example" wire:model="exam" multiple>

                        @foreach ($examOptions as $key => $option)
                            <option value="{{ $option->exam_id }}">{{ $option->exam->name }}</option>
                        @endforeach
                    </select>

                    @error('exam')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="AddExams" class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-block btn-outline-primary" id="AddExams"
                        wire:click="addSelectedExam()">Add Exams</button>
                </div>
            </div>

            @if (count($selectedExams) > 0)
                <div class="card custom-card shadow-1 mt-3">

                    <div class="card-body">



                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($selectedStreams as $streamskey => $streams)
                                    <div class="py-2 fs-6">
                                        {{ \App\Helpers\Helper::StreamByStreamId($streamskey)->category->name }} >
                                        {{ \App\Helpers\Helper::StreamByStreamId($streamskey)->name }}
                                        <div class="tags">
                                            @foreach ($streams as $key => $exam)
                                                <span
                                                    class="tag">{{ \App\Helpers\Helper::examByExamId($key)->name }}
                                                    <div wire:click="removeSelectedExam({{ $streamskey }},{{ $key }})"
                                                        class="tag-addon"><i class="fe fe-x"></i></div>
                                                </span>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>

    <div class="card custom-card shadow-1">

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="centers" class="form-label">Locations</label>
                    @foreach ($selectedCenters as $selectedCenter)
                        <input type="hidden" name="centers[]" value="{{ $selectedCenter }}">
                    @endforeach
                    <select id="centers" class="form-control @error('centers') is-invalid @enderror"
                        aria-label="Default select example" wire:model="centers">
                        <option value="">--Select--</option>

                        @foreach ($centersOptions as $center)
                            <option value="{{ $center->id }}">{{ $center->area }}, {{ $center->city_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('centers')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">

                    @if (count($selectedCenters) > 0)
                        <div class="card custom-card shadow-1 mt-3">

                            <div class="card-body">



                                <div class="row">
                                    <div class="col-md-12">
                                        <ol>
                                            @foreach ($selectedCenters as $key => $selectedCenter)
                                                <li class="py-2 fs-6">
                                                    {{ \App\Helpers\Helper::CenterBycenterId($selectedCenter)->area }},
                                                    {{ \App\Helpers\Helper::CenterBycenterId($selectedCenter)->city_name }}
                                                    <span class="mx-3"></span>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        wire:click="removeSelectedCenter({{ $selectedCenter }})">Remove</button>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>

    <div class="card custom-card shadow-1">

        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="course_title" class="form-label">Course Title</label>
                    <input name="course_title" type="text"
                        class="form-control @error('courseTitle') is-invalid @enderror" id="course_title"
                        value="{{ old('course_title') }}" wire:model="courseTitle">
                    @error('courseTitle')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('course_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                

                <div class="col-md-3 my-2">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input name="start_date" type="date"
                        class="form-control @error('courseTitle') is-invalid @enderror" id="startDate"
                        value="{{ old('startDate', $startDate) }}" wire:model="startDate">
                    @error('startDate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 my-2">
                    <label for="endDate" class="form-label">End Date</label>
                    <input name="end_date" type="date"
                        class="form-control @error('courseTitle') is-invalid @enderror" id="endDate"
                        value="{{ old('endDate', $endDate) }}" wire:model="endDate">
                    @error('endDate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 my-2">
                    <label for="duration" class="form-label">Duration</label>
                    <select name="duration" id="duration"
                        class="form-control @error('duration') is-invalid @enderror"
                        aria-label="Default select example" wire:model="duration">
                        <option value="">Select Duration</option>
                        @for ($i = 1; $i <= 36; $i++)
                            <option value="{{ $i }}">{{ $i }}
                                {{ $i == 1 ? 'Month' : 'Months' }}
                            </option>
                        @endfor
                    </select>
                    @error('duration')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 my-2">
                    <label for="lastEnrollmentDate" class="form-label">Last Enrollment Date</label>
                    <input name="last_enrollment_date" type="date"
                        class="form-control @error('courseTitle') is-invalid @enderror" id="lastEnrollmentDate"
                        value="{{ old('lastEnrollmentDate', $lastEnrollmentDate) }}" wire:model="lastEnrollmentDate">
                    @error('lastEnrollmentDate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('last_enrollment_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 my-2">
                    <label for="batchSize" class="form-label">Batch Size</label>
                    <input name="batch_size" type="text"
                        class="form-control @error('courseTitle') is-invalid @enderror" id="batchSize"
                        value="{{ old('batchSize', $batchSize) }}" wire:model="batchSize">
                    @error('batchSize')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('batch_size')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-3 my-2">
                    <label for="totalFee" class="form-label">Total Fee</label>
                    <input name="total_fees" type="text"
                        class="form-control @error('courseTitle') is-invalid @enderror" id="totalFee"
                        value="{{ old('totalFee', $totalFee) }}" wire:model="totalFee">
                    @error('totalFee')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('total_fees')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 my-2">
                    <label for="discount" class="form-label">Discount (In %)</label>
                    <input name="discount" type="text"
                        class="form-control @error('discount') is-invalid @enderror" id="discount"
                        value="{{ old('discount', $discount) }}" wire:model="discount">
                    @error('discount')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 my-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="accept_enrollment"
                            id="acceptEnrollment" {{ $acceptEnrollment == true ? 'checked' : '' }}
                            wire:model="acceptEnrollment">
                        <label class="form-check-label" for="acceptEnrollment">
                            {{ __('Allow Course Booking') }}
                        </label>
                    </div>
                </div>

                <div class="col-md-12 my-2" wire:ignore>
                    <label for="description" class="form-label">Description (Max Words:50)</label>
                    <textarea name="description" id="description" cols="30" rows="3"
                        class="form-control @error('description') is-invalid @enderror" id="description" >{{ old('description', $model->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if (!empty($model->id))
                    <div class="col-md-12 my-2">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status"
                            class="form-select @error('status') is-invalid @enderror"
                            aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>
                                Suspended
                            </option>
                            <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if ($isExceedAllowedCourses == true)
                            <div class="text-muted">You can't changes status. You need to suspend any other course
                                first then only you mark this as Active</div>
                        @endif
                    </div>
                @endif

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-2">
            <button class="btn btn-outline-success submit-button"
                @if ($isValidatedForm) type="submit" @else type="button" wire:click="submitForm()" @endif>Submit</button>
        </div>
    </div>
    @if ($isValidatedForm)
        <script>
            $('.submit-button').click();
        </script>
    @endif




    @section('style')
        <style>
            .select2 {
                width: 100% !important;
            }
        </style>
    @endsection

    @section('script')
        <!-- INTERNAL Select2 js -->

        @livewireScripts()
        <script>
            document.addEventListener('livewire:load', function(event) {

                Livewire.hook('message.processed', () => {

                    $('.select2').select2();

                });

            });



            $('.select2').select2();
            $('.select2[multiple]').siblings('.select2-container').append('<span class="select-all"></span>');


            $('#exam').on('change', function(e) {
                Livewire.emit('examListen', $('#exam').val())
            });
        </script>
     
    @endsection

</div>


@push('js')
    <script type="text/javascript">
        document.addEventListener('livewire:load', function() {
            $('#description').summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description', contents);
                    }
                }
            });
        });
    </script>
@endpush

@push('css')
    <style>
        .note-btn-group.note-insert .note-btn:nth-child(2),
        .note-btn-group.note-insert .note-btn:nth-child(3) {
            display: none;
        }
    </style>
@endpush

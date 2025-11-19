<div>
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card shadow-1">
            <div class="card-header d-flex custom-card-header border-bottom-0 ">
                <h3 class="card-title">Exams Tagging</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
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
                        <select id="exam" class="form-control select2 @error('exam') is-invalid @enderror"
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
                                                        class="tag">{{ \App\Helpers\Helper::examByExamId($exam)->name }}
                                                        <div  wire:click="removeSelectedExam({{ $streamskey }},{{ $exam }})"
                                                            class="tag-addon"><i class="fe fe-x"></i></div></span>
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
        <div class="card shadow-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <label for="faculty_name" class="form-label">Name</label>
                        <input name="faculty_name" type="text"
                            class="form-control @error('faculty_name') is-invalid @enderror" id="faculty_name"
                            value="{{ old('faculty_name') }}" wire:model="facultyName">
                        @error('facultyName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('faculty_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="faculty_image" class="form-label">Upload Faculty Image (JPEG) (300
                                Pixels
                                x 300
                                Pixels)(Max
                                File
                                Size:
                                100 KB)</label>

                            <input name="faculty_image" type="file"
                                class="form-control @error('faculty_image') is-invalid @enderror" id="faculty_image"
                                wire:model="facultyImage">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($facultyImage)
                                <div class="image-preview">
                                    Faculty Image Preview:
                                    <img src="{{ $facultyImage->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->faculty_image) && Storage::disk('public')->exists($model->faculty_image))
                                <div class="image-preview">
                                    Faculty Image Preview:
                                    <img src="{{ Storage::disk('public')->url($model->faculty_image) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('facultyImage')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('faculty_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="subject_id" class="form-label">Subject</label>
                        <input name="subject_id" type="text" class="form-control @error('subject_id') is-invalid @enderror"
                            id="subject_id" value="{{ old('subject_id') }}" list="subjects" wire:model="subjectId">
                        @if (!empty($subjectOptions))
                            <datalist id="subjects">
                                @foreach ($subjectOptions as $option)
                                    <option value="{{ $option->ucFirstSubject() }}">
                                @endforeach
                            </datalist>
                        @endif
                        @error('subjectId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('subject_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="description" class="form-label">Description (Max Words:30)</label>
                        <textarea name="description" id="description" cols="30" rows="3"
                            class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description">{{ old('description', $model->description) }}</textarea>
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
                        </div>
                    @endif
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
                </div>
            </div>
        </div>
    </div>
</div>
@section('style')
<style>
    .select2 {
        width: 100% !important;
    }
</style>
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('script')
<!-- INTERNAL Select2 js -->
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

@livewireScripts()
<script>
    document.addEventListener('livewire:load', function(event) {

        Livewire.hook('message.processed', () => {

            $('.select2').select2();

        });

    });



    $('.select2').select2();

   
    $('#exam').on('change', function(e) {
        Livewire.emit('examListen', $('#exam').val())
    });
    
</script>
@endsection

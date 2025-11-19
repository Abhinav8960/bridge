<div>
    <div class="col-lg-12 col-md-12">
        <div class="card shadow-1">
            {{-- <div class="card-header">
                <h3 class="card-title">Exam</h3>
            </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name') }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="designation" class="form-label">Designation</label>
                        <input name="designation" type="text"
                            class="form-control @error('designation') is-invalid @enderror" id="designation"
                            value="{{ old('designation') }}" wire:model="designation">
                        @error('designation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="alumni_image" class="form-label">Upload Alumni Image (JPEG) (300
                                Pixels
                                x 300
                                Pixels)(Max
                                File
                                Size:
                                100 KB)</label>

                            <input name="alumni_image" type="file"
                                class="form-control @error('alumni_image') is-invalid @enderror" id="alumni_image"
                                wire:model="alumniImage">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($alumniImage)
                                <div class="image-preview">
                                    Alumni Image Preview:
                                    <img src="{{ $alumniImage->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->alumni_image) && Storage::disk('public')->exists($model->alumni_image))
                                <div class="image-preview">
                                    Alumni Image Preview:
                                    <img src="{{ Storage::disk('public')->url($model->alumni_image) }}"
                                        width="60px" height="60px">
                                </div>
                            @endif
                        </div>
                        @error('alumniImage')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('alumni_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="company" class="form-label">Company</label>
                        <input name="company" type="text" class="form-control @error('company') is-invalid @enderror"
                            id="company" value="{{ old('company') }}" wire:model="company">
                        @error('company')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="profile" class="form-label">profile (Max Words:30)</label>
                        <textarea name="profile" id="profile" cols="30" rows="3"
                            class="form-control @error('profile') is-invalid @enderror" id="profile" wire:model="profile">{{ old('profile', $model->profile) }}</textarea>
                        @error('profile')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="card shadow-1">
            <div class="card-header">
                <h3 class="card-title">Batch Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="exam_category_id" class="form-label">Exam Category</label>
                        <select name="exam_category_id" id="exam_category_id"
                            class="form-select @error('examCategoryId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="examCategoryId">
                            <option value="">Select Category</option>
                            @foreach ($categoryOptions as $key => $categ)
                                <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                            @endforeach
                        </select>
                        @error('examCategoryId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('exam_category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="exam_stream_id" class="form-label">Exam Stream</label>
                        <select name="exam_stream_id" id="exam_stream_id"
                            class="form-select @error('examStreamId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="examStreamId">
                            <option value="">Select Stream</option>
                            @foreach ($streamOptions as $key => $stream)
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
                    <div class="col-md-6 my-2">
                        <label for="exam_id" class="form-label">Exam</label>
                        <select name="exam_id" id="exam_id" class="form-select @error('examId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="examId">
                            <option value="">Select Exam</option>
                            @foreach ($examOptions as $key => $exam)
                                <option value="{{ $exam->exam_id }}">{{ $exam->exam->name }}</option>
                            @endforeach
                        </select>
                        @error('examId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('exam_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="year" class="form-label">Year</label>
                        <select name="year" id="year" class="form-select @error('year') is-invalid @enderror"
                            aria-label="Default select example" wire:model="year">
                            <option value="">Select Year</option>
                            @for ($i = date('Y'); $i >= 1990; $i--)
                                <option name={{ $i }}>{{ $i }}</option>";
                            @endfor
                            {{-- @foreach (range($latest_year, $earliest_year) as $i)
                                
                                    <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach --}}
                        </select>
                        @error('year')
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
                            <button class="btn btn-outline-success " type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

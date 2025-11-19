<div>
    <div class="row">
        <div class="col-md-12">
            @include('institute::layouts.flash-message-with-modal')
        </div>
    </div>
    <!-- @if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
@endif -->
    <form method="POST" enctype="multipart/form-data" wire:submit.prevent="save">
        @csrf
        <div class="col-lg-12 col-md-12">
            {{-- DESCRIPTION --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Description</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <label for="website" class="form-label">Website</label>
                            <input name="website" type="text"
                                class="form-control @error('website') is-invalid @enderror" id="website"
                                value="{{ $website }}" wire:model="website">
                            @error('website')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2" wire:ignore>
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" wire:model="" class="form-control ckeditor5">{{ old('description', $model->description) }}</textarea>
                            {{-- @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Meta --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Meta Tags</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input name="meta_title" type="text"
                                class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                                value="{{ old('meta_title', $meta_title) }}" wire:model="meta_title">
                            @error('meta_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 my-2">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <input name="meta_description" type="text"
                                class="form-control @error('meta_description') is-invalid @enderror"
                                id="meta_description" value="{{ old('meta_description', $meta_description) }}"
                                wire:model="meta_description">
                            @error('meta_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 my-2">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input name="meta_keywords" type="text"
                                class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords"
                                value="{{ old('meta_keywords', $meta_keywords) }}" wire:model="meta_keywords">
                            @error('meta_keywords')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- CONTACT --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Contact</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="email1" class="form-label">Email 1</label>
                            <input name="email1" type="text"
                                class="form-control @error('email1') is-invalid @enderror" id="email1"
                                value="{{ old('email1', $email1) }}" wire:model="email1">
                            @error('email1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="email2" class="form-label">Email 2</label>
                            <input name="email2" type="text"
                                class="form-control @error('email2') is-invalid @enderror" id="email2"
                                value="{{ old('email2', $email2) }}" wire:model="email2">
                            @error('email2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="phoneType1" class="form-label">Phone Type 1</label>
                            <select name="phoneType1" id="phoneType1"
                                class="form-select @error('phoneType1') is-invalid @enderror"
                                aria-label="Default select example" wire:model="phoneType1">
                                <option value="">--Select Phone Type--</option>

                                @foreach ($phoneTypeOptions as $key => $option)
                                    @if ($model->phoneType1 == $key)
                                        <option value="{{ $key }}" selected>{{ $option }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $option }}</option>
                                    @endif
                                @endforeach

                            </select>
                            @error('phoneType1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="phoneNumber1" class="form-label">Phone Number 1</label>
                            <input name="phoneNumber1" type="text"
                                class="form-control @error('phoneNumber1') is-invalid @enderror"
                                maxlength="@if ($phoneType1 == 'Mobile') 10 @else 12 @endif" id="phoneNumber1"
                                value="{{ old('phoneNumber1', $phoneNumber1) }}" wire:model="phoneNumber1">
                            @error('phoneNumber1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="phoneType2" class="form-label">Phone Type 2</label>
                            <select name="phoneType2" id="phoneType2"
                                class="form-select @error('phoneType2') is-invalid @enderror"
                                aria-label="Default select example" wire:model="phoneType2">
                                <option value="">--Select Phone Type--</option>

                                @foreach ($phoneTypeOptions as $key => $option)
                                    @if ($model->phoneType2 == $key)
                                        <option value="{{ $key }}" selected>{{ $option }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $option }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('phoneType2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="phoneNumber2" class="form-label">Phone Number 2</label>
                            <input name="phoneNumber2" type="text"
                                class="form-control @error('phoneNumber2') is-invalid @enderror"
                                maxlength="@if ($phoneType2 == 'Mobile') 10 @else 12 @endif" id="phoneNumber2"
                                value="{{ old('phoneNumber2', $phoneNumber2) }}" wire:model="phoneNumber2">
                            @error('phoneNumber2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- ADMISSION SCREENING --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Admission Screening</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="admissionScreening" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Admission Screening</span>
                                <input type="checkbox" name="admissionScreening"
                                    class="custom-switch-input form-control @error('admissionScreening') is-invalid @enderror"
                                    id="admissionScreening" {{ $admissionScreening == true ? 'checked' : '' }}
                                    wire:model="admissionScreening" wire:model="admissionScreening">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('admissionScreening')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isAdmissionScreening)
                            <div class="col-md-4 my-2">
                                <label for="admissionScreeningUrl" class="form-label">Admission Screening url</label>
                                <input name="admissionScreeningUrl" type="text"
                                    class="form-control @error('admissionScreeningUrl') is-invalid @enderror"
                                    id="admissionScreeningUrl"
                                    value="{{ old('admissionScreeningUrl', $admissionScreeningUrl) }}"
                                    wire:model="admissionScreeningUrl">
                                @error('admissionScreeningUrl')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="admissionScreeningDescription" class="form-label">Admission Screening
                                    Description
                                    (Max Words:15)</label>
                                <input name="admissionScreeningDescription" type="text"
                                    class="form-control @error('admissionScreeningDescription') is-invalid @enderror"
                                    id="admissionScreeningDescription"
                                    value="{{ old('admissionScreeningDescription', $admissionScreeningDescription) }}"
                                    wire:model="admissionScreeningDescription">
                                @error('admissionScreeningDescription')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 my-2">
                                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <label for="admissionScreeningImage" class="form-label">Upload Image (JPEG) (770
                                        Pixels x 360
                                        Pixels)(Max
                                        File
                                        Size:
                                        100 KB)</label>

                                    <input name="admissionScreeningImage" type="file"
                                        class="form-control @error('admissionScreeningImage') is-invalid @enderror"
                                        id="admissionScreeningImage" wire:model="admissionScreeningImage">
                                    <div class="progress mg-t-5" x-show="isUploading">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                            x-bind:style="`width:${progress}%`"></div>
                                    </div>
                                    @if ($admissionScreeningImage)
                                        <div class="image-preview">
                                            Image Preview:
                                            <img src="{{ $admissionScreeningImage->temporaryUrl() }}" width="60px"
                                                height="60px">
                                        </div>
                                    @elseif (!empty($model->admission_screening_image) && Storage::disk('public')->exists($model->admission_screening_image))
                                        <div class="image-preview">
                                            Image Preview:
                                            <img src="{{ Storage::disk('public')->url($model->admission_screening_image) }}"
                                                width="60px" height="60px">
                                        </div>
                                    @endif
                                </div>
                                @error('admissionScreeningImage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- MOCK TEST --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Mock Test</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="mockTest" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Mock Test</span>
                                <input type="checkbox" name="mockTest"
                                    class="custom-switch-input form-control @error('mockTest') is-invalid @enderror"
                                    id="mockTest" {{ $mockTest == true ? 'checked' : '' }} wire:model="mockTest">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('mockTest')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isMockTest)
                            <div class="col-md-4 my-2">
                                <label for="mockTestUrl" class="form-label">Mock Test url</label>
                                <input name="mockTestUrl" type="text"
                                    class="form-control @error('mockTestUrl') is-invalid @enderror" id="mockTestUrl"
                                    value="{{ old('mockTestUrl', $mockTestUrl) }}" wire:model="mockTestUrl">
                                @error('mockTestUrl')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="mockTestDescription" class="form-label">Mock Test
                                    Description
                                    (Max Words:15)</label>
                                <input name="mockTestDescription" type="text"
                                    class="form-control @error('mockTestDescription') is-invalid @enderror"
                                    id="mockTestDescription"
                                    value="{{ old('mockTestDescription', $mockTestDescription) }}"
                                    wire:model="mockTestDescription">
                                @error('mockTestDescription')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 my-2">
                                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <label for="leadershipImage" class="form-label">Upload Image (JPEG) (770 Pixels x
                                        360
                                        Pixels)(Max
                                        File
                                        Size:
                                        100 KB)</label>

                                    <input name="mockTestImage" type="file"
                                        class="form-control @error('mockTestImage') is-invalid @enderror"
                                        id="mockTestImage" wire:model="mockTestImage">
                                    <div class="progress mg-t-5" x-show="isUploading">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                            x-bind:style="`width:${progress}%`"></div>
                                    </div>
                                    @if ($mockTestImage)
                                        <div class="image-preview">
                                            Image Preview:
                                            <img src="{{ $mockTestImage->temporaryUrl() }}" width="60px"
                                                height="60px">
                                        </div>
                                    @elseif (!empty($model->mock_test_image) && Storage::disk('public')->exists($model->mock_test_image))
                                        <div class="image-preview">
                                            Image Preview:
                                            <img src="{{ Storage::disk('public')->url($model->mock_test_image) }}"
                                                width="60px" height="60px">
                                        </div>
                                    @endif
                                </div>
                                @error('mockTestImage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- LEADERSHIP --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Leadership</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="leadershipName" class="form-label">Name</label>
                            <input name="leadershipName" type="text"
                                class="form-control @error('leadershipName') is-invalid @enderror"
                                id="leadershipName" value="{{ old('leadershipName', $leadershipName) }}"
                                wire:model="leadershipName">
                            @error('leadershipName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="leadershipDesignation" class="form-label">Designation</label>
                            <input name="leadershipDesignation" type="text"
                                class="form-control @error('leadershipDesignation') is-invalid @enderror"
                                id="leadershipDesignation"
                                value="{{ old('leadershipDesignation', $leadershipDesignation) }}"
                                wire:model="leadershipDesignation">
                            @error('leadershipDesignation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <label for="leadershipImage" class="form-label">Upload Image (JPEG) (300 Pixels x 300
                                    Pixels)(Max
                                    File
                                    Size:
                                    100 KB)</label>

                                <input name="leadershipImage" type="file"
                                    class="form-control @error('leadershipImage') is-invalid @enderror"
                                    id="leadershipImage" wire:model="leadershipImage">
                                <div class="progress mg-t-5" x-show="isUploading">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        x-bind:style="`width:${progress}%`"></div>
                                </div>
                                @if ($leadershipImage)
                                    <div class="image-preview">
                                        Image Preview:
                                        <img src="{{ $leadershipImage->temporaryUrl() }}" width="60px"
                                            height="60px">
                                    </div>
                                @elseif (!empty($model->leadership_image) && Storage::disk('public')->exists($model->leadership_image))
                                    <div class="image-preview">
                                        Image Preview:
                                        <img src="{{ Storage::disk('public')->url($model->leadership_image) }}"
                                            width="60px" height="60px">
                                    </div>
                                @endif
                            </div>
                            @error('leadershipImage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2" wire:ignore>
                            <label for="leadershipDescription" class="form-label">Description </label>
                            <textarea name="leadershipDescription" id="leadership_description" cols="30" rows="3"
                                class="form-control ckeditor5">{{ old('leadership_description', $model->leadership_description) }}</textarea>
                            {{-- @error('leadershipDescription')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- featuresOptions --}}
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Features</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($featuresOptions as $option)
                            <div class="col-md-3 my-2">
                                @if ($option->field_type == $inputTypeSelect)
                                    <label for="feature"
                                        class="form-label">{{ Str::ucfirst($option->name) }}</label>
                                    <select name="feature" id="feature"
                                        class="form-select @error('feature') is-invalid @enderror"
                                        aria-label="Default select example" wire:model="feature.{{ $option->id }}">

                                        @foreach ($YesNOOptions as $key => $yesnooption)
                                            @if (isset($feature[$option->id]) && $feature[$option->id] === $key)
                                                <option value="{{ $key }}" selected>{{ $yesnooption }}
                                                </option>
                                            @else
                                                <option value="{{ $key }}">{{ $yesnooption }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @elseif($option->field_type == $inputTypeText)
                                    <label for="feature"
                                        class="form-label">{{ Str::ucfirst($option->name) }}</label>
                                    <input name="feature" type="text"
                                        class="form-control @error('feature') is-invalid @enderror" id="feature"
                                        value="{{ old('feature', isset($feature[$option->id]) ? $feature[$option->id] : '') }}"
                                        wire:model="feature.{{ $option->id }}">
                                @endif
                                @error('feature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 my-2">
                    <button class="btn btn-outline-success " type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
    @include('backend::layouts.ckeditor5',['editorIds' => ['description', 'leadership_description']])
    {{-- @include('backend::layouts.ckeditor5',['setterId'=>'leadership_description']) --}}

</div>
<style>
    .custom-switch {
        padding-left: 0px !important;
    }
</style>

@push('js')
    @livewireScripts()
@endpush

{{-- @push('js')
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

            $('#leadership_description').summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('leadershipDescription', contents);
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
@endpush --}}

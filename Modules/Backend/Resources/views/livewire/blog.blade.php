<div>
    {{-- @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif --}}

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 my-2">
                        <label for="title" class="form-label">Blog Title
                        </label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" value="{{ old('title', $title) }}" wire:model="title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="title" class="form-label">Slug
                        </label>
                        <input name="post_slug" type="text"
                            class="form-control @error('postSlug') is-invalid @enderror" id="post_slug"
                            wire:model="postSlug">
                        @error('postSlug')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="sub_title" class="form-label">Blog Sub Title (Max 75 Characters ) </label>
                        <input name="sub_title" type="text"
                            class="form-control @error('sub_title') is-invalid @enderror" id="sub_title"
                            value="{{ old('sub_title', $sub_title) }}" wire:model="sub_title">
                        @error('sub_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="author" class="form-label">Author Name
                        </label>
                        <input name="author" type="text" class="form-control @error('author') is-invalid @enderror"
                            id="author" wire:model="author">
                        @error('author')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="image" class="form-label">Featured Image (Single)(Upload)(JPEG,WEBP)(Maximum
                                Size: 100 KB)</label>

                            <input name="image" type="file"
                                class="form-control @error('image') is-invalid @enderror" id="image"
                                wire:model="image">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($image)
                                <div class="image-preview">
                                    image Preview:
                                    <img src="{{ $image->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->image) && Storage::disk('public')->exists($model->image))
                                <div class="image-preview">
                                    image Preview:
                                    <img src="{{ Storage::disk('public')->url($model->image) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 my-2">
                        <label for="featured_alt" class="form-label">Featured Image Alt
                        </label>
                        <input name="featured_alt" type="text"
                            class="form-control @error('featured_alt') is-invalid @enderror" id="featured_alt"
                            wire:model="featured_alt">
                        @error('featured_alt')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="image" class="form-label">Gallery Images
                                (Multiple)(Upload)(JPEG,WEBP)(Maximum Size: 100 KB)
                            </label>

                            <input name="images[]" type="file"
                                class="form-control @error('images.*') is-invalid @enderror" wire:model="images"
                                multiple>
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($images)
                                @foreach ($images as $key => $value)
                                    <div class="image-preview">
                                        image Preview:

                                        <img src="{{ $images[$key]->temporaryUrl() }}" width="60px"
                                            height="60px">

                                    </div>
                                @endforeach
                            @elseif ($model->images->count() > 0)
                                <div class="image-preview">
                                    Gallery Images Preview:
                                    @if (count($model->images) >= 1)
                                        <table class="table">

                                            @foreach ($model->images as $image)
                                                <tr>
                                                    <td>
                                                        <img src="{{ Storage::disk('public')->url($image->image) }}"
                                                            width="60px" height="60px">
                                                        <a class="btn btn-md btn-dark active" style="float:right"
                                                            wire:click="resetImage({{ $image->id }})">Remove</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                </div>
                            @endif
                        </div>
                        @error('images')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                    </div> --}}

                    {{-- alt code --}}

                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="image" class="form-label">Gallery Images (Multiple)(Upload)(JPEG, WEBP)(Max:
                                100 KB)</label>

                            <input name="images[]" type="file"
                                class="form-control @error('images.*') is-invalid @enderror" wire:model="images"
                                multiple>

                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>

                            @if ($images)
                                @foreach ($images as $key => $value)
                                    <div class="image-preview my-3">
                                        <div>Image Preview:</div>
                                        <img src="{{ $images[$key]->temporaryUrl() }}" width="60px"
                                            height="60px">

                                        {{-- Alt text input for each uploaded image --}}
                                        <input type="text" name="gallery_alt[]" class="form-control mt-2"
                                            placeholder="Gallery alt name" maxlength="150">
                                    </div>
                                @endforeach
                            @elseif ($model->images->count() > 0)
                                <div class="image-preview">
                                    Gallery Images Preview:
                                    @if (count($model->images) >= 1)
                                        <table class="table">
                                            @foreach ($model->images as $image)
                                                <tr>
                                                    <td>
                                                        <img src="{{ Storage::disk('public')->url($image->image) }}"
                                                            width="60px" height="60px">

                                                        <a class="btn btn-md btn-dark active" style="float:right"
                                                            wire:click="resetImage({{ $image->id }})">Remove</a>

                                                        {{-- <input type="text" name="alt_texts[]"
                                                            class="form-control mt-2"
                                                            value="{{ $image->gallery_alt }}"
                                                            placeholder="Gallery alt name"
                                                            maxlength="150" wire:change="ImageAltChange({{ $image->id }})"> --}}

                                                            <input type="text" name="alt_texts[]"
                                                            class="form-control mt-2"
                                                            placeholder="Gallery alt name"
                                                            maxlength="150"
                                                            wire:model.lazy="gallery_alt.{{ $image->id }}"
                                                            wire:change="updateImageAlt({{ $image->id }})">


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Validation errors --}}
                        @error('images')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 my-2" wire:ignore>
                        <label for="description" class="form-label">Post Body </label>
                        <textarea name="description" id="description" cols="30" rows="2"
                            class="form-control ckeditor5 @error('description') is-invalid @enderror">{{ old('description', $description) }}

                        </textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="is_comment" class="form-label">Comment Allowed</label>
                        <select name="is_comment" id="is_comment"
                            class="form-select @error('isComment') is-invalid @enderror"
                            aria-label="Default select example" wire:model="isComment">
                            <option value="">Select Comment Allowed</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('isComment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($isComment == 1)
                        <div class="col-md-6 my-2">
                            <label for="is_approved" class="form-label">Approval Required</label>
                            <select name="is_approved" id="is_approved"
                                class="form-select @error('isApproved') is-invalid @enderror"
                                aria-label="Default select example" wire:model="isApproved">
                                <option value="">Select Approval Required</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('isApproved')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    @if (!empty($model->id))
                        <div class="col-md-6 my-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example">
                                <option value="">Select Status</option>
                                <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>
                                    Suspended
                                </option>
                                <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="2" {{ $model->status == 2 ? 'selected' : '' }}>
                                    Scheduled
                                </option>

                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="col-md-6 my-2">
                        <label for="meta_title" class="form-label">Meta Title Tag
                        </label>
                        <input name="meta_title" type="text"
                            class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                            value="{{ old('meta_title', $meta_title) }}" wire:model="meta_title">
                        @error('meta_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="meta_keywords" class="form-label">Meta keywords Tag
                        </label>
                        <input name="meta_keywords" type="text"
                            class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords"
                            value="{{ old('meta_keywords', $meta_keywords) }}" wire:model="meta_keywords">
                        @error('meta_keywords')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 my-2">
                        <label for="meta_description" class="form-label">Meta Description </label>
                        <textarea name="meta_description" id="meta_description" cols="30" rows="2"
                            class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                            wire:model="meta_description">{{ old('meta_description', $model->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12  supercategory d-flex">
                        <label class="form-label">Categories</label>
                        @foreach ($categoriesId as $categoriesId)
                            <input type="hidden" name="category_id[]" value="{{ $categoriesId }}">
                        @endforeach
                        @if (count($categoryOptions) > 0)
                            @foreach ($categoryOptions as $cat)
                                <div class="row " style="margin-top:14px; margin-left: 20px;">
                                    <div class="col-md-12">
                                        <input type="checkbox" wire:model="categoriesId"
                                            value="{{ $cat->id }}"> {{ $cat->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @error('categoriesId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>




                    <div class="col-md-4 my-5">
                        <label for="schedule" class="form-label custom-switch">
                            <span class="custom-switch-description tx-14">schedule</span>
                            <input type="checkbox" name="schedule"
                                class="custom-switch-input form-control @error('schedule') is-invalid @enderror"
                                id="schedule" {{ $schedule == true ? 'checked' : '' }} wire:model="schedule">
                            <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                        </label>
                        @error('schedule')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($isSchedule)
                        <div class="col-md-6 my-2">
                            <label for="published_date_time" class="form-label">Published Date-Time</label>
                            <input name="published_date_time" type="datetime-local"
                                class="form-control @error('publishedDateTime') is-invalid @enderror"
                                id="publishedDateTime" wire:model="publishedDateTime">
                            @error('publishedDateTime')
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
    @include('backend::layouts.ckeditor5', ['editorIds' => ['description']])



</div>


<style>
    .custom-switch {
        padding-left: 0px !important;
    }
</style>
{{-- @push('js')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description', {
            format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div'
        });

        const editor = CKEDITOR.instances.description;
        editor.on('change', function(event) {
            console.log(event.editor.getData());
            @this.set('description', event.editor.getData());
        });
    </script>
@endpush --}}

{{--
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
@endpush --}}

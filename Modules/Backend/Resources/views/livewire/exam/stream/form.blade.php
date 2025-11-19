<div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Exam Stream</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="category_id" class="form-label">Exam Category</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="category_id">
                            <option value="">Select Category</option>
                            @foreach ($category as $key => $categ)
                                @if ($categ->id == old('category_id', !empty($model->category_id) ? $model->category_id : ''))
                                    <option value="{{ $categ->id }}" selected>{{ $categ->name }}</option>
                                @else
                                    <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $model->name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="icon" class="form-label">Upload Icon (PNG)(60 Pixels x 60 Pixels)(Max File
                                Size: 100 KB)</label>

                            <input name="icon" type="file"
                                class="form-control @error('icon') is-invalid @enderror" id="icon"
                                wire:model="icon">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($icon)
                                <div class="image-preview">
                                    Icon Preview:
                                    <img src="{{ $icon->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->icon) && Storage::disk('public')->exists($model->icon))
                                <div class="image-preview">
                                    Icon Preview:
                                    <img src="{{ Storage::disk('public')->url($model->icon) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('icon')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="icon_hover" class="form-label">Upload Icon Hover (PNG)(60 Pixels x 60
                                Pixels)(Max File Size: 100 KB)</label>

                            <input name="icon_hover" type="file"
                                class="form-control @error('icon_hover') is-invalid @enderror" id="icon_hover"
                                wire:model="icon_hover">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($icon_hover)
                                <div class="image-preview">
                                    Icon Hover Preview:
                                    <img src="{{ $icon_hover->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->icon_hover) && Storage::disk('public')->exists($model->icon_hover))
                                <div class="image-preview">
                                    Icon Hover Preview:
                                    <img src="{{ Storage::disk('public')->url($model->icon_hover) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('icon_hover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="priority" class="form-label">Priority</label>
                        <select name="priority" id="priority"
                            class="form-select @error('priority') is-invalid @enderror"
                            aria-label="Default select example" wire:model="priority">
                            <option value="1" {{ $model->priority == 1 ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="0" {{ $model->priority == 0 ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                        @error('priority')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="is_show_homepage" class="form-label">Publish On Homepage</label>
                        <select name="is_show_homepage" id="is_show_homepage"
                            class="form-select @error('isShowHomepage') is-invalid @enderror"
                            aria-label="Default select example" wire:model="isShowHomepage">
                            <option value="0">
                                No
                            </option>
                            <option value="1">
                                Yes
                            </option>
                        </select>
                        @error('isShowHomepage')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="is_show_categorypage" class="form-label">Publish On Category</label>
                        <select name="is_show_categorypage" id="is_show_categorypage"
                            class="form-select @error('isShowCategorypage') is-invalid @enderror"
                            aria-label="Default select example" wire:model="isShowCategorypage">
                            <option value="0">
                                No
                            </option>
                            <option value="1">
                                Yes
                            </option>
                        </select>
                        @error('isShowCategorypage')
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

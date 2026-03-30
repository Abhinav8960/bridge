<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 my-2">
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

                            <label for="icon" class="form-label">Feature Icon (PNG) (Max
                                File Size: 100 KB)</label>

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
                        <label for="field_type" class="form-label">Type</label>
                        <select name="field_type" id="field_type"
                            class="form-select @error('type') is-invalid @enderror"
                            aria-label="Default select example" wire:model="type">
                            <option value="">Select Type</option>
                            @foreach ($typeOptions as $key => $option)
                                @if ($model->field_type == $key)
                                    <option value="{{ $key }}" selected>{{ $option }}</option>
                                @else
                                <option value="{{ $key }}">{{ $option }}</option>
                                @endif
                            @endforeach

                        </select>
                        @error('type')
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

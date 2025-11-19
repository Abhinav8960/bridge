<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
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
                        <label for="stream_id" class="form-label">Exam Stream</label>
                        <select name="stream_id" id="stream_id"
                            class="form-select @error('stream_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="stream_id">
                            <option value="">Select Stream</option>
                            @foreach ($streams as $key => $stream)
                                @if ($stream->id == old('stream_id', !empty($model->stream_id) ? $model->stream_id : ''))
                                    <option value="{{ $stream->id }}" selected>{{ $stream->name }}</option>
                                @else
                                    <option value="{{ $stream->id }}">{{ $stream->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('stream_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Short Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $model->name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Full Name</label>
                        <input name="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror"
                            id="fullname" value="{{ old('fullname', $model->fullname) }}" wire:model="fullname">
                        @error('fullname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="icon" class="form-label">Upload Icon (JPEG) (300 Pixels x 200 Pixels)(Max
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

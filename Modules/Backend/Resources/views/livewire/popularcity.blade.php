<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Popular City</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <label for="state_id" class="form-label">State</label>
                        <select name="state_id" id="state_id"
                            class="form-select @error('state_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="state_id">
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" data-id="{{ $state->state }}">{{ $state->state }}
                                </option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="city_id" class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="city_id">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" data-id="{{ $city->city }}" selected>
                                    {{ $city->city }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 my-2">
                        <label for="is_featured" class="form-label">Is Featured</label>
                        <select name="is_featured" id="is_featured"
                            class="form-select @error('is_featured') is-invalid @enderror"
                            aria-label="Default select example" wire:model="isFeatured">
                            <option value="">Select</option>
                            @foreach ($YesNoOptions as $key => $yesNo)
                                <option value="{{ $key }}">{{ $yesNo }}</option>
                            @endforeach
                        </select>
                        @error('isFeatured')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="icon" class="form-label">Upload Icon (JPEG) (270 Pixels x 200
                                Pixels)(Max
                                File
                                Size:
                                100 KB)</label>

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
                    <div class="col-md-4 my-2"><label for="is_metro" class="form-inline text-dark fs-6">
                            <input type="checkbox" name="is_metro" id="is_metro" checked=""
                                class="form-group mt-0 me-2 @error('is_metro') is-invalid @enderror"
                                wire:model="is_metro">
                            Metro</label>
                        @error('is_metro')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <button class="btn btn-outline-success " type="submit"
                                wire:model="submitButton">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

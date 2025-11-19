<div>
    <div class="row">
        <div class="col-md-12">
            @include('institute::layouts.flash-message')
        </div>
    </div>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 col-md-12">
            <div class="card shadow">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <label for="logo" class="form-label">Upload Logo (JPEG) (400 Pixels x 400
                                    Pixels)(Max
                                    File
                                    Size:
                                    100 KB)</label>

                                <input name="logo" type="file"
                                    class="form-control @error('logo') is-invalid @enderror" id="logo"
                                    wire:model="logo">
                                <div class="progress mg-t-5" x-show="isUploading">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        x-bind:style="`width:${progress}%`"></div>
                                </div>
                                @if (!empty($model->logo) && Storage::disk('public')->exists($model->logo))
                                    <div class="image-preview">
                                        Logo Preview:
                                        <img src="{{ Storage::disk('public')->url($model->logo) }}" width="60px"
                                            height="60px">
                                    </div>
                                @endif
                            </div>
                            @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label for="leaderboard" class="form-label">Upload Leaderboard (JPEG) (1550 Pixels x 300
                                    Pixels)(Max
                                    File
                                    Size: 100 KB)</label>

                                <input name="leaderboard" type="file"
                                    class="form-control @error('leaderboard') is-invalid @enderror" id="leaderboard"
                                    wire:model="leaderboard">
                                <div class="progress mg-t-5" x-show="isUploading">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        x-bind:style="`width:${progress}%`"></div>
                                </div>
                                @if (!empty($model->leaderboard) && Storage::disk('public')->exists($model->leaderboard))
                                    <div class="image-preview">
                                        Leaderboard Preview:
                                        <img src="{{ Storage::disk('public')->url($model->leaderboard) }}"
                                            width="60px" height="60px">
                                    </div>
                                @endif
                            </div>
                            @error('leaderboard')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label for="corporate_brochure" class="form-label">Upload Corporate Brochure (PDF) (Max
                                    File
                                    Size: 10 MB)</label>

                                <input name="corporateBrochure" type="file"
                                    class="form-control @error('corporateBrochure') is-invalid @enderror"
                                    id="corporateBrochure" wire:model="corporateBrochure">
                                <div class="progress mg-t-5" x-show="isUploading">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        x-bind:style="`width:${progress}%`"></div>
                                </div>
                                @if (!empty($model->corporate_brochure) && Storage::disk('public')->exists($model->corporate_brochure))
                                    <div class="image-preview">
                                        Corporate Brochure Preview:
                                        @php
                                            $corporate_brochure_arr = explode('/', $model->corporate_brochure);
                                        @endphp
                                        <a
                                            href="{{ Storage::disk('public')->url($model->corporate_brochure) }}">{{ end($corporate_brochure_arr) }}</a>
                                    </div>
                                @endif
                            </div>
                            @error('corporateBrochure')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2">
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label for="image" class="form-label">Upload Gallery Images (JPEG) (600 Pixels
                                    x 600
                                    Pixels)(Max
                                    File
                                    Size: 100 KB/image)</label>

                                <input name="images[]" type="file"
                                    class="form-control @error('images.*') is-invalid @enderror" wire:model="images"
                                    multiple>
                                <div class="progress mg-t-5" x-show="isUploading">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        x-bind:style="`width:${progress}%`"></div>
                                </div>
                                @if ($model->images->count() > 0)
                                    <div class="image-preview">
                                        Gallery Images Preview:

                                        @if (!empty($flashmsg))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ $flashmsg }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close" wire:click="flashReset()">&times</button>
                                            </div>
                                        @endif
                                        
                                        @if (count($model->images) >= 1)
                                            <table class="table">

                                                @foreach ($model->images as $image)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ Storage::disk('public')->url($image->image) }}"
                                                                width="60px" height="60px">
                                                        </td>
                                                        <td>
                                                            <label for="start_date"
                                                                class="form-label">Captions</label>

                                                            <input name="start_date" type="text"
                                                                class="form-control @error('captions.{{ $image->id }}') is-invalid @enderror"
                                                                name="captions.{{ $image->id }}"
                                                                wire:model="captions.{{ $image->id }}">

                                                        </td>
                                                        <td>
                                                            <label for="start_date" class="form-label">Alt</label>

                                                            <input name="start_date" type="text"
                                                                class="form-control @error('alt.{{ $image->id }}') is-invalid @enderror"
                                                                name="alt.{{ $image->id }}"
                                                                wire:model="alt.{{ $image->id }}">
                                                        </td>

                                                        <td>
                                                            <label for="start_date" class="form-label">&nbsp;</label>

                                                            <button type="button" class="btn btn-danger btn-block"
                                                                wire:click="deleteId({{ $image->id }})"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">Remove</button>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

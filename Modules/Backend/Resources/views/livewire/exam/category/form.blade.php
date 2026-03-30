<div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Exam Category</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-4 my-2">
                        <label for="teasure_line" class="form-label">Teasure Line (Max Words:10)</label>
                        <input name="teasure_line" type="text"
                            class="form-control @error('teasure_line') is-invalid @enderror" id="teasure_line"
                            value="{{ old('teasure_line', $teasure_line) }}" wire:model="teasure_line">
                        @error('teasure_line')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="icon" class="form-label">Upload Icon (JPEG) (144 Pixels x 144
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
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="banner" class="form-label">Upload Banner (JPEG) (1600 Pixels x 325
                                Pixels)(Max
                                File
                                Size: 100 KB)</label>

                            <input name="banner" type="file"
                                class="form-control @error('banner') is-invalid @enderror" id="banner"
                                wire:model="banner">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($banner)
                                <div class="image-preview">
                                    Banner Preview:
                                    <img src="{{ $banner->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->banner) && Storage::disk('public')->exists($model->banner))
                                <div class="image-preview">
                                    Banner Preview:
                                    <img src="{{ Storage::disk('public')->url($model->banner) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('banner')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="description" class="form-label">Description (Max Words:75)</label>
                        <textarea name="description" id="description" cols="30" rows="2"
                            class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description">{{ old('description', $model->description) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
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
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Billing</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <label for="name" class="form-label">Booking Fees</label>
                                <input name="booking_fees" type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name', $model->bookingFees) }}" wire:model="bookingFees">
                                @error('bookingFees')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('booking_fees')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 my-2">
                                <label for="tax_id" class="form-label">Tax</label>
                                <select name="tax_id" id="tax_id"
                                    class="form-select @error('taxId') is-invalid @enderror"
                                    aria-label="Default select example" wire:model="taxId">
                                    <option value="">Select Tax</option>
                                    @if (!empty($taxOptions))
                                        @foreach ($taxOptions as $tax)
                                            <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->percentage }}%)</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('taxId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="row">
                            <div class="col-md-4 my-2">
                                <label for="is_show_homepage" class="form-label">Sac Code</label>
                                <select name="sac_code_id" id="sac_code_id"
                                    class="form-select @error('sacCodeId') is-invalid @enderror"
                                    aria-label="Default select example" wire:model="sacCodeId">
                                    <option value="">Select Sac Code</option>
                                    @if (!empty($sacCodeOptions))
                                        @foreach ($sacCodeOptions as $saccode)
                                            <option value="{{ $saccode->id }}">{{ $saccode->sac_code }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('sacCodeId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="billing_account_id" class="form-label">Billing Account</label>
                                <select name="billing_account_id" id="billing_account_id"
                                    class="form-select @error('billingAccountId') is-invalid @enderror"
                                    aria-label="Default select example" wire:model="billingAccountId">
                                    <option value="">Select Billing Account</option>
                                    @foreach ($billingOptions as $billingacc)
                                        <option value="{{ $billingacc->id }}">
                                            {{ $billingacc->nick_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('billingAccountId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="tax_type_id" class="form-label">Tax Scope</label>
                                <select name="tax_type_id" id="tax_type_id"
                                    class="form-select @error('tax_type_id') is-invalid @enderror"
                                    aria-label="Default select example" wire:model="taxTypeId">
                                    <option value="">Select Option</option>
                                    <option value="1">
                                        Inclusive
                                    </option>
                                    <option value="2">
                                        Exclusive
                                    </option>
                                </select>
                                @error('tax_type_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('taxTypeId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mobile Banner</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="mobile_dashboard_banner" class="form-label">Upload Mobile
                                Dashboard Banner
                                (PNG) (1080 Pixels x 400
                                Pixels)(Max
                                File
                                Size:
                                150 KB)</label>

                            <input name="mobile_dashboard_banner" type="file"
                                class="form-control @error('mobile_dashboard_banner') is-invalid @enderror"
                                id="mobile_dashboard_banner" wire:model="mobile_dashboard_banner">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($mobile_dashboard_banner)
                                <div class="image-preview">
                                    Mobile Dashboard Banner Preview:
                                    <img src="{{ $mobile_dashboard_banner->temporaryUrl() }}" width="60px"
                                        height="60px">
                                </div>
                            @elseif (!empty($model->mobile_dashboard_banner) && Storage::disk('public')->exists($model->mobile_dashboard_banner))
                                <div class="image-preview">
                                    Mobile Dashboard Banner Preview:
                                    <img src="{{ Storage::disk('public')->url($model->mobile_dashboard_banner) }}"
                                        width="60px" height="60px">
                                </div>
                            @endif
                        </div>
                        @error('mobile_dashboard_banner')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label for="mobile_category_page_banner" class="form-label">Upload Mobile
                                Category Page
                                Banner (JPEG) (1080 Pixels x 450
                                Pixels)(Max
                                File
                                Size:
                                100 KB)</label>

                            <input name="mobile_category_page_banner" type="file"
                                class="form-control @error('mobile_category_page_banner') is-invalid @enderror"
                                id="mobile_category_page_banner" wire:model="mobile_category_page_banner">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($mobile_category_page_banner)
                                <div class="image-preview">
                                    Mobile Category Page Banner Preview:
                                    <img src="{{ $mobile_category_page_banner->temporaryUrl() }}" width="60px"
                                        height="60px">
                                </div>
                            @elseif (!empty($model->mobile_category_page_banner) && Storage::disk('public')->exists($model->mobile_category_page_banner))
                                <div class="image-preview">
                                    Mobile Category Page Banner Preview:
                                    <img src="{{ Storage::disk('public')->url($model->mobile_category_page_banner) }}"
                                        width="60px" height="60px">
                                </div>
                            @endif
                        </div>
                        @error('mobile_category_page_banner')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
    </div>
</div>

<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Billing Account</h3>
            </div>
            <div class="card-body">
                {{-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif --}}
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input name="company_name" type="text"
                            class="form-control @error('companyName') is-invalid @enderror" id="company_name"
                            value="{{ old('company_name', $model->company_name) }}" wire:model="companyName">
                        @error('companyName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="company_logo" class="form-label">Company Logo (PNG , JPEG) (400 Pixels
                                x
                                200
                                Pixels)(Max
                                File
                                Size:
                                100 KB)</label>

                            <input name="company_logo" type="file"
                                class="form-control @error('companyLogo') is-invalid @enderror" id="company_logo"
                                wire:model="companyLogo">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($companyLogo)
                                <div class="image-preview">
                                    Icon Preview:
                                    <img src="{{ $companyLogo->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($model->company_logo) && Storage::disk('public')->exists($model->company_logo))
                                <div class="image-preview">
                                    Company Logo Preview:
                                    <img src="{{ Storage::disk('public')->url($model->company_logo) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('companyLogo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('company_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="nick_name" class="form-label">Nick Name</label>
                        <input name="nick_name" type="text"
                            class="form-control @error('nickName') is-invalid @enderror" id="nick_name"
                            value="{{ old('nick_name', $model->nick_name) }}" wire:model="nickName">
                        @error('nickName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('nick_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="gst_number" class="form-label">GST Number</label>
                        <input name="gst_number" type="text"
                            class="form-control @error('gstNumber') is-invalid @enderror" id="gst_number"
                            value="{{ old('gst_number', $model->gstNumber) }}" wire:model="gstNumber">
                        @error('gstNumber')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('gst_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="pan_number" class="form-label">PAN Number</label>
                        <input name="pan_number" type="text"
                            class="form-control @error('panNumber') is-invalid @enderror" id="pan_number"
                            value="{{ old('pan_number', $model->panNumber) }}" wire:model="panNumber">
                        @error('panNumber')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('pan_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="formation_type" class="form-label">Formation Type</label>
                        <select name="formation_type" id="formation_type"
                            class="form-select @error('formation_type') is-invalid @enderror"
                            aria-label="Default select example" wire:model="formationType">
                            <option value="">Select Formation Type</option>
                            @if (!empty($formationTypeOptions))
                                @foreach ($formationTypeOptions as $key => $type)
                                    {{-- @dd($key, $type); --}}
                                    @if (old('formation_type', !empty($formationType) ? $formationType : ''))
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error('formationType')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('formation_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="formation_date" class="form-label">Formation Date</label>
                        <input name="formation_date" type="date"
                            class="form-control @error('formationDate') is-invalid @enderror" id="formation_date"
                            value="{{ old('formation_date', $model->formation_date) }}" wire:model="formationDate">
                        @error('formation_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('formationDate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email', $model->email) }}" wire:model="email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="phone" class="form-label">Phone</label>
                        <input name="phone" type="tel" maxlength="10"
                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                            value="{{ old('phone', $model->phone) }}" wire:model="phone">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="address" class="form-label">Address</label>
                        <input name="address" type="text"
                            class="form-control @error('address') is-invalid @enderror" id="address"
                            value="{{ old('address', $model->address) }}" wire:model="address">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="country_id" class="form-label">Country</label>
                        <select name="country_id" id="country_id"
                            class="form-select @error('country_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="countryId">
                            {{-- <option value="">Select Country</option> --}}
                            {{-- @foreach ($countries as $country) --}}

                            <option value="{{ !empty($country->id) ? $country->id : 1 }}">
                                {{ !empty($country->country_name) ? $country->country_name : 'India' }}</option>
                            {{-- @endforeach --}}
                        </select>
                        @error('country_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="state_id" class="form-label">State</label>
                        <select name="state_id" id="state_id"
                            class="form-select @error('state_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="stateId">
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                                @if (old('state_id', !empty($stateId) ? $stateId : ''))
                                    <option value="{{ isset($state->id) ? $state->id : $state['id'] }}">
                                        {{ isset($state->state) ? $state->state : $state['state'] }}</option>
                                @else
                                    <option value="{{ isset($state->id) ? $state->id : $state['id'] }}">
                                        {{ isset($state->state) ? $state->state : $state['state'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('state_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="city_id" class="form-label">City</label>
                        <select name="city_id" id="city_id"
                            class="form-select @error('city_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="cityId">
                            <option value="">Select City</option>
                            @if (!empty($cities))
                                @foreach ($cities as $city)
                                    @if (old('city_id', !empty($cityId) ? $cityId : ''))
                                        <option value="{{ isset($city->id) ? $city->id : $city['id'] }}">
                                            {{ isset($city->city) ? $city->city : $city['city'] }}</option>
                                    @else
                                        <option value="{{ isset($city->id) ? $city->id : $city['id'] }}">
                                            {{ isset($city->city) ? $city->city : $city['city'] }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="area" class="form-label">Area</label>
                        <input name="area" type="text"
                            class="form-control @error('area') is-invalid @enderror" id="area"
                            value="{{ old('area', $model->area) }}" list="areas" wire:model="area"
                            autocomplete="off">
                        @if (!empty($areas))
                            <datalist id="areas">
                                @foreach ($areas as $area)
                                    <option value="{{ isset($area->area) ? $area->area : $area['area'] }}">
                                @endforeach

                            </datalist>
                        @endif
                        @error('area')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input name="pincode" type="tel"
                            class="form-control @error('pincode') is-invalid @enderror" id="pincode"
                            value="{{ old('pincode', $model->pincode) }}" wire:model.lazy="pincode"
                            @if ($isPincodeReadOnly) readonly @endif>
                        @error('pincode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (!empty($model->id))
                        <div class="col-md-6 my-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example" @if ($model->is_plan_expired == true) disabled @endif>
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

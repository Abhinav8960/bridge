<div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Institutes</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $model->name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="authorized_person" class="form-label">Authorized Person</label>
                        <input name="authorized_person" type="text"
                            class="form-control @error('authorized_person') is-invalid @enderror" id="authorized_person"
                            value="{{ old('authorized_person', $model->authorized_person) }}"
                            wire:model="authorized_person">
                        @error('authorized_person')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" value="{{ old('email', $model->email) }}" wire:model="email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="mobile" class="form-label">Phone</label>
                        <input name="mobile" type="tel" maxlength="10"
                            class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                            value="{{ old('mobile', $model->mobile) }}" wire:model="mobile">
                        @error('mobile')
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
                        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror"
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
                        <input name="area" type="text" class="form-control @error('area') is-invalid @enderror"
                            id="area" value="{{ old('area', $model->area) }}" list="areas" wire:model="area"
                            autocomplete="off">
                        @if (!empty($areas))
                            <datalist id="areas">
                                @foreach ($areas as $area)
                                    <option value="{{ isset($area->area) ? $area->area : $area['area'] }}">
                                @endforeach

                            </datalist>
                        @endif
                        <input name="area_id" type="hidden" value="{{ $areaId }}" wire:model="areaId"
                            autocomplete="off">
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

                    <div class="col-md-6 my-2">
                        <label for="google_institute_address" class="form-label">Google Institute Address</label>
                        <input name="google_institute_address" type="text"
                            class="form-control @error('google_institute_address') is-invalid @enderror"
                            id="location" value="{{ old('google_institute_address', $googleInstituteAddress) }}"
                            wire:model="googleInstituteAddress">


                        @error('googleInstituteAddress')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('google_institute_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="latitude" wire:model="latitude" value="{{ $latitude }}">
                    <input type="hidden" name="longitude" wire:model="longitude" value="{{ $longitude }}">
                    @if (!empty($model->id))
                        <div class="col-md-6 my-3">
                            <label for="package_id" class="form-label">Package</label>
                            {{ $model->package->name }}
                        </div>
                        <div class="col-md-6 my-3">
                            <label for="package_id" class="form-label">Duration</label>
                            @if ($packageId == $starterPackage)
                                {{ $model->package->no_of_days }} days
                            @else
                                {{ \App\Helpers\Helper::AsPerValidityOptions(true)[$model->duration] }}
                            @endif
                        </div>
                    @else
                        <div class="@if ($packageId != $starterPackage) col-md-3 @else col-md-6 @endif my-2">
                            <label for="package_id" class="form-label">Package</label>
                            <select name="package_id" id="package_id"
                                class="form-select @error('package_id') is-invalid @enderror"
                                aria-label="Default select example" wire:model="packageId">
                                <option value="">Select Package</option>
                                @foreach ($packages as $package)
                                    @if ($package->id == old('package_id', !empty($model->package_id) ? $model->package_id : ''))
                                        <option value="{{ $package->id }}" selected>{{ $package->name }}</option>
                                    @else
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('package_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('packageId')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($packageId != $starterPackage)
                            <div class="col-md-3 my-2">
                                <label for="duration" class="form-label">Duration</label>
                                <select name="duration" id="duration"
                                    class="form-select @error('duration') is-invalid @enderror"
                                    aria-label="Default select example" wire:model="duration">
                                    <option value="">Select Duration</option>
                                    @foreach ($durationOption as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('duration')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                    @endif



                    <div class="col-md-12 my-2">
                        <label for="priority" class="form-label">Is Recommended</label>
                        <select name="is_recommended" id="is_recommended"
                            class="form-select @error('is_recommended') is-invalid @enderror"
                            aria-label="Default select example">
                            <option value="1" {{ $model->is_recommended == 1 ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="0" {{ $model->is_recommended == 0 ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                        @error('is_recommended')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!empty($model->id))
                        <div class="col-md-12 my-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example"
                                @if ($model->is_plan_expired == true) disabled @endif>
                                <option value="">Select Status</option>
                                <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>
                                    Suspended
                                </option>
                                <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>
                                    Active
                                </option>
                            </select>
                            @if ($model->is_plan_expired == true)
                                <div class="text-muted">Account is expired you can't changes status.</div>
                            @endif
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
<script
    src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDQj64DvcTdPsuh8cBpnrCnQZWUhawOEBk&libraries=places">
</script>
<script>
    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        Livewire.emit('getLocationForInput', place.formatted_address);
        Livewire.emit('getLatitudeForInput', place.geometry['location'].lat());
        Livewire.emit('getLongitudeForInput', place.geometry['location'].lng());
    });
</script>

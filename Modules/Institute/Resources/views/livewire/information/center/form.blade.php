<div>
     {{-- @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif --}}
    <div class="col-lg-12 col-md-12">
        <div class="card shadow-1">
            {{-- <div class="card-header">
                <h3 class="card-title">Exam</h3>
            </div> --}}
            <div class="card-body">
                <div class="row">
                <div class="col-md-4 my-2">
                        <label for="branch_name" class="form-label">Branch Name</label>
                        <input name="branch_name" type="text"
                            class="form-control @error('branch_name') is-invalid @enderror" id="branch_name"
                            value="{{ old('branch_name', $branchname) }}" wire:model="branchname">
                        @error('branchname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('branch_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 my-2">
                        <label for="center_head" class="form-label">Center Head</label>
                        <input name="center_head" type="text"
                            class="form-control @error('center_head') is-invalid @enderror" id="center_head"
                            value="{{ old('center_head', $centerHead) }}" wire:model="centerHead">
                        @error('centerHead')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('center_head')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 my-2">
                        <label for="branch_type" class="form-label">Branch Type</label>
                        {{-- @dd($model->headquarter); --}}
                        <select name="branch_type" id="branch_type"
                            class="form-select @error('branch_type') is-invalid @enderror"
                            aria-label="Default select example" wire:model="branchType">
                            <option value="">Select Branch Type</option>
                            @foreach ($branchTypeOptions as $key => $option)
                                <option value="{{ $key }}">{{ $option }}</option>
                            @endforeach

                        </select>
                        @error('branchType')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('branch_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-12 my-2">
                        <label for="google_business_address" class="form-label">Google Business Address</label>
                        <input name="google_business_address" type="text"
                            class="form-control @error('google_business_address') is-invalid @enderror" id="location"
                            value="{{ old('google_business_address', $googleBusinessAddress) }}"
                            wire:model="googleBusinessAddress">

                        <input value="{{ $latitude }}" type="hidden" id="latitude" name="latitude" wire:model="latitude">
                        <input value="{{ $longitude }}" type="hidden" id="longitude" name="longitude" wire:model="longitude">

                        @error('googleBusinessAddress')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('google_business_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="card shadow-1">
            <div class="card-header">
                <h3 class="card-title">Address</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="address" class="form-label">Address</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                            id="address" value="{{ old('address', $address) }}" wire:model="address">
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
                        @error('countryId')
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
                        @error('stateId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                        @error('cityId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="area" class="form-label">Area</label>
                        <input name="area" type="text" class="form-control @error('area') is-invalid @enderror"
                            id="area" value="{{ old('area', $model->area) }}" list="areas" wire:model="area">
                            <input value="{{ $areaId }}" type="hidden" id="area_id" name="area_id" wire:model="areaId">

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
                            value="{{ old('pincode', $model->pincode) }}" wire:model="pincode"
                            @if ($isPincodeReadOnly) readonly @endif>

                        @error('pincode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
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
                        @error('email_1')
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
                        @error('email_2')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="phoneType1" class="form-label">Phone Type 1</label>
                        <select name="phoneType1" id="phoneType1"
                            class="form-select @error('phoneType1') is-invalid @enderror"
                            aria-label="Default select example" wire:model="phoneType1">
                            <option value="">--Select Phone Type--</option>
                            <option value="1" {{ $model->phone_type_1 == 1 ? 'selected' : '' }}>
                                Mobile
                            </option>
                            <option value="2" {{ $model->phone_type_1 == 2 ? 'selected' : '' }}>
                                Landline
                            </option>
                        </select>
                        @error('phoneType1')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('phone_type_1')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="phoneNumber1" class="form-label">Phone Number 1</label>
                        <input name="phoneNumber1" type="text"
                            class="form-control @error('phoneNumber1') is-invalid @enderror"
                            maxlength="@if ($phoneType1 == 1) 10 @else 12 @endif" id="phoneNumber1"
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
                            <option value="1" {{ $model->phone_type_2 == 1 ? 'selected' : '' }}>
                                Mobile
                            </option>
                            <option value="2" {{ $model->phone_type_2 == 2 ? 'selected' : '' }}>
                                Landline
                            </option>
                        </select>
                        @error('phoneType2')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="phoneNumber2" class="form-label">Phone Number 2</label>
                        <input name="phoneNumber2" type="text"
                            class="form-control @error('phoneNumber2') is-invalid @enderror"
                            maxlength="@if ($phoneType2 == 1) 10 @else 12 @endif" id="phoneNumber2"
                            value="{{ old('phoneNumber2', $phoneNumber2) }}" wire:model="phoneNumber2">
                        @error('phoneNumber2')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-1">
            <div class="card-header">
                <h3 class="card-title">Timings</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="monday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Monday</span>
                                <input type="checkbox" name="monday"
                                    class="custom-switch-input form-control @error('monday') is-invalid @enderror"
                                    id="monday" {{ $monday == true ? 'checked' : '' }} wire:model="monday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('monday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isMonday)
                            <div class="col-md-4 my-2">
                                <label for="monday_open" class="form-label">Monday Open</label>
                                <input name="monday_open" type="time"
                                    class="form-control @error('monday_open') is-invalid @enderror" id="monday_open"
                                    value="{{ old('monday_open', $mondayOpen) }}" wire:model="mondayOpen">
                                @error('mondayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="monday_close" class="form-label">Monday Close</label>
                                <input name="monday_close" type="time"
                                    class="form-control @error('monday_close') is-invalid @enderror"
                                    id="monday_close" value="{{ old('monday_close', $mondayClose) }}"
                                    wire:model="mondayClose">
                                @error('mondayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="tuesday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Tuesday</span>
                                <input type="checkbox" name="tuesday"
                                    class="custom-switch-input form-control @error('tuesday') is-invalid @enderror"
                                    id="tuesday" {{ $tuesday == true ? 'checked' : '' }} wire:model="tuesday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('tuesday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isTuesday)
                            <div class="col-md-4 my-2">
                                <label for="tuesday_open" class="form-label">Tuesday Open</label>
                                <input name="tuesday_open" type="time"
                                    class="form-control @error('tuesday_open') is-invalid @enderror"
                                    id="tuesday_open" value="{{ old('tuesday_open', $tuesdayOpen) }}"
                                    wire:model="tuesdayOpen">
                                @error('tuesdayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="tuesday_close" class="form-label">Tuesday Close</label>
                                <input name="tuesday_close" type="time"
                                    class="form-control @error('tuesday_close') is-invalid @enderror"
                                    id="tuesday_close" value="{{ old('tuesday_close', $tuesdayClose) }}"
                                    wire:model="tuesdayClose">
                                @error('tuesdayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="wednesday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Wednesday</span>
                                <input type="checkbox" name="wednesday"
                                    class="custom-switch-input form-control @error('wednesday') is-invalid @enderror"
                                    id="wednesday" {{ $wednesday == true ? 'checked' : '' }} wire:model="wednesday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('wednesday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isWednesday)
                            <div class="col-md-4 my-2">
                                <label for="wednesday_open" class="form-label">Wednesday Open</label>
                                <input name="wednesday_open" type="time"
                                    class="form-control @error('wednesday_open') is-invalid @enderror"
                                    id="wednesday_open" value="{{ old('wednesday_open', $wednesdayOpen) }}"
                                    wire:model="wednesdayOpen">
                                @error('wednesdayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="wednesday_close" class="form-label">Wednesday Close</label>
                                <input name="wednesday_close" type="time"
                                    class="form-control @error('wednesday_close') is-invalid @enderror"
                                    id="wednesday_close" value="{{ old('wednesday_close', $wednesdayClose) }}"
                                    wire:model="wednesdayClose">
                                @error('wednesdayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="thursday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Thursday</span>
                                <input type="checkbox" name="thursday"
                                    class="custom-switch-input form-control @error('thursday') is-invalid @enderror"
                                    id="thursday" {{ $thursday == true ? 'checked' : '' }} wire:model="thursday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('thursday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isThursday)
                            <div class="col-md-4 my-2">
                                <label for="thursday_open" class="form-label">Thursday Open</label>
                                <input name="thursday_open" type="time"
                                    class="form-control @error('thursday_open') is-invalid @enderror"
                                    id="thursday_open" value="{{ old('thursday_open', $thursdayOpen) }}"
                                    wire:model="thursdayOpen">
                                @error('thursdayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="thursday_close" class="form-label">Thursday Close</label>
                                <input name="thursday_close" type="time"
                                    class="form-control @error('thursday_close') is-invalid @enderror"
                                    id="thursday_close" value="{{ old('thursday_close', $thursdayClose) }}"
                                    wire:model="thursdayClose">
                                @error('thursdayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="friday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Friday</span>
                                <input type="checkbox" name="friday"
                                    class="custom-switch-input form-control @error('friday') is-invalid @enderror"
                                    id="friday" {{ $friday == true ? 'checked' : '' }} wire:model="friday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('friday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isFriday)
                            <div class="col-md-4 my-2">
                                <label for="friday_open" class="form-label">Friday Open</label>
                                <input name="friday_open" type="time"
                                    class="form-control @error('friday_open') is-invalid @enderror" id="friday_open"
                                    value="{{ old('friday_open', $fridayOpen) }}" wire:model="fridayOpen">
                                @error('fridayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="friday_close" class="form-label">Friday Close</label>
                                <input name="friday_close" type="time"
                                    class="form-control @error('friday_close') is-invalid @enderror"
                                    id="friday_close" value="{{ old('friday_close', $fridayClose) }}"
                                    wire:model="fridayClose">
                                @error('fridayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="saturday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Saturday</span>
                                <input type="checkbox" name="saturday"
                                    class="custom-switch-input form-control @error('saturday') is-invalid @enderror"
                                    id="saturday" {{ $saturday == true ? 'checked' : '' }} wire:model="saturday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('saturday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isSaturday)
                            <div class="col-md-4 my-2">
                                <label for="saturday_open" class="form-label">Saturday Open</label>
                                <input name="saturday_open" type="time"
                                    class="form-control @error('saturday_open') is-invalid @enderror"
                                    id="saturday_open" value="{{ old('saturday_open', $saturdayOpen) }}"
                                    wire:model="saturdayOpen">
                                @error('saturdayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="saturday_close" class="form-label">Saturday Close</label>
                                <input name="saturday_close" type="time"
                                    class="form-control @error('saturday_close') is-invalid @enderror"
                                    id="saturday_close" value="{{ old('saturday_close', $saturdayClose) }}"
                                    wire:model="saturdayClose">
                                @error('saturdayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="sunday" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Sunday</span>
                                <input type="checkbox" name="sunday"
                                    class="custom-switch-input form-control @error('sunday') is-invalid @enderror"
                                    id="sunday" {{ $sunday == true ? 'checked' : '' }} wire:model="sunday">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('sunday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($isSunday)
                            <div class="col-md-4 my-2">
                                <label for="sunday_open" class="form-label">Sunday Open</label>
                                <input name="sunday_open" type="time" placeholder="Opens At" step="900"
                                    onfocus="this.type='time'"
                                    class="form-control @error('sunday_open') is-invalid @enderror" id="sunday_open"
                                    value="{{ old('sunday_open', $sundayOpen) }}" wire:model="sundayOpen">
                                @error('sundayOpen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="sunday_close" class="form-label">Sunday Close</label>
                                <input name="sunday_close" type="time" placeholder="Closes At" step="900"
                                    onfocus="this.type='time'"
                                    class="form-control @error('sunday_close') is-invalid @enderror"
                                    id="sunday_close" value="{{ old('sunday_close', $sundayClose) }}"
                                    wire:model="sundayClose">
                                @error('sundayClose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-1">
            <div class="card-header">
                <h3 class="card-title">Social Channels</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="facebook_url" class="form-label">Facebook Link</label>
                        <input name="facebook_url" type="text"
                            class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url"
                            value="{{ old('facebook_url', $facebookUrl) }}" wire:model="facebookUrl">
                        @error('facebookUrl')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('facebook_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="instagram_url" class="form-label">Instagram Link</label>
                        <input name="instagram_url" type="text"
                            class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url"
                            value="{{ old('instagram_url', $instagramUrl) }}" wire:model="instagramUrl">
                        @error('instagramUrl')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('instagram_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="youtube_url" class="form-label">Youtube Link</label>
                        <input name="youtube_url" type="text"
                            class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url"
                            value="{{ old('youtube_url', $youtubeUrl) }}" wire:model="youtubeUrl">
                        @error('youtubeUrl')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('youtube_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="linkedin_url" class="form-label">Linkedin Link</label>
                        <input name="linkedin_url" type="text"
                            class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url"
                            value="{{ old('linkedin_url', $linkedinUrl) }}" wire:model="linkedinUrl">
                        @error('linkedinUrl')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('linkedin_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="twitter_url" class="form-label">Twitter Link</label>
                        <input name="twitter_url" type="text"
                            class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url"
                            value="{{ old('twitter_url', $twitterUrl) }}" wire:model="twitterUrl">
                        @error('twitterUrl')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('twitter_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @if (!empty($model->id))
            <div class="col-md-12 my-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
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
        // $('#latitude').val(place.geometry['location'].lat());
        // $('#longitude').val(place.geometry['location'].lng());
        // --------- show lat and long ---------------
        // $("#lat_area").removeClass("d-none");
        // $("#long_area").removeClass("d-none");
    });
</script>

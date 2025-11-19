<form class="align-items-center">
    <div class="row">
        <div class="col-md-3">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-9">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Search by name/email/mobile/pincode" name="name"
                        value="{{ $request['name'] ? $request['name'] : '' }}"
                        onblur="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="state_id">State</label>
                    <select name="state_id" id="state_id" class="form-select select-state" onchange="this.form.submit()">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ isset($state->id) ? $state->id : $state['id'] }}"
                                {{ !empty($request['state_id']) && $request['state_id'] == $state->id ? 'selected' : '' }}>
                                {{ isset($state->state) ? $state->state : $state['state'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="city_id">City</label>
                    <select name="city_id" id="city_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ isset($city->id) ? $city->id : $city['id'] }}"
                                {{ !empty($request['city_id']) && $request['city_id'] == $city->id ? 'selected' : '' }}>
                                {{ isset($city->city) ? $city->city : $city['city'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="area">Area</label>
                    <select name="area" id="area" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Area</option>
                        @foreach ($areas as $area)
                        <option value="{{ isset($area->area) ? $area->area : $area['area'] }}"
                            {{ !empty($request['area']) && $request['area'] == $area->area ? 'selected' : '' }}>
                            {{ isset($area->area) ? $area->area : $area['area'] }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="package_id" class="form-label">Package</label>
                    <select name="package_id" id="package_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Package</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}"
                                {{ !empty($request['package_id']) && $request['package_id'] == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

@section('script')
   @include('backend::includes._location_ajax_request')
@endsection

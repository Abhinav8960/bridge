<form class="align-items-center">
    <div class="row">
        <div class="col-md-4">
            @include('institute::includes._pagesize')
        </div>
        <div class="col-md-8">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Search by center head/email/mobile"
                        name="name" value="{{ $request['name'] ? $request['name'] : '' }}"
                        onblur="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="branch">Branch Type</label>
                    {{-- @dd($model->headquarter); --}}
                    <select name="branch" id="branch" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Branch Type</option>
                        <option value="1" {{ !empty($request['branch']) && $request['branch'] == 1 ? 'selected' : '' }}>
                            Corporate Headquarter
                        </option>
                        <option value="2" {{ !empty($request['branch']) && $request['branch'] == 2 ? 'selected' : '' }}>
                            Branch
                        </option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="state_id">State</label>
                    <select name="state_id" id="state_id" class="form-select select-state"
                        onchange="this.form.submit()">
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
            </div>
        </div>
    </div>
</form>

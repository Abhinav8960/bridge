<form class="align-items-center">
    <div class="row">
        <div class="col-md-6">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-6">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="metro">Metro</label>
                    <select class="form-select" id="is_metro" name="metro" aria-controls="popularcity" onchange="this.form.submit()">
                        <option value="">Select City Type</option>
                        <option value="1" {{  $request['metro'] == 1 ? 'selected' : '' }}>Non-Metro</option>
                        <option value="2" {{  $request['metro'] == 2 ? 'selected' : '' }}>Metro</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

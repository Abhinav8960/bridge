<div class="col-auto form-inline">
    <label class="mt-2">Show
        <select name="pagesize" id="pagesize" class="form-select" aria-controls="examcategory"
            onchange="this.form.submit()">
            <option value="10" {{ !empty($request['pagesize']) && $request['pagesize'] == 10 ? 'selected' : '' }}>10
            </option>
            <option value="25" {{ !empty($request['pagesize']) && $request['pagesize'] == 25 ? 'selected' : '' }}>25
            </option>
            <option value="50" {{ !empty($request['pagesize']) && $request['pagesize'] == 50 ? 'selected' : '' }}>50
            </option>
            <option value="100" {{ !empty($request['pagesize']) && $request['pagesize'] == 100 ? 'selected' : '' }}>
                100</option>
        </select>
        entries</label>
</div>

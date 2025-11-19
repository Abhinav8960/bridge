<form class="align-items-center">
    <div class="row">
        <div class="col-md-4">
            @include('institute::includes._pagesize')
        </div>
        <div class="col-md-8">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="status" class="form-label">Exam</label>
                    <select name="streamstatus" id="status" class="form-select" onchange="this.form.submit()">
                        <option value="active" {{ !empty(request()->streamstatus) && request()->streamstatus == "active" ? 'selected' : '' }}>Active</option>
                        <option value="suspended" {{ !empty(request()->streamstatus) && request()->streamstatus == "suspended" ? 'selected' : '' }}>Suspended</option>                       
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
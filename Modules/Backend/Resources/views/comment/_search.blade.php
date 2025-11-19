<form class="align-items-center">
    <div class="row">
        <div class="col-md-6">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-6">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="title" type="text" placeholder="Search by title"
                        name="title" value="{{ $request['title'] ? $request['title'] : '' }}"
                        onblur="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Status</option>
                        <option value="2" {{ request()->status == 2 ? 'selected' : '' }}>
                            Rejected
                        </option>
                        <option value="3" {{ request()->status == 3 ? 'selected' : '' }}>
                            On Hold
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

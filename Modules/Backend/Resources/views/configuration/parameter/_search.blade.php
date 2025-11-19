<form class="align-items-center">
    <div class="row">
        <div class="col-md-6">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-6">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="title">Name</label>
                    <input class="form-control" id="title" type="text" placeholder="Name" name="title"
                        value="{{ $request['title'] ? $request['title'] : '' }}"
                        onblur="setTimeout(this.form.submit(), 3000)">
                </div>

                {{-- <div class="col-auto">
                    <select class="form-select" id="status" name="status" onchange="this.form.submit()">
                        <option value="">Select Status</option>
                        <option value="1" {{ $request['status'] == 1 ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ $request['status'] == 2 ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div> --}}

            </div>
        </div>
    </div>
</form>

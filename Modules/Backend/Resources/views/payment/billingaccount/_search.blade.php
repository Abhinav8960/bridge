<form class="align-items-center">
    <div class="row">
        <div class="col-md-4">
            @include('backend.includes._pagesize')
        </div>
        <div class="col-md-8">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Search By Title/subtitle"
                        name="name" value="{{ $request['name'] ? $request['name'] : '' }}"
                        onblur="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="status">Status</label>
                    <select class="form-select" id="status" name="status" onchange="this.form.submit()">
                        <option value="">Select Occurrence</option>
                        <option value="1" {{ $request['status'] == 1 ? 'selected' : '' }}>Ongoing</option>
                        <option value="2" {{ $request['status'] == 2 ? 'selected' : '' }}>Upcoming</option>
                        <option value="3" {{ $request['status'] == 3 ? 'selected' : '' }}>Past</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="is_approved">Queue</label>
                    <select class="form-select" id="is_approved" name="approved" onchange="this.form.submit()">
                        <option value="">Select Queue</option>
                        <option value="1" {{ request()->approved == 1 ? 'selected' : '' }}>Queued</option>
                        <option value="2" {{ request()->approved == 2 ? 'selected' : '' }}>Rejected</option>
                        <option value="3" {{ request()->approved == 3 ? 'selected' : '' }}>Approved</option>
                    </select>
                </div>
                {{--  <div class="col-auto">
                    <label class="visually-hidden" for="chapter_id" class="form-label">Chapter</label>
                    <select name="chapter_id" id="chapter_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Chapter</option>
                        @foreach ($chapters as $chapter)
                            <option value="{{ $chapter->id }}"
                                {{ !empty($request->chapter_id) && $request->chapter_id == $chapter->id ? 'selected' : '' }}>
                                {{ $chapter->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
            </div>
        </div>
    </div>
</form>

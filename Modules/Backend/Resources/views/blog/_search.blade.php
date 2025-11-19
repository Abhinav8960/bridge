<form class="align-items-center">
    <div class="row">
        <div class="col-md-3">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-9">
            <div class="row float-end">
                <div class="col-md-3">
                    <label class="visually-hidden" for="title">Title</label>
                    <input class="form-control" id="title" type="text" placeholder="Search Title" name="title"
                        value="{{ $request['title'] ? $request['title'] : '' }}"
                        onkeyup="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-md-3">
                    <label class="visually-hidden" for="author">Author</label>
                    <input class="form-control" id="user_id" type="text" placeholder="Author" name="user_id"
                        value="{{ $request['user_id'] ? $request['user_id'] : '' }}"
                        onchange="setTimeout(this.form.submit(), 3000)">


                </div>
                <div class="col-md-3">
                    <label class="visually-hidden" for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Status</option>
                        <option value="1" {{ request()->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="2" {{ request()->status == 2 ? 'selected' : '' }}>
                            Suspended
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="visually-hidden" for="category" class="form-label">Select Category</label>
                    <select name="category_id" id="category_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Category</option>
                        @foreach ($category as $cat)
                            <option value="{{ $cat->id }}"
                                {{ !empty($request['category_id']) && $request['category_id'] == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
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

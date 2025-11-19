<form class="align-items-center">
    <div class="row">
        <div class="col-md-3">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-9">
            <div class="row float-end">
                <div class="col-md-4">

                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Search By Name"
                        name="name" value="{{ $request['name'] ? $request['name'] : '' }}"
                        onkeyup="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-md-8">
                    <label class="visually-hidden" for="institute">Institute</label>
                    <input class="form-control" id="institute_id" type="text" placeholder="Search By Institute"
                        name="institute_id" value="{{ $request['institute_id'] ? $request['institute_id'] : '' }}"
                        onkeyup="setTimeout(this.form.submit(), 3000)">
                    <label class="visually-hidden" for="status">Institute</label>

                </div>

            </div>
        </div>
    </div>
</form>

@section('script')
    @include('backend::includes._location_ajax_request')
@endsection

<form class="align-items-center">
    <div class="row">
        <div class="col-md-6">
            @include('backend::includes._pagesize')
        </div>


        <div class="col-md-6">
            <div class="row float-end">

                <div class="col-auto">
                    <label class="visually-hidden" for="category_id" class="form-label">FAQ Category</label>
                    <select name="category_id" id="category_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ !empty($request->category_id) && $request->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->faq_category }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>
</form>

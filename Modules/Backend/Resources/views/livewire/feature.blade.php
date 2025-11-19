<div>
    {{-- @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif --}}
    <div class="col-lg-12 col-md-12">

        <div class="card shadow-1">
            {{-- <div class="card-header">
                <h3 class="card-title">Information</h3>
            </div> --}}
            <div class="card-body">
                <div class="row">


                    <div class="col-md-12 my-2">
                        <label for="institute_id" class="form-label">Institute Name</label>
                        <select name="institute_id" id="institute_id"
                            class="form-select @error('instituteId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="instituteId">
                            <option value="">Select Institute</option>
                            @foreach ($institutes as $key => $inst)
                                <option value="{{ $inst->id }}">{{ $inst->name }}</option>
                            @endforeach
                        </select>
                        @error('instituteId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('institute_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="isCategory" class="form-label">Select Page</label>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="featured_page" name="isHome"
                                        @error('isHome') is-invalid @enderror id="isHome"
                                        {{ $isHome == true ? 'checked' : '' }} wire:model="isHome">
                                    <label class="form-check-label" for="isHome">Home</label>



                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">

                                    <input type="checkbox" class="featured_page" name="isCategory"
                                        class="custom-switch-input form-control featured_page @error('isCategory') is-invalid @enderror"
                                        id="isCategory" {{ $isCategory == true ? 'checked' : '' }}
                                        wire:model="isCategory">
                                    <label class="form-check-label" for="isHome">Category</label>

                                </div>
                            </div>
                        </div>



                        @error('isCategory')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($isCategory)
                        <div class="col-md-12 my-2 supercategory">
                            <label class="form-label">Select Exam Category</label>
                            @if (count($categoryOptions) > 0)
                                @foreach ($categoryOptions as $category)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="checkbox" name="categories[{{ $category->id }}]" {{ in_array($category->id, $seletedCategories) ? 'checked' : '' }} wire:model="seletedCategories.{{ $category->id }}"> {{ $category->name }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @error('seletedCategories')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                    @endif
                </div>
                @if (!empty($model->id))
                    <div class="col-md-12 my-2">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                            aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>
                                Suspended
                            </option>
                            <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 my-2">
                        <button class="btn btn-outline-success " type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">FAQ Category</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="faq_category" class="form-label">FAQ Category</label>
                        <input name="faq_category" type="text"
                            class="form-control @error('faqCategory') is-invalid @enderror" id="faq_category"
                            value="{{ old('faq_category', $faqCategory) }}" wire:model="faqCategory">
                        @error('faq_category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('faqCategory')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (!empty($model->id))
                        <div class="col-md-6 my-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror"
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
                </div>
                <div class="row">
                    <div class="col-md-12 my-2">
                        <button class="btn btn-outline-success " type="submit"
                            wire:model="submitButton">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

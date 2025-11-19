<div>
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card shadow-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="category_id" class="form-label">FAQ Category</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('categoryId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="categoryId">
                            <option value="">Select FAQ Category</option>
                            @foreach ($categoryOptions as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->faq_category }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('categoryId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6 my-2">
                        <label for="order_by" class="form-label">Question No.</label>
                        <input name="order_by" type="text"
                            class="form-control @error('order_by') is-invalid @enderror" id="order_by"
                            value="{{ old('order_by', $orderBy) }}" wire:model="orderBy">
                        @error('orderBy')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-12 my-2">
                        <label for="question" class="form-label">Question</label>
                        <input name="question" type="text"
                            class="form-control @error('question') is-invalid @enderror" id="question"
                            value="{{ old('question', $question) }}" wire:model="question">
                        @error('question')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="answer" class="form-label">Answer</label>
                        <input name="answer" type="text" class="form-control @error('answer') is-invalid @enderror"
                            id="answer" value="{{ old('answer', $answer) }}" wire:model="answer">
                        @error('answer')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    @if (!empty($model->id))
                        <div class="col-md-12 my-2">
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
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <button class="btn btn-outline-success submit-button"
                                @if ($isValidatedForm) type="submit" @else type="button" wire:click="submitForm()" @endif>Submit</button>
                        </div>
                    </div>
                    @if ($isValidatedForm)
                        <script>
                            $('.submit-button').click();
                        </script>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

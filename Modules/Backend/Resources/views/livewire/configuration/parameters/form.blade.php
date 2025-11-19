<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Parameter</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="title" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" value="{{ old('title', $title) }}" wire:model="title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- @if (!empty($model->id))
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
                    @endif --}}
                </div>
            </div>
        </div>
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

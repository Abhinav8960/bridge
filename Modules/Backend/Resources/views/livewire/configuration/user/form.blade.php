<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $model->name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6 my-2">
                        <label for="role_id" class="form-label">Role Type</label>
                        <select name="role_id" id="role_id" class="form-select @error('type') is-invalid @enderror"
                            aria-label="Default select example" wire:model="role_id">
                            <option value="">Select Role Type</option>
                            @foreach ($roleOptions as $key => $option)
                                @if ($model->role_id == $key)
                                    <option value="{{ $key }}" selected>{{ $option }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endif
                            @endforeach

                        </select>
                        @error('role_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 my-2">
                        <label for="phone" class="form-label">Mobile</label>
                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" wire:model="phone">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 my-2">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            id="email" wire:model="email">
                        @error('email')
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

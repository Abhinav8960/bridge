<div>
    <form method="POST" enctype="multipart/form-data" wire:submit.prevent="submit">
        <div class="col-lg-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 my-2">
                            <label for="sac_code">SAC Code</label>
                            <input name="sac_code" type="text"
                                class="form-control @error('sac_code') is-invalid @enderror" id="sac_code"
                                wire:model="SacCode" minlength="1" maxlength="6">
                            @error('SacCode')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="@if (!empty($model->id)) col-md-6 @else col-md-9 @endif  my-2">
                            <label for="description">Description</label>
                            <input name="description" type="text"
                                class="form-control @error('description') is-invalid @enderror" id="description"
                                wire:model="description">
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (!empty($model->id))
                            <div class="col-md-3 my-2">
                                <label for="status">Status</label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    aria-label="Default select example" wire:model="status">
                                    <option value="">Select Status</option>
                                    <option value="0">
                                        Suspended
                                    </option>
                                    <option value="1">
                                        Active
                                    </option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-6">
            <div class="row">
                <div class="col-md-6 my-2">
                    <button class="btn btn-outline-success submit-button">Submit</button>
                </div>
            </div>

        </div>
    </form>
</div>

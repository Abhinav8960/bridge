<div>
    <div class="row">
        <div class="col-md-12">
            <label for="is_approved" class="form-label">Select Action</label>
            <select name="is_approved" id="is_approved" class="form-select @error('isApproved') is-invalid @enderror"
                aria-label="Default select example" wire:model="isApproved">
                <option value="1">
                    Approved
                </option>
                <option value="2">
                    Reject
                </option>
            </select>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 my-2">
            <button class="btn btn-outline-success " type="submit">Submit</button>
        </div>
    </div>
</div>

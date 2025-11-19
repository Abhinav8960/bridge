<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Institutes File Upload</h3>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file" class="form-label">Upload</label>
                                    <input name="file" type="file"
                                        class="form-control @error('file') is-invalid @enderror" id="file"
                                        wire:model="file">
                                    @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="file" class="form-label">Type</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror"
                                        id="type" wire:model="type">
                                        <option value="">-Select Type--</option>
                                        @foreach ($typeOptions as $key => $option)
                                            <option value="{{ $key }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="btn" class="form-label">&nbsp;</label>

                                    <button class="btn btn-outline-success btn-block submit-button"
                                        type="submit">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

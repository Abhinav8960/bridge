<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dates</h3>
            </div>
            <form method="POST" enctype="multipart/form-data" wire:submit.prevent="save">
                <div class="card-body">
                    <div class="row">


                        <div class="col-md-4 my-2">
                            <label for="effective_date" class="form-label"> Effective Date
                            </label>
                            <input name="effective_date" type="datetime-local"
                                class="form-control @error('effective_date') is-invalid @enderror"
                                id="effective_date" value="{{ old('effective_date', $effective_date) }}"
                                wire:model="effective_date">
                            @error('effective_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4 my-2">
                            <label for="last_updated" class="form-label">Last Updated Date
                            </label>
                            <input name="last_updated" type="datetime-local"
                                class="form-control @error('last_updated') is-invalid @enderror" id="last_updated"
                                value="{{ old('last_updated', $last_updated) }}" wire:model="last_updated">
                            @error('last_updated')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button class="btn btn-outline-success submit-button"
                                style="margin-top:35px; margin-left20px;"
                                @if ($isValidatedForm) type="submit" @else type="button" wire:click="submitForm()" @endif>Submit</button>
                        </div>


                        @if ($isValidatedForm)
                            <script>
                                $('.submit-button').click();
                            </script>
                        @endif



                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

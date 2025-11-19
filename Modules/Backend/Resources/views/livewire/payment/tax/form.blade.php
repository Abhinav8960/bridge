<div>
    <form method="POST" enctype="multipart/form-data" wire:submit.prevent="submit">
        <div class="col-lg-12 col-md-6">
            <div class="card">
                {{-- @if ($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 my-2">
                            <label for="inputEmail4">Tax Name</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model="name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-3 my-2">
                            <label for="inputEmail4">Percentage</label>
                            <input name="percentage" type="text"
                                class="form-control @error('percentage') is-invalid @enderror" id="percentage"
                                wire:model="percentage">
                            @error('percentage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 my-2">
                            <label>Breakup</label>
                            <select name="is_breakup" id="status"
                                class="form-control @error('status') is-invalid @enderror"
                                aria-label="Default select example" wire:model="isBreakup"
                                @if (empty($percentage)) disabled @endif>
                                <option value="">Select Breakup</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('isBreakup')
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
                </div>
            </div>
        </div>
        @if ($isBreakup)
            @if ($breakupTaxPercentagemax > 0)
                <div class="col-lg-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Breakup</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 my-2">
                                    <label for="inputEmail4">Tax Name</label>
                                    <input name="name" type="text"
                                        class="form-control @error('breakupTaxName') is-invalid @enderror"
                                        id="breakupTaxName" wire:model="breakupTaxName">
                                    @error('breakupTaxName')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-5 my-2">
                                    <label for="inputEmail4">Percentage</label>
                                    <input name="percentage" type="number"
                                        class="form-control @error('breakupTaxPercentage') is-invalid @enderror"
                                        id="breakupTaxPercentage" wire:model="breakupTaxPercentage" min="1"
                                        max="{{ $breakupTaxPercentagemax }}">
                                    @error('breakupTaxPercentage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 my-2">
                                    <label for="inputEmail4">&nbsp;</label>
                                    <button type="button" class="btn btn-block btn-outline-info "
                                        wire:click="addBreakup()">Add</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Breakup Details</h3>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Tax Name</th>
                                <th>Percentage</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($breakupTaxArray as $key => $array)
                                <tr>
                                    <td>
                                        {{ $array['name'] }}
                                        <input type="hidden" name="breakup_tax[{{ $key }}]['name']"
                                            value="{{ $array['name'] }}">
                                    </td>
                                    <td>
                                        {{ $array['percentage'] }}
                                        <input type="hidden" name="breakup_tax[{{ $key }}]['percentage']"
                                            value="{{ $array['percentage'] }}">

                                    </td>
                                    <td><button class="btn btn-outline-danger" type="button"
                                            wire:click="removeBreakups({{ $key }})">Remove</button></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-12 col-md-6">
            <div class="row">
                <div class="col-md-6 my-2">
                    <button class="btn btn-outline-success submit-button">Submit</button>
                </div>
            </div>

        </div>
    </form>
</div>

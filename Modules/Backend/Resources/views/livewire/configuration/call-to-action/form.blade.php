<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Call To Action</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="call_to_action_type" class="form-label">Call To Action Type</label>
                        <select name="call_to_action_type" id="call_to_action_type"
                            class="form-select @error('callToActionType') is-invalid @enderror"
                            aria-label="Default select example" wire:model="callToActionType">
                            <option value="">Select Action Type</option>
                            <option value="1" {{ $model->call_to_action_type == 1 ? 'selected' : '' }}>
                                Email
                            </option>
                            <option value="2" {{ $model->call_to_action_type == 2 ? 'selected' : '' }}>
                                Phone
                            </option>
                        </select>
                        @error('callToActionType')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('call_to_action_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="specify_value" class="form-label">Specify Value</label>
                        <input name="specify_value" type="text"
                            class="form-control @error('specify_value') is-invalid @enderror"
                            maxlength="@if ($callToActionType == 2) 12 @else @endif" id="specify_value"
                            value="{{ old('specify_value', $model->specify_value) }}" wire:model="specifyValue">
                        @error('specifyValue')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('specify_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                    
                    <div class="col-md-12">
                        <label class="form-label">Call To Action Placement</label>
                        <div class="row">
                            @if ($showHeader)
                                <div class="col-md-3">
                                    <input type="checkbox" name="is_showin_header"
                                        @error('is_showin_header') is-invalid @enderror id="is_showin_header"
                                        {{ $is_showin_header == true ? 'checked' : '' }} wire:model="is_showin_header">
                                    <label class="form-check-label" for="is_showin_header">Header</label>
                                </div>
                            @endif
                            @if ($showFooter)
                                <div class="col-md-3">
                                    <input type="checkbox" name="is_showin_footer"
                                        @error('is_showin_footer') is-invalid @enderror id="is_showin_footer"
                                        {{ $is_showin_footer == true ? 'checked' : '' }} wire:model="is_showin_footer">
                                    <label class="form-check-label" for="is_showin_footer">Footer</label>
                                </div>
                            @endif
                            @if ($showContactPage)
                                <div class="col-md-3">
                                    <input type="checkbox" name="is_showin_contact_page"
                                        @error('is_showin_contact_page') is-invalid @enderror
                                        id="is_showin_contact_page"
                                        {{ $is_showin_contact_page == true ? 'checked' : '' }}
                                        wire:model="is_showin_contact_page">
                                    <label class="form-check-label" for="is_showin_contact_page">Contact
                                        Page</label>
                                </div>
                            @endif
                            @if ($showMobile)
                                <div class="col-md-3">
                                    <input type="checkbox" name="is_showin_mobile_app"
                                        @error('is_showin_mobile_app') is-invalid @enderror id="is_showin_mobile_app"
                                        {{ $is_showin_mobile_app == true ? 'checked' : '' }}
                                        wire:model="is_showin_mobile_app">
                                    <label class="form-check-label" for="is_showin_mobile_app">Mobile App</label>
                                </div>
                            @endif
                        </div>
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
                            <button class="btn btn-outline-success " type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

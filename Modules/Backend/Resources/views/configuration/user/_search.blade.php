<form class="align-items-center">
    <div class="row">
        <div class="col-md-6">
            @include('backend::includes._pagesize')
        </div>


        <div class="col-md-6">
            <div class="row float-end">

                <div class="col-auto">
                    <label class="visually-hidden" for="role_id" class="form-label">Role Type</label>
                    <select name="roleType" id="role_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Role Type</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->role_id }}"
                                {{ !empty($request['role_id']) && $request['role_id'] == $user->role_id ? 'selected' : '' }}>
                                {{ \App\Helpers\Helper::InternalRoles()[$user->role_id] }}</option>
                        @endforeach

                    </select>
                </div>

            </div>
        </div>
    </div>
</form>

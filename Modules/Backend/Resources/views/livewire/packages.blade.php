<div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Packages</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="@if ($packageDurationType == $fixedValidity) col-md-6  @else col-md-12 @endif my-2">
                        <label for="package_duration_type" class="form-label">Package Duration Type</label>
                        <select name="package_duration_type" id="package_duration_type"
                            class="form-select @error('packageDurationType') is-invalid @enderror"
                            aria-label="Default select example" wire:model="packageDurationType">
                            <option value="">Select Option</option>
                            <option value="{{ $fixedValidity }}">
                                Fixed Validity
                            </option>
                            <option value="{{ $asPerDuration }}">
                                As Per Duration
                            </option>
                        </select>
                        @error('packageDurationType')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($packageDurationType == $fixedValidity)
                        <div class="col-md-6 my-2">
                            <label for="no_of_days" class="form-label">Number Of Days</label>
                            <input name="no_of_days" type="text"
                                class="form-control @error('noOfdays') is-invalid @enderror" id="no_of_days"
                                wire:model="noOfdays">
                            @error('noOfdays')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="col-md-3 my-2">
                        <label for="no_of_centers" class="form-label">Number Of Centres {{ $noOfCenters }}</label>
                        <input name="no_of_centers" type="text"
                            class="form-control @error('noOfCenters') is-invalid @enderror" id="no_of_centers"
                             wire:model="noOfCenters">
                        @error('noOfCenters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 my-2">
                        <label for="no_of_courses" class="form-label">Number Of Courses</label>
                        <input name="no_of_courses" type="text"
                            class="form-control @error('noOfCourses') is-invalid @enderror" id="no_of_courses"
                            value="{{ old('no_of_courses', $noOfCourses) }}" wire:model="noOfCourses">
                        @error('noOfCourses')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                    </div>

                    <div class="col-md-3 my-2">
                        <label for="no_of_streams" class="form-label">Number Of Streams</label>
                        <input name="no_of_streams" type="text"
                            class="form-control @error('noOfStreams') is-invalid @enderror" id="no_of_streams" wire:model="noOfStreams">
                        @error('noOfStreams')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       
                    </div>


                    <div class="col-md-3 my-2">
                        <label for="is_course_enrollment" class="form-label">Is Course Enrollment</label>
                        <select name="is_course_enrollment" id="is_course_enrollment"
                            class="form-select @error('isCourseEnrollment') is-invalid @enderror"
                            aria-label="Default select example" wire:model="isCourseEnrollment">
                            <option value="0" {{ $model->is_course_enrollment == 0 ? 'selected' : '' }}>
                                No
                            </option>
                            <option value="1" {{ $model->is_course_enrollment == 1 ? 'selected' : '' }}>
                                Yes
                            </option>
                        </select>
                        @error('isCourseEnrollment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-block align-items-center pt-3 mt-auto">
                        <label for="tabs" class="form-label">Tabs</label>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_general" wire:model="general" disabled><label class="m-2">General</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_courses" wire:model="courses" ><label class="m-2">Courses</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_champions" wire:model="champions"><label class="m-2">Champions</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_uploads" wire:model="uploads"><label class="m-2">Uploads</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_faculty" wire:model="faculty"><label class="m-2">Faculty</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_centers" wire:model="centers" disabled><label class="m-2">Centers</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_videos" wire:model="videos"><label class="m-2">Videos</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_alumni" wire:model="alumni"><label class="m-2">Alumni</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_contact" wire:model="contact"><label class="m-2">Contact</label>
                        </div>
                        <div class="me-1">
                            <input type="checkbox" name="is_showing_review" wire:model="review"><label class="m-2">Review</label>
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

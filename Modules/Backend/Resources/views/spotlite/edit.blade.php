@extends('backend::layouts.master')

@section('content')
    <div class="main-content app-content" style="margin-top: 3rem">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1" style="margin: 20px">Edit Spotlite</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="{{ route('spotlites.index') }}">Spotlite</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-md-12 col-lg-12">
                <form action="{{ route('spotlites.update', $spotlite->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Spotlite</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 my-2">
                                    <label for="institute_name" class="form-label">Institute Name</label>
                                    <input name="institute_name" type="text"
                                        class="form-control @error('institute_name') is-invalid @enderror"
                                        id="institute_name" value="{{ old('institute_name', $spotlite->institute_name) }}">
                                    @error('institute_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location"
                                        class="form-control @error('location') is-invalid @enderror" id="location"
                                        value="{{ old('location', $spotlite->location) }}">
                                    @error('location')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="establish_year" class="form-label">Establish Year</label>
                                    <input type="text" name="establish_year"
                                        class="form-control @error('establish_year') is-invalid @enderror"
                                        id="establish_year" value="{{ old('establish_year', $spotlite->establish_year) }}">
                                    @error('establish_year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="batch_training" class="form-label">Batch Training</label>
                                    <input type="text" name="batch_training"
                                        class="form-control @error('batch_training') is-invalid @enderror"
                                        id="batch_training" value="{{ old('batch_training', $spotlite->batch_training) }}">
                                    @error('batch_training')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="virtual_classroom" class="form-label">Virtual Classroom</label>


                                    <input type="text" name="virtual_classroom"
                                        class="form-control @error('batch_training') is-invalid @enderror"
                                        id="virtual_classroom"
                                        value="{{ old('virtual_classroom', $spotlite->virtual_classroom) }}">
                                    @error('virtual_classroom')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-md-6 my-2">
                                    <label for="institute_url" class="form-label">Institute URL</label>
                                    <input type="text" name="institute_url"
                                        class="form-control @error('institute_url') is-invalid @enderror" id="institute_url"
                                        value="{{ old('institute_url', $spotlite->institute_url) }}">
                                    @error('institute_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="dyntube_project_id" class="form-label">Dyntube Project ID</label>
                                    <input type="text" name="dyntube_project_id"
                                        class="form-control @error('dyntube_project_id') is-invalid @enderror"
                                        id="dyntube_project_id"
                                        value="{{ old('dyntube_project_id', $spotlite->dyntube_project_id) }}">
                                    @error('dyntube_project_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="dyntube_video_id" class="form-label">Dyntube Video ID</label>
                                    <input type="text" name="dyntube_video_id"
                                        class="form-control @error('dyntube_video_id') is-invalid @enderror"
                                        id="dyntube_video_id"
                                        value="{{ old('dyntube_video_id', $spotlite->dyntube_video_id) }}">
                                    @error('dyntube_video_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-6 my-2">
                                    <label for="image" class="form-label">Image (JPEG, WEBP) (Max 100 KB)</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" id="image">
                                    @if ($spotlite->image)
                                        <img src="{{ asset('storage/' . $spotlite->image) }}" alt="Current Image"
                                            class="img-thumbnail mt-2" width="100">
                                    @endif
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="col-md-6 my-2">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status"
                                        class="form-select @error('status') is-invalid @enderror">
                                        <option value="0"
                                            {{ old('status', $spotlite->status) == 0 ? 'selected' : '' }}>Suspended
                                        </option>
                                        <option value="1"
                                            {{ old('status', $spotlite->status) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        {{-- <option value="2"
                                            {{ old('status', $spotlite->status) == 2 ? 'selected' : '' }}>Scheduled
                                        </option> --}}
                                    </select>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 my-2">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5"
                                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $spotlite->description) }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 my-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('spotlites.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('backend::layouts.ckeditor5', ['editorIds' => ['description']])

                </form>
            </div>
        </div>
    </div>
@endsection

@extends('backend::layouts.master')

@section('content')
    <div class="main-content app-content" style="margin-top: 3rem">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1" style="margin: 20px">Spotlite</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Spotlite</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-md-12 col-lg-12">
                <form action="{{ route('spotlites.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Spotlite</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Institute Name -->
                                <div class="col-md-6 my-2">
                                    <label for="institute_name" class="form-label">Institute Name</label>
                                    <input name="institute_name" type="text"
                                        class="form-control @error('institute_name') is-invalid @enderror"
                                        id="institute_name" value="{{ old('institute_name') }}">
                                    @error('institute_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div class="col-md-6 my-2">
                                    <label for="location" class="form-label">Location</label>
                                    <input name="location" type="text"
                                        class="form-control @error('location') is-invalid @enderror" id="location"
                                        value="{{ old('location') }}">
                                    @error('location')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Establish Year -->
                                <div class="col-md-6 my-2">
                                    <label for="establish_year" class="form-label">Establish Year</label>
                                    <input name="establish_year" type="text"
                                        class="form-control @error('establish_year') is-invalid @enderror"
                                        id="establish_year" value="{{ old('establish_year') }}">
                                    @error('establish_year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Batch Training -->
                                <div class="col-md-6 my-2">
                                    <label for="batch_training" class="form-label">Batch Training</label>
                                    <input name="batch_training" type="text"
                                        class="form-control @error('batch_training') is-invalid @enderror"
                                        id="batch_training" value="{{ old('batch_training') }}">
                                    @error('batch_training')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Virtual Classroom -->
                                <div class="col-md-6 my-2">
                                    <label for="virtual_classroom" class="form-label">Virtual Classroom</label>
                                    <input name="virtual_classroom" type="text"
                                        class="form-control @error('virtual_classroom') is-invalid @enderror"
                                        id="virtual_classroom" value="{{ old('virtual_classroom') }}">
                                    @error('virtual_classroom')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Institute URL -->
                                <div class="col-md-6 my-2">
                                    <label for="institute_url" class="form-label">Institute URL</label>
                                    <input name="institute_url" type="text"
                                        class="form-control @error('institute_url') is-invalid @enderror" id="institute_url"
                                        value="{{ old('institute_url') }}">
                                    @error('institute_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Dyntube Project ID -->
                                <div class="col-md-6 my-2">
                                    <label for="dyntube_project_id" class="form-label">Dyntube Project ID</label>
                                    <input name="dyntube_project_id" type="text"
                                        class="form-control @error('dyntube_project_id') is-invalid @enderror"
                                        id="dyntube_project_id" value="{{ old('dyntube_project_id') }}">
                                    @error('dyntube_project_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Dyntube Video ID -->
                                <div class="col-md-6 my-2">
                                    <label for="dyntube_video_id" class="form-label">Dyntube Video ID</label>
                                    <input name="dyntube_video_id" type="text"
                                        class="form-control @error('dyntube_video_id') is-invalid @enderror"
                                        id="dyntube_video_id" value="{{ old('dyntube_video_id') }}">
                                    @error('dyntube_video_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                {{-- <div class="col-md-12 my-2">
                                    <label for="image" class="form-label">Featured Image (Upload)(JPEG, WEBP)(Max Size:
                                        100 KB)</label>
                                    <input name="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" id="image">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <!-- Description -->
                                <div class="col-md-12 my-2">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="2"
                                        class="form-control ckeditor5 @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>

                            <div class="col-md-12 my-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('spotlites.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </div>
                    </div>

                    @include('backend::layouts.ckeditor5', ['editorIds' => ['description']])
                    {{-- @include('backend::layouts.ckeditor5', ['setterId' => 'description']) --}}


                </form>
            </div>
        </div>

    </div>
@endsection
@section('style')
    @livewireStyles
@endsection
@section('script')
    @livewireScripts
@endsection

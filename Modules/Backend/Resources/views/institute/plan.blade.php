@extends('backend::layouts.master')
@section('content')
    <div class="main-content app-content">

        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-header justify-content-between" style="padding-inline:12px;">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Institutes : {{ $institute->name }}</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Institutes </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $institute->name }} </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <form action="{{ route('institute.planupdate', $institute->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6 my-2">
                                            <label for="package_id" class="form-label">Package</label>
                                            <select name="package_id" id="package_id"
                                                class="form-select @error('package_id') is-invalid @enderror"
                                                aria-label="Default select example">
                                                <option value="">Select Package</option>
                                                @foreach ($packages as $package)
                                                    @if ($package->id != $starterpackageId)
                                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('package_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 my-2">
                                            <label for="duration" class="form-label">Duration</label>
                                            <select name="duration" id="duration"
                                                class="form-select @error('duration') is-invalid @enderror"
                                                aria-label="Default select example">
                                                <option value="">Select Duration</option>
                                                @foreach ($durationOption as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('duration')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 my-2">
                                            <button class="btn btn-outline-success " type="submit"
                                                >Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

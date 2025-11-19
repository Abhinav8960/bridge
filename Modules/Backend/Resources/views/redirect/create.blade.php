@extends('backend::layouts.master')
@section('content')
    <div class="main-content app-content" style="margin-top:70px;">

        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-header justify-content-between" style="padding-inline:12px;">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Redirect</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Redirect</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <form action="{{ route('redirectStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Redirects</h3>
                            </div>

                            <div class="row" style="margin-left: 10px">
                                <div class="col-md-6 my-2">
                                    <label for="old_url" class="form-label">Old URL</label>
                                    <input name="old_url" type="text"
                                        class="form-control @error('old_url') is-invalid @enderror" id="old_url"
                                        placeholder="Old URL">
                                    @error('old_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="new_url" class="form-label">New URL</label>
                                    <input name="new_url" type="text"
                                        class="form-control @error('new_url') is-invalid @enderror" id="new_url"
                                        placeholder="New URL">
                                    @error('new_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 my-2">
                                    <label for="method" class="form-label">Redirection Code</label>
                                    <select name="method" id="method"
                                        class="form-select @error('method') is-invalid @enderror">
                                        <option value="301" {{ old('method') == '301' ? 'selected' : '' }}>301</option>
                                        <option value="302" {{ old('method') == '302' ? 'selected' : '' }}>302</option>
                                    </select>
                                    @error('method')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save Redirect</button>
                                </div>
                            </div>




                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('backend::layouts.master')
@section('content')
    <!-- Loader -->
    <div id="global-loader">
        <img src="/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- main-content -->
    <div class="main-content app-content">

        <!-- container -->
        <div class="main-container container-fluid">


            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Institutes Bulk Upload </span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Institutes</li>
                            <li class="breadcrumb-item" aria-current="page">Bulk-Upload</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $institute->filename }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->


            <div class="col-xl-12">


                <div class="table-responsive">


                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">File Name</th>
                                <th scope="col">Total No of Record Found</th>
                                <th scope="col">Is Migrated</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td scope="col">
                                    {{ $institute->filename }}
                                </td>
                                <td>
                                    @if ($institute->type == 1)
                                        {{ $institute->institutedata->count() }}
                                    @elseif ($institute->type == 2)
                                        {{ $institute->institutestreamdata->count() }}
                                    @endif

                                </td>
                                <td>
                                    {{ $institute->is_migrated == 1 ? 'Yes' : 'No' }}
                                </td>

                                <td scope="col">
                                    {{ \Carbon\Carbon::parse($institute->created_at)->format('d-m-Y h:i A') }}
                                </td>
                                <td scope="col">
                                    {{ \Carbon\Carbon::parse($institute->updated_at)->format('d-m-Y h:i A') }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            @if ($institute->type == 1)
                <div class="col-md-12 mt-4">
                    <table class="table  table-responsive table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Is Migrated?</th>
                                <th scope="col">if Any Error</th>
                                <th scope="col">Name</th>
                                <th scope="col">Is Recommended</th>
                                <th scope="col">Authorized Person</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Country</th>
                                <th scope="col">State</th>
                                <th scope="col">City</th>
                                <th scope="col">Area Id</th>
                                <th scope="col">Google Institute Address</th>
                                <th scope="col">latitude</th>
                                <th scope="col">longitude</th>
                                <th scope="col">website</th>
                                <th scope="col">leadership_name</th>
                                <th scope="col">leadership_designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($institute->institutedata as $data)
                                <tr>
                                    <td scope="col">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $data->is_migrated == 1 ? 'Yes' : 'No' }}

                                    </td>
                                    <td>
                                        {{ $data->any_error }}
                                    </td>

                                    <td scope="col">
                                        {{ $data->name }}
                                    </td>
                                    <td>
                                        {{ $data->is_recommended == 1 ? 'Yes' : 'No' }}

                                    </td>
                                    <td>
                                        {{ $data->authorized_person }}
                                    </td>
                                    <td>
                                        {{ $data->email }}
                                    </td>
                                    <td>
                                        {{ $data->mobile }}
                                    </td>
                                    <td>
                                        {{ $data->country_id }}
                                    </td>
                                    <td>
                                        {{ $data->state_id }}
                                    </td>
                                    <td>
                                        {{ $data->city_id }}
                                    </td>


                                    <td>
                                        {{ $data->area_id }}
                                    </td>



                                    <td>
                                        {{ $data->google_institute_address }}
                                    </td>

                                    <td>
                                        {{ $data->latitude }}
                                    </td>
                                    <td>
                                        {{ $data->longitude }}
                                    </td>

                                    <td>
                                        {{ $data->website }}
                                    </td>

                                    <td>
                                        {{ $data->leadership_name }}
                                    </td>
                                    <td>
                                        {{ $data->leadership_designation }}
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif
            @if ($institute->type == 2)
                <div class="col-md-12 mt-4">
                    <table class="table  table-responsive table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Is Migrated?</th>
                                <th scope="col">if Any Error</th>
                                <th scope="col">institute_id</th>
                                <th scope="col">category_id</th>
                                <th scope="col">stream_id</th>
                                <th scope="col">exam_id</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($institute->institutestreamdata as $data)
                                <tr>
                                    <td scope="col">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $data->is_migrated == 1 ? 'Yes' : 'No' }}

                                    </td>
                                    <td>
                                        {{ $data->any_error }}
                                    </td>

                                    <td scope="col">
                                        <div>{{ isset($data->institute->name) ? $data->institute->name : 'NA' }}</div>
                                        <div>{{ $data->institute_id }}</div>
                                    </td>
                                    <td>
                                        <div>{{ isset($data->category->name) ? $data->category->name : 'NA' }}</div>
                                        <div>{{ $data->category_id }}</div>

                                    </td>
                                    <td>
                                        <div>{{ isset($data->stream->name) ? $data->stream->name : 'NA' }}</div>
                                        <div>{{ $data->stream_id }}</div>
                                    </td>
                                    <td>
                                        <div>{{ isset($data->exam->name) ? $data->exam->name : 'NA' }}</div>
                                        <div>{{ $data->exam_id }}</div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Institutes Bulk Upload <span
                                class="badge badge-danger">
                                {{ $institutes->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Institutes</li>
                            <li class="breadcrumb-item active" aria-current="page">Bulk-Upload</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            @livewire('backend::institute-files-upload')

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')

                <div class="d-flex pb-3">
                    <a class="btn btn-md btn-primary mx-1" href="/files/institute_file_data.csv">Download
                        Institute Sample File</a>
                    <a class="btn btn-md btn-primary mx-1" href="/files/institute_stream_exam_files_data.csv">Download
                        Institute Stream Sample File</a>
                </div>
                <div class="table-responsive">
                    <div class="row">
                        @include('backend::institute.bulk._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">File Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Total No of Record Found</th>
                                <th scope="col">Total Migrated</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($institutes)
                                @foreach ($institutes as $institute)
                                    <tr>
                                        <td scope="col">
                                            {{ $institute->filename }}
                                        </td>
                                        <td scope="col">
                                            {{ $institute->type == 1 ? 'Institute' : 'Institute Stream' }}
                                        </td>
                                        <td>
                                             @if ($institute->type == 1) {{ $institute->institutedata->count() }} @elseif ($institute->type == 2) {{ $institute->institutestreamdata->count()  }} @endif 

                                        </td>
                                        <td>
                                            @if ($institute->type == 1) {{ $institute->institutedata()->where('is_migrated', true)->count() }} @elseif ($institute->type == 2) {{ $institute->institutestreamdata()->where('is_migrated', true)->count()  }} @endif 

                                        </td>

                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($institute->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($institute->updated_at)->format('d-m-Y h:i A') }}
                                        </td>




                                        <td scope="col">


                                            <a href="{{ route('institute.bulk.show', $institute->id) }}"
                                                data-toggle="tooltip" title="Manage File" class="btn btn-sm btn-primary"
                                                style="float: left; margin-left:10px;"><i
                                                    class="fas fa-sign-in-alt"></i></a>

                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="12">No Record Found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{ $institutes->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection
@push('css')
    @livewireStyles()
@endpush
@push('js')
    @livewireScripts()
@endpush

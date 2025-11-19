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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Exam Stream <span class="badge badge-danger"> {{ $examsstream->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Configuration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Exam Stream</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            
            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    {{-- <h4 class="card-title mg-b-0">Exam Stream</h4> --}}
                    <a class="btn btn-md btn-primary active" href="{{ route('configuration.stream.create') }}">Create</a>
                </div>
                <div class="table-responsive">
                    <div class="row">
                        @include('backend::configuration.stream._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="examstream">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Id</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Name</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Exam Category</th>
                                <th scope="col">Publish On Home Page</th>
                                <th scope="col">Publish On Category Page</th>

                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($examsstream->count() > 0)
                                @foreach ($examsstream as $examstream)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col">{{ $examstream->id }}</td>
                                        <td scope="col"><img src="{{ asset('storage/' . $examstream->icon) }}"
                                                alt="" width="40px" height="40px"></td>
                                        <td scope="col">{{ $examstream->name }}</td>
                                        <td scope="col">{{ ($examstream->priority==1) ? "Yes":"No" }}</td>
                                        <td scope="col">{{ $examstream->category->name }}</td>
                                        <td scope="col">{{ ($examstream->is_show_homepage == 1) ? 'Yes':'No' }}</td>
                                        <td scope="col">{{ ($examstream->is_show_categorypage == 1) ? 'Yes':'No' }}</td>

                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $examstream->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $examstream->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($examstream->created_at)->format('d-m-Y h:i A') }}</td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($examstream->updated_at)->format('d-m-Y h:i A') }}</td>
                                        <td scope="col">

                                            <a href="{{ route('configuration.stream.edit', $examstream->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left;"><i
                                                    class="fa fa-edit"></i></a>
                                                    @if ($examstream->exams->count() <= 0)
                                                    <form style="float: left;margin-left:10px;" method="post"
                                                        action="{{ route('configuration.stream.destroy', $examstream->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                    @endif
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
                    {{ $examsstream->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('script')
        @include('backend::layouts._datatable')
        <script>
            $(document).ready(function() {
                $('#examstream').DataTable();
            });
        </script>
    @endsection --}}

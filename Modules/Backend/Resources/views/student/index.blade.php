@extends('backend::layouts.master')
@livewireStyles
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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Users<span class="badge badge-danger">
                                {{ $students->count() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">

                <div class="table-responsive">
                    {{-- <div class="row">
                        @include('backend::blog._search')
                    </div> --}}

                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name </th>
                                <th scope="col">Mobile </th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($students)
                                @foreach ($students as $student)
                                    <tr>
                                        <td scope="col">{{ $student->name }}</td>
                                        <td scope="col">{{ $student->phone }}</td>
                                        <td scope="col">{{ $student->email }}</td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $student->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $student->status == 1 ? 'Active' : 'Suspend' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($student->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            <a style="margin-left:15px;" class="btn btn-sm {{ $student->status == 1 ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                href="{{ route('students.publish' , $student->id) }}">{{ $student->status == 1 ? 'Suspend' : 'Active' }}</a>

                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('students.destroy', $student->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this student?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
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

        </div>
    </div>
    @livewireScripts
@endsection

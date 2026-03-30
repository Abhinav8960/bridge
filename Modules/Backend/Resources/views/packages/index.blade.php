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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Packages</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Packages</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('packages.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::packages._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Package Name</th>
                                <th scope="col">Duration Type</th>
                                <th scope="col">No of centers</th>
                                <th scope="col">No of Courses</th>
                                <th scope="col">No of Streams</th>
                                <th scope="col">Course Enrollment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($packages)
                                @foreach ($packages as $package)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col">
                                            {{ $package->name }}
                                            <div class="text-muted">
                                               {{ $package->allotedTabs() }}

                                            </div>

                                        </td>
                                        <td scope="col">{{ ($package->package_duration_type == App\Models\Backend\Packages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY) ? "Fixed Validity (".$package->no_of_days." days)" : "As Per Duration" }}</td>
                                        <td scope="col">{{ $package->no_of_centers }}</td>
                                        <td scope="col">{{ $package->no_of_courses }}</td>
                                        <td scope="col">{{ $package->no_of_streams }}</td>
                                        <td scope="col">{{ $package->is_course_enrollment == 1 ? 'Yes':'No' }}</td>

                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $package->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $package->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($package->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($package->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{-- <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are You Sure to delete this?')"
                                                href="{{ route('popularcity.destroy', $city->id) }}"><i
                                                    class="fa fa-trash"></i></a> --}}

                                            <a href="{{ route('packages.edit', $package->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('packages.destroy', $package->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i
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
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
@section('script')
    {{-- <script type="javascript">
    document.onsubmit=function(){
        return confirm('Sure?')
    }
</script> --}}
@endsection

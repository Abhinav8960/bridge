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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Enroll List <span class="badge badge-danger"> {{ $enrolls->count() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enroll</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')


                <div class="table-responsive">
                    <div class="row">
                        @include('backend::includes._pagesize')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Institute</th>
                                <th scope="col">City</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($enrolls)
                                @foreach ($enrolls as $enrollData)
                                    <tr>
                                        <td scope="col">{{ $loop->iteration }}</td>
                                        <td scope="col">{{ $enrollData->name }}</td>
                                        <td scope="col">{{ $enrollData->institute }}</td>
                                        <td scope="col">{{ $enrollData->city }}</td>
                                        <td scope="col">{{ $enrollData->email }}</td>
                                        <td scope="col">{{ $enrollData->phone }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="6">No Record Found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{ $enrolls->links() }}
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

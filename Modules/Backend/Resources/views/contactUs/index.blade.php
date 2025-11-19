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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Contact List <span class="badge badge-danger">
                                {{ $model->count() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contcat List</li>
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
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                <th scope="col">Message</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($model)
                                @foreach ($model as $modelData)
                                    <tr>
                                        <td scope="col">{{ $loop->iteration }}</td>
                                        <td scope="col">{{ $modelData->name }}</td>
                                        <td scope="col">{{ $modelData->mobile }}</td>
                                        <td scope="col">{{ $modelData->email }}</td>
                                        @if ($modelData->type == 1)
                                            <td scope="col">{{ 'Institute Listing' }}</td>
                                        @elseif ($modelData->type == 2)
                                            <td scope="col">{{ "Student's Enquiry" }}</td>
                                        @elseif ($modelData->type == 3)
                                            <td scope="col">{{ 'Franchise Queries' }}</td>
                                        @elseif ($modelData->type == 4)
                                            <td scope="col">{{ 'General Queries' }}</td>
                                        @elseif ($modelData->type == 5)
                                            <td scope="col">{{ 'Not Listed or Others' }}</td>
                                        @endif


                                        <td scope="col">{{ $modelData->message }}</td>
                                        <td scope="col">{{ $modelData->created_at }}</td>
                                        <td scope="col">{{ $modelData->updated_at }}</td>
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
                    {{ $model->links() }}
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

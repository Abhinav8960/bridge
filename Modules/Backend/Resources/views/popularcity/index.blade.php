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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Popular City <span class="badge badge-danger">
                                {{ $cities->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Popular City</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('popularcity.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::popularcity._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Icon</th>
                                <th scope="col">City Name</th>
                                <th scope="col">State Name</th>
                                <th scope="col">Is Featured</th>
                                <th scope="col">Metro/Non-Metro</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cities)
                                @foreach ($cities as $city)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col"><img src="{{ asset('storage/' . $city->icon) }}" alt=""
                                                width="40px" height="40px"></td>
                                        <td scope="col">{{ $city->city_name }}</td>
                                        <td scope="col">{{ $city->state_name }}</td>
                                        <td scope="col">{{ $city->is_featured == 1 ? 'Yes' : 'No' }}</td>
                                        <td scope="col">{{ $city->is_metro == 2 ? 'Metro' : 'Non-Metro' }}</td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $city->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $city->status == 1 ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($city->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($city->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{-- <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are You Sure to delete this?')"
                                                href="{{ route('popularcity.destroy', $city->id) }}"><i
                                                    class="fa fa-trash"></i></a> --}}

                                            <a href="{{ route('popularcity.edit', $city->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('popularcity.destroy', $city->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
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
                    {{ $cities->links() }}
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

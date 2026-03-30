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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Leaderbaord</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leaderbaord</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('institute.leaderboard.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::institute.leaderbaord._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Institute Name</th>
                                <th scope="col">City</th>

                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($leaderbaords)
                                @foreach ($leaderbaords as $leaderbaord)
                                    <tr>
                                        <td scope="col">
                                            <div>
                                                {{ $leaderbaord->institute->name }}
                                            </div>
                                            <img src="{{ Storage::disk('public')->url($leaderbaord->file_path) }}"
                                                width="60px" height="60px" alt="{{ $leaderbaord->institute->name }}">

                                        </td>

                                        <td scope="col">
                                            {{ $leaderbaord->isAllIndia == true ? 'ALL India' : '' }}
                                            @if ($leaderbaord->isAllIndia == false)
                                                @foreach ($leaderbaord->LeaderbaordCities as $city)
                                                {{-- {{ $city->city_id }} --}}
                                                    {{ App\Helpers\LocationHelper::allCities()[$city->city_id]  }}
                                                    @if (!$loop->last)
                                                        |
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $leaderbaord->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $leaderbaord->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($leaderbaord->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($leaderbaord->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            <a href="{{ route('institute.leaderboard.edit', $leaderbaord->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            {{-- <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('institute.leaderboard.destroy', $leaderbaord->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form> --}}

                                        </td>
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
                    {{ $leaderbaords->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

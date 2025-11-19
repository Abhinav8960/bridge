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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Call To Action <span class="badge badge-danger"> {{ $calltoactions->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Configuration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Call To Action</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            
            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    {{-- <h4 class="card-title mg-b-0">Exam Category</h4> --}}

                    <a class="btn btn-md btn-primary active" href="{{ route('configuration.calltoaction.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    {{-- <div class="row">
                        @include('backend::configuration.calltoaction._search')
                    </div> --}}
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Call To Action Type/Placement</th>
                                <th scope="col">Specify Value</th>
                                <th scope="col">Specify Icon</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($calltoactions->count() > 0)
                                @foreach ($calltoactions as $calltoaction)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col">{{ $calltoaction->call_to_action_type == 1 ? 'Email' : 'Phone' }}
                                            <br>{{ ($calltoaction->is_showin_header == true) ? 'Header, ' : '' }}{{ ($calltoaction->is_showin_footer == true) ? 'Footer, ': '' }}{{ ($calltoaction->is_showin_contact_page ==true) ? 'Contact Page, ': '' }}
                                            {{ ($calltoaction->is_showin_mobile_app ==true) ? 'Mobile App': '' }}</td>
                                        <td scope="col">{{ $calltoaction->specify_value }}</td>
                                        <td scope="col">{{ $calltoaction->specify_icon }}</td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $calltoaction->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $calltoaction->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($calltoaction->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($calltoaction->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">

                                            <a href="{{ route('configuration.calltoaction.edit', $calltoaction->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('configuration.calltoaction.destroy', $calltoaction->id) }}">
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
                    {{ $calltoactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

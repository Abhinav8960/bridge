@extends('institute::layouts.master')
@livewireStyles
@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Center::{{ auth()->user()->name }}</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Information</li>
                            <li class="breadcrumb-item active" aria-current="page">Centers</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('institute::layouts.flash-message')
                @can('create-center')
                    <div class="d-flex justify-content-between pb-3">
                        <a class="btn btn-md btn-primary active" href="{{ route('center.create') }}">Create</a>
                    </div>
                @endcan

                <div class="table-responsive">
                    <div class="row">
                        @include('institute::information.center._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Center</th>
                                <th scope="col">Branch Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($centers)
                                @foreach ($centers as $center)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col">
                                            @if (!empty($center->latitude) && !empty($center->longitude))
                                            <a href="https://maps.google.com?q={{ $center->latitude }},{{ $center->longitude }}" target="_blank"><i class="fa fa-map-marked"></i>&nbsp;<b>{{ $center->name() }} </b></a>
                                            @else
                                            <b>{{ $center->name() }} </b>
                                            @endif


                                        </td>
                                        <td scope="col">
                                            {{ $center->branch_type == 1 ? 'Corporate Headquarter' : 'Branch' }}</td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $center->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $center->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($center->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">{{ \Carbon\Carbon::parse($center->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{-- <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are You Sure to delete this?')"
                                                href="{{ route('popularcity.destroy', $city->id) }}"><i
                                                    class="fa fa-trash"></i></a> --}}

                                            <a href="{{ route('center.edit', $center->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('center.destroy', $center->id) }}">
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
                    {{ $centers->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
@section('script')
    {{-- <script>
    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2("val");
            @this.set('selectExam', data);
        });
    });
</script> --}}
@endsection

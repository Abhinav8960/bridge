@extends('institute::layouts.master')
@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Leads <span class="badge badge-danger">
                                {{ $leads->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leads</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('institute::layouts.flash-message')
                

                <div class="table-responsive">
                    {{-- <div class="row">
                        @include('institute::streams._search')
                    </div> --}}
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Query</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($leads)
                                @foreach ($leads as $lead)
                                    <tr>
                                        <td scope="col">{{ $lead->name  }}</td>
                                        <td scope="col">{{ $lead->phone }}</td>
                                        <td scope="col">{{ $lead->email }}</td>
                                        <td scope="col">{{ $lead->subject }}</td>
                                        <td scope="col">{{ $lead->mesaage }}</td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($lead->created_at)->format('d-m-Y h:i A') }}
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
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @livewireStyles
@endpush
@push('js')
    @livewireScripts
@endpush

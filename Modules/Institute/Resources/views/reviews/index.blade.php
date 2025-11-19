@extends('institute::layouts.master')
@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Reviews <span class="badge badge-danger">
                                {{ $reviews->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
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
                                <th scope="col">Student</th>
                                <th scope="col">Title</th>
                                <th scope="col">Avg Rating</th>
                                <th scope="col">Overall Rating</th>
                                <th scope="col">Course Structure Rating</th>
                                <th scope="col">Raculty</th>
                                <th scope="col">Infrastructure</th>
                                <th scope="col">Doubt Sessions</th>
                                <th scope="col">Study Material</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reviews)
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td scope="col">{{ ($review->student->name) ? $review->student->name : 'Anonymous'  }}</td>
                                        <td scope="col">{{ $review->title }}</td>
                                        <td scope="col">{{ $review->average_rating }}</td>
                                        <td scope="col">{{ $review->overall_rating }}</td>
                                        <td scope="col">{{ $review->coursestructure_rating }}</td>
                                        <td scope="col">{{ $review->faculty_rating }}</td>
                                        <td scope="col">{{ $review->infrastructure_rating }}</td>
                                        <td scope="col">{{ $review->doubtsessions_rating }}</td>
                                        <td scope="col">{{ $review->studymaterial_rating }}</td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($review->created_at)->format('d-m-Y h:i A') }}
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
                    {{ $reviews->links() }}
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

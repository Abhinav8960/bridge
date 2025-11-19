{{-- @extends('backend::layouts.master') --}}
@extends('institute::layouts.master')

@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Enrollments <span class="badge badge-danger">
                                {{ $enrollments->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enrollments</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('institute::layouts.flash-message')
                {{-- <div class="d-flex justify-content-between pb-3">
                    @can('create-stream')
                        <a class="btn btn-md btn-primary active" href="{{ route('institute.streams.create') }}">Create</a>
                </div> --}}

                <div class="table-responsive">
                    {{-- <div class="row">
                        @include('backend::entrollment._search')
                    </div> --}}
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Institute</th>
                                <th scope="col">Booking amount</th>
                                <th scope="col">Breakup</th>
                                <th scope="col">Course</th>
                                <th scope="col">Total Fees</th>
                                <th scope="col">Discount%</th>
                                <th scope="col">Discount Fees</th>
                                <th scope="col">Payment Ref</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($enrollments)
                                @foreach ($enrollments as $enrollment)
                                    <tr @if ($enrollment->is_refund == 1)
                                        text-danger
                                    @endif>>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}

                                        <td>
                                            {{ $enrollment->buyer_name }}
                                        </td>
                                        <td scope="col">
                                            {{ $enrollment->phone }}
                                        </td>
                                        <td scope="col">
                                            {{ $enrollment->institute->name ?? '' }}
                                        </td>
                                        <td scope="col">
                                            {{ $enrollment->amount }}
                                        </td>
                                        <td scope="col">
                                            <div> {{ $enrollment->tax->is_breakup == true ? 'Yes' : 'No' }} </div>
                                            @if ($enrollment->tax->is_breakup == true)
                                                <table class="table">
                                                    @foreach ($enrollment->tax->breakups as $breakups)
                                                        <tr>
                                                            <td>{{ $breakups->name }}</td>
                                                            <td>{{ $breakups->percentage }} %</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </td>
                                        <td scope="col">
                                            <div>{{ $enrollment->course_title ?? ''}}
                                                ({{ $enrollment->duration ?? ''}}
                                                months)
                                            </div>
                                            <div><span> {{ $enrollment->institute->name ?? ''}}</span></div>
                                            <p>{{ $enrollment->institute->area ?? '' }},{{ $enrollment->institute->city_name ?? ''}},{{ $enrollment->institute->state_name  ?? ''}}
                                            </p>
                                        </td>
                                        <td>
                                            {{ $enrollment->course_fees ?? ''}}
                                        </td>
                                        <td>
                                            {{ $enrollment->course_discount_percentage . '%' }}
                                        </td>
                                        <?php 

                                            $amount = $enrollment->course_fees;
                                            $discount_amount = ($enrollment->course_fees * $enrollment->course_discount_percentage) / 100;
                                             ?>
                                        <td>
                                            {{ $discount_amount }}
                                        </td>
                                        <td>
                                            {{ $enrollment->instamojo->payment_id ?? ''}}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($enrollment->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($enrollment->updated_at)->format('d-m-Y h:i A') }}
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
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

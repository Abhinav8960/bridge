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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Payment Success</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Success</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('layouts.flash-message')

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::reports._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="examstream">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                {{-- <th scope="col">Email</th> --}}
                                <th scope="col">Institute</th>
                                <th scope="col">Taxation</th>
                                <th scope="col">Booking amount</th>
                                <th scope="col">Course</th>
                                <th scope="col">Course Fees</th>

                                <th scope="col">Payment Ref</th>
                                <th scope="col">Status</th>

                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($paymentReport->count() > 0)
                                @foreach ($paymentReport as $report)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $report->buyer_name }}
                                        </td>
                                        <td>
                                            {{ $report->phone }}
                                        </td>
                                        {{-- <td>
                                            {{ $report->email }}
                                        </td> --}}
                                        <td>
                                            <div>{{ $report->institute->name ?? '' }}<div>
                                                    <div><b>Preferred Location:</b> {{ $report->branch->branch_name ?? '' }}
                                                        <div>
                                        </td>

                                        <td scope="col">
                                            18% GST
                                            ({{ $report->tax_type_id == \App\Helpers\Helper::TAX_TYPE_EXCLUSIVE ? 'Exc' : 'Inc' }})
                                            {{-- <div> {{ $report->tax->is_breakup == true ? 'Yes' : 'No' }} </div> --}}
                                            {{-- @if ($report->tax->is_breakup == true)
                                                <table class="table">
                                                    @foreach ($report->tax->breakups as $breakups)
                                                        <tr>
                                                            <td>{{ $breakups->name }}</td>
                                                            <td>{{ $breakups->percentage }} %</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif --}}
                                        </td>
                                        <td scope="col">
                                            {{ $report->amount_charged }}
                                        </td>

                                        <td scope="col">
                                            <div>{{ $report->course_title }} ({{ $report->duration }}
                                                months)</div>
                                            <div><span> {{ $report->institute->name }}</span></div>
                                            <p>{{ $report->institute->area }},{{ $report->institute->city_name }},{{ $report->institute->state_name }}
                                            </p>
                                        </td>

                                        <td scope="col">
                                            <div><b>Total Fees:</b> Rs. {{ $report->course_fees }}</div>
                                            <div><b>Discount:</b> {{ $report->course_discount . '%' }}</div>
                                            <div>
                                                @php
                                                    
                                                        $amount = $report->course_fees;
                                                        $discount_amount = ($report->course_fees * $report->course_discount) / 100;
                                                    
                                                @endphp
                                                <b>Discount Amount:</b> Rs.{{ $discount_amount }}
                                            </div>
                                        </td>


                                        <td>
                                            {{ $report->payment_id }}
                                        </td>
                                        <td>
                                            Success
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d h:i A') }}
                                        </td>
                                        <td>
                                            @if ($report->is_refunded == false)
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $loop->iteration }}"
                                                data-bs-whatever="@mdo"><i class="fa fa-undo"></i></button>

                                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure
                                                                you want to refund of {{ $report->buyer_name }}?
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post"
                                                                action="{{ route('payment.refund', ['payment_id' => encrypt($report->payment_id)]) }}">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="mb-3">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Reason:</label>
                                                                    <input type="text" name="reason"
                                                                        class="form-control w-100" id="reason" required>
                                                                    
                                                                </div>
                                                                <button class="btn btn-sm btn-info"
                                                                    type="submit">Refund</button>
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        </td>


                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">

                    {{-- {{ $platform->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

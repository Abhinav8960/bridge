@extends('layouts.master')

@section('content')


       <!-- --------- Breadcrumbs ---------- -->

       <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Payment Declined Page</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- --------- Breadcrumbs ---------- -->

    <!----------- Declined Payment  ------------ -->

    <section class="payment-success payment-declined">
        <div class="container">
            <div class="payment-success__bg">
                <div class="row">
                    <div class="payment-success__content">
                        <div class="payment-success__content__heading">
                            <img src="/assets/skoodos/assets/img/Payment-Alert.png" alt="">
                        </div>
                        <div class="payment-success__content__text">
                            <h2>Payment Declined!</h2>
                            <div class="payment-contain">
                                <div class="row mb-4">
                                    <div class="col-7">
                                        <p>Username</p>
                                        <span>{{ strtoupper($payment->buyer_name) }}</span>
                                    </div>
                                    <div class="col-5">
                                        <p>Phone</p>
                                        <span>{{ $payment->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-7">
                                        <p>Course</p>
                                        <span>{{ strtoupper($payment->course->course_title ?? '') }}</span>
                                    </div>
                                    <div class="col-5">
                                        <p>Payment Ref</p>
                                        <span>{{ strtoupper($payment->buyer_name) }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('Y') }}/{{ $payment->payment_id }}</span>
                                    </div>
                                </div>
                                {{-- <div class="row mb-4">
                                    <div class="col-7">
                                        <p>User ID</p>
                                        <span>SELIN/G{{ $payment->id }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('Y') }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('m') }}{{ \Carbon\Carbon::parse($payment->created_at)->format('d') }}</span>
                                    </div>
                                    <div class="col-5">
                                        <p>Payment Ref</p>
                                        <span>{{ strtoupper($payment->buyer_name) }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('Y') }}/{{ $payment->payment_id }}</span>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="btn-wrapper d-flex justify-content-center">
                                <a href="{{ route('payment.reinitiate',encrypt($payment->id)) }}" class="btn blue-btn">Retry Payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


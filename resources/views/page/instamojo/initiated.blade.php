@extends('layouts.master')

@section('content')
   

       <!-- --------- Breadcrumbs ---------- -->

       <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Payment initiated Page</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- --------- Breadcrumbs ---------- -->

    <!----------- Declined Payment  ------------ -->

    <section class="payment-success payment-declined data-payment-id" data-payment-id="{{ $payment->payment_id }}">
        <div class="container">
            <div class="payment-success__bg">
                <div class="row">
                    <div class="payment-success__content">
                        <div class="payment-success__content__heading">
                            <img src="/assets/skoodos/assets/img/Payment-Alert.png" alt="">
                        </div>
                        <div class="payment-success__content__text">
                            <h2>Payment initiated, kindly wait!</h2>
                            
                            <div class="payment-contain">
                                <div class="row mb-4">
                                    <div class="col-12 text-center mb-3">
                                        <div id="timer_div"></div>
                                    </div>
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
                                        <p>User ID</p>
                                        <span>SELIN/G{{ $payment->id }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('Y') }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('m') }}{{ \Carbon\Carbon::parse($payment->created_at)->format('d') }}</span>
                                    </div>
                                    <div class="col-5">
                                        <p>Payment Ref</p>
                                        <span>{{ strtoupper($payment->buyer_name) }}/{{ \Carbon\Carbon::parse($payment->created_at)->format('Y') }}/{{ $payment->payment_id }}</span>
                                    </div>
                                </div>
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

@push('scripts')
    <script>
        var timeLeft = 30;
        var elem = document.getElementById('timer_div');

        var timerId = setInterval(countdown, 1000);

        function countdown() {
            if (timeLeft == -1) {
                clearTimeout(timerId);
                doSomething();
            } else {
                elem.innerHTML = timeLeft + ' seconds remaining';
                timeLeft--;
            }
        }


        function doSomething() {
            var payment = $('.data-payment-id').attr('data-payment-id');
            var url = "{{ route('payment.paymentload', ':payment') }}";
            url = url.replace(':payment', payment);
            window.location = url;
        }
    </script>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Invoice</title>


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!--   bootstrap link --- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link href="/assets/skoodos/assets/bridge-invoice/assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ====---  Invoice ---==== -->

    <section class="invoice">
        <div class="invoice__heading d-flex justify-content-between align-items-center">
            <div class="invoice__heading__logo">
                <img src="/assets/skoodos/assets/img/Group 9.png" alt="">
                <h1>Invoice</h1>
            </div>
            <div class="d-flex flex-column align-items-end">
                <h4>{{ strtoupper($enrollment->buyer_name) }}/{{ \Carbon\Carbon::parse($enrollment->created_at)->format('Y') }}/{{ $enrollment->instamojo->payment_id }}
                </h4>
                <p>{{ \Carbon\Carbon::parse($enrollment->created_at)->format('d M Y') }}</p>
            </div>
        </div>
        <div class="invoice__content">
            <div class="invoice__content__text">
                <div class="text-center mb-3">
                    <h2>{{ $enrollment->course_title }} ({{ $enrollment->duration }} months)</h2>
                    <h3><span> {{ $enrollment->institute->name }}</span></h3>
                    <p>{{ $enrollment->institute->area }},{{ $enrollment->institute->city_name }},{{ $enrollment->institute->state_name }}

                    </p>
                </div>
                <div class="row">
                    <div class="col-7">
                        <p>Booking Amount</p>
                        <span>Rs. {{ $enrollment->amount_without_tax }}
                            @if ($enrollment->tax)
                                (+{{ $enrollment->tax->name }}:
                                Rs.{{ $enrollment->amount_charged - $enrollment->amount_without_tax }})
                            @endif
                        </span>
                    </div>
                    <div class="col-5">
                        <p>Total Fee</p>
                        <p>

                            @if ($enrollment->course_discount_percentage > 0)
                                <span class="strikeout"> Rs:
                                    {{ $enrollment->course_fees }}</span>
                            @endif

                            Rs.
                            {{ $enrollment->netfees() }}

                        </p>
                    </div>
                    {{-- <div class="col-lg-3  d-flex">
                        <div class="m-stream-icon-bg"
                            style="background-image: url(/assets/skoodos/assets/img/microsite/caurses/discount.png);background-repeat: no-repeat;background-size: contain;padding: 12px 36px 15px 57px;">
                            <p><span><b>{{ $enrollment->course->discount }}</b><sup>%</sup></span>
                                Discount
                            </p>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="invoice__content__text invite-detail">
                <h2>Student Details</h2>
                <div class="row mb-4">
                    <div class="col-7">
                        <p>Name</p>
                        <span>{{ strtoupper($enrollment->buyer_name) }}</span>
                    </div>
                    {{-- <div class="col-5">
                        <p>Student ID</p>
                        <span>{{ strtoupper($enrollment->buyer_name) }}/{{ \Carbon\Carbon::parse($enrollment->created_at)->format('Y') }}/{{ $enrollment->instamojo->payment_id }}</span>
                    </div> --}}
                    <div class="col-5">
                        <p>Payment Ref</p>
                        <span>{{ $enrollment->instamojo->payment_id }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <p>Email</p>
                        <span>{{ $enrollment->email }}</span>
                    </div>
                    <div class="col-5">
                        <p>Phone</p>
                        <span>{{ $enrollment->phone }}</span>
                    </div>
                </div>
            </div>
            <div class="invoice__content__text invoice-details">
                @if ($booking_account)
                    <div class="invoice-details__heading">
                        <h3>{{ isset($booking_account) ? $booking_account->company_name : '' }}</h3>
                        <p>{{ isset($booking_account) ? $booking_account->area : '' }},{{ isset($booking_account) ? $booking_account->city_name : '' }},{{ isset($booking_account) ? $booking_account->state_name : '' }}
                        </p>
                        <strong>GSTIN - {{ isset($booking_account) ? $booking_account->gst_number : '' }}</strong>
                    </div>
                @endif
                <table>
                    <tbody>
                        <tr class="border-bottom">
                            <td><span> Invoice No:</span> <br><strong>{{ $enrollment->invoice_number }}</strong></td>
                            <td colspan="3" class="text-end"><span> Date</span>
                                <br><strong>{{ \Carbon\Carbon::parse($enrollment->created_at)->format('d M Y') }}</strong>
                            </td>
                        </tr>
                        {{-- @dd($enrollment->saccode) --}}
                        <tr class="border-bottom">
                            <td><span>Item</span></td>
                            <td><span>Qty</span></td>
                            <td class="text-end"><span>Rate</span></td>
                            <td class="text-end"><span>Amount</span></td>
                        </tr>
                        <tr class="border-bottom">
                            <td>
                                <strong>Course Booking Fee</strong>

                            </td>
                            <td><strong>01</strong></td>
                            <td class="text-end"><strong>Rs. {{ $enrollment->amount_without_tax }}</strong></td>
                            <td class="text-end"><strong>Rs. {{ $enrollment->amount_without_tax }}</strong></td>
                        </tr>
                        <tr class="border-bottom">
                            <td><strong>SAC
                                    <span>{{ isset($enrollment->saccode) ? $enrollment->saccode->sac_code : '' }}</span></strong>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><span>Total</span></td>
                            <td class="text-end"><strong>Rs.{{ $enrollment->amount_without_tax }}</strong></td>
                        </tr>

                        {{-- <tr>
                            <td></td>
                            <td colspan="2"><span>Discount</span></td>
                            <td class="text-end"><strong>{{ $enrollment->course->discount }}%</strong></td>
                        </tr> --}}
                        @if (count($taxbreakup) > 0)
                            @foreach ($taxbreakup as $breakups)
                                <tr>
                                    <td></td>
                                    <td colspan="2" class="@if ($loop->last) border-bottom @endif">
                                        {{ $breakups['name'] }} @ {{ $breakups['percentage'] }}%</td>
                                    <td class="text-end @if ($loop->last) border-bottom @endif">
                                        <strong>Rs. {{ \App\Helpers\Helper::taxableamount($enrollment->amount_without_tax, $breakups['percentage']) }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td></td>
                            <td colspan="2"><strong>Grand Total</strong></td>
                            <td class="text-end"><strong>Rs.{{ $enrollment->amount_charged }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="invoice-footer">
        <div class="invoice__content__text social text-center">
            <p><span>Mail Us - </span><a
                    href="mailto:hello@spherionsolutions.com"><strong>hello@spherionsolutions.com</strong></a>
            </p>
            <p><span>Contact Us - </span><a href="tel:+91 837 792 1512"><strong>+91 837 792
                        1512</strong></a></p>
        </div>
        <div class="download-invoice text-center d-print-none">
            <button class="btn social" type="button" onclick="window.print()">Download Invoice</button>
        </div>
    </section>


    <!-- ====---  Invoice ---==== -->

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <style>
        /* .m-stream-icon-bg p {
            color: white;
        }

        .m-stream-icon-bg span {
            color: #d0de29;
        } */

        .strikeout::after {
            border-bottom: 0.125em solid red;
            content: "";
            left: 0;
            margin-top: calc(0.125em / 2 * -1);
            position: absolute;
            right: 0;
            top: 57%;
        }

        .strikeout {
            line-height: 1em;
            position: relative;
        }
    </style>
</body>

</html>

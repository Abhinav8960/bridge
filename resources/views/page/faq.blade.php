@extends('layouts.master')
@section('title')
    Skoodos Bridge FAQs: Get answers for your Questions
@endsection
@section('metadescription')
    Get quick answers to your questions. Navigate Skoodos Bridge services effortlessly with our concise FAQ section.
@endsection
@section('keyword')
    Why Choose Us, Frequently Asked Questions, Common Queries, FAQ, Popular Queries, Regular Questions, Everyday Concerns
@endsection
@section('content')
    <main class="faq-bg">



        <!-- --------------- Faq banner------ -->

        <section class="faq-banner">
            <img src="/assets/skoodos/assets/img/faq/FAQ's-Banner.png" alt="" class="w-100">
        </section>

        <!--+======================= End Banner ======================= -->

        <!-- --------- Breadcrumbs ---------- -->

        <div id="breadcrumbs">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">FAQ's</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- ------- End Bradcrumb ------->

        <!-- --================= Faq ==================---->

        <section class="faq">
            <div class="container">
                <div class="chapters__content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="accordion" id="accordionExample">
                                @if ($faqs->count() > 0)
                                    @foreach ($faqs as $key => $faq)
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="heading_{{ $key }}">
                                                <button
                                                    class="accordion-button @if ($loop->first) @else collapsed @endif"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse_{{ $key }}"
                                                    aria-expanded="@if ($loop->first) true @else false @endif"
                                                    aria-controls="collapse_{{ $key }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h3>
                                            <div id="collapse_{{ $key }}"
                                                class="accordion-collapse collapse @if ($loop->first) show @endif"
                                                aria-labelledby="heading_{{ $key }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    No Data Available
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

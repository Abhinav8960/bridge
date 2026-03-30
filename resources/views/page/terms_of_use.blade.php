@extends('layouts.master')

@section('content')
    <main class="faq-bg">

        <!-- ---------------  banner------ -->

        <section class="faq-banner">
            <img src="/assets/skoodos/assets/img/Term-of-use.jpg" alt="" class="w-100">
        </section>

        <!--+======================= End Banner ======================= -->

        <!-- --------- Breadcrumbs ---------- -->

        <div id="breadcrumbs">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                        <li class="breadcrumb-item active">Term of Use</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- ------- End Bradcrumb ------->

        <!-- --================= Faq ==================---->

        <section class="faq" id="privacy">
            <div class="container">
                <h1>Terms Of Use
                </h1>
                <hr>
                @if (!empty($date))
                    <small>Effective date: {{ \Carbon\Carbon::parse($date->effective_date)->format('j F , Y') }} <br>Last
                        updated on: {{ \Carbon\Carbon::parse($date->last_updated)->format('j F , Y') }}</small>
                @endif

                @if (!empty($termsOfUse))
                    @foreach ($termsOfUse as $terms)
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>{{ $terms->module_title }}</h2>
                                <ul>
                                    {!! $terms->module_description !!}
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </section>
    </main>
@endsection

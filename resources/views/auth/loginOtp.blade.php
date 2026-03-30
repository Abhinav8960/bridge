@extends('layouts.master')

@section('content')

    <main id="main">

        <!-- ------------------Login--------------------- -->

        <section class="login">
            @livewire('auth.login-with-otp')
        </section>

    </main><!-- End #main -->
@endsection

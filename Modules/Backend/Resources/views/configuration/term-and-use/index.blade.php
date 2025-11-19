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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Term Of Use <span
                                class="badge badge-danger">{{ $terms->count() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Configuration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Term Of Use</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            @livewire('backend::configuration.term-and-use.listing', ['model' => $model])


            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    {{-- <h4 class="card-title mg-b-0">Exam</h4> --}}
                    <a class="btn btn-md btn-primary active"
                        href="{{ route('configuration.termanduse.create') }}">Create</a>
                </div>
                <div class="table-responsive">
                    <div class="row">
                        {{-- @include('backend::configuration.user._search') --}}
                    </div>

                    @livewire('backend::configuration.term-and-use.sequence')

                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{-- {{ $terms->links() }} --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    @livewireStyles
@endsection
@section('script')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endsection

@extends('institute::layouts.master')

@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Publish</span>
                    </div>

                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="row">

                <div class="col-md-12">
                    <div class="card card-aside custom-card">

                        <div class="card-body">
                            <h5 class=" card-title main-content-label tx-dark tx-medium mg-b-10">Information Tabs</h5>

                            @livewire('institute::dashboard.information-tabs')
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('css')
    @livewireStyles()
@endpush
@push('js')
    @livewireScripts()
@endpush

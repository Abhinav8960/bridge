@extends('backend::layouts.master')

@section('content')
    <!-- main-content -->
    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-header justify-content-between" style="padding-inline:12px;">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">FAQ Categories</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Configuration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <form action="{{ route('configuration.faqcategory.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    @include('backend::configuration.faq-category._form')
                </form>
            </div>
        </div>
    </div>
@endsection


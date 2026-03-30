@extends('backend::layouts.master')

@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumb-header justify-content-between" style="padding-inline:12px;">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Leaderbaord</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leaderbaord</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->
            <div class="col-md-12 col-lg-12">
                <form action="{{ route('institute.leaderboard.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    @livewire('backend::leaderbaord', ['model' => $model])

                </form>
            </div>
        </div>
    </div>
@endsection
@section('style')
    @livewireStyles
@endsection
@section('script')
    @livewireScripts
@endsection

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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">FAQ Categories <span
                                class="badge badge-danger">{{ $faqcategories->total() }} </span></span>
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

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    {{-- <h4 class="card-title mg-b-0">Exam</h4> --}}
                    <a class="btn btn-md btn-primary active"
                        href="{{ route('configuration.faqcategory.create') }}">Create</a>
                </div>
                <div class="table-responsive">
                    <div class="row">
                        {{-- @include('backend::configuration.user._search') --}}
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="exam">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">FAQ Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($faqcategories->count() > 0)
                                @foreach ($faqcategories as $faqcategory)
                                    <tr>
                                        <td scope="col">{{ $loop->iteration }}</td>

                                        <td scope="col">{{ $faqcategory->faq_category }}</td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $faqcategory->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $faqcategory->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($faqcategory->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($faqcategory->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            <a href="{{ route('configuration.faqcategory.edit', $faqcategory->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left" data-bs-placement="top"
                                                title="Update"><i class="fa fa-edit"></i></a>
                                            <?php
                                                if($faqcategory->status==1){
                                                   if(count($faqcategory->faqs)==0){
                                                   ?>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('configuration.faqcategory.destroy', $faqcategory->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                            <?php }
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="12">No Record Found</th>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{ $faqcategories->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection

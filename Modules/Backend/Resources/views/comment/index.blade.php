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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">{{ ucfirst($blog->title) }} / Comments
                            ({{ count($blog->comments) }})</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Comment</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="table-responsive">
                    <div class="row">
                        {{-- @include('backend::institute.feature._search') --}}
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                                <th scope="col">User Detail</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($comments)
                                @foreach ($comments as $blogcomment)
                                    <tr>
                                        <td scope="col"><b>{{ $blogcomment->comment }}
                                        </td>
                                        <td scope="col">
                                            <span
                                                class="btn btn-rounded
                                            {{ $blogcomment->is_approved == 1 ? 'btn-success' : ($blogcomment->is_approved == 2 ? 'btn-danger' : 'btn-warning') }}">
                                                {{ $blogcomment->is_approved == 1 ? 'Approved' : ($blogcomment->is_approved == 2 ? 'Rejected' : 'On Hold') }}
                                            </span>
                                        </td>

                                        <td scope="col">
                                            @if (empty($blogcomment->blog->author))
                                                <div>{{ $blogcomment->user->name ?? '' }}</div>
                                                <div>{{ $blogcomment->user->email ?? '' }}</div>
                                                <div>{{ $blogcomment->user->phone ?? '' }}</div>
                                            @else
                                                <div>{{ $blogcomment->blog->author }}</div>
                                                @endif
                                        </td>

                                        <td scope="col">
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('blog.comment.destroy', $blogcomment->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="6">No Record Found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{-- {{ $instituteListFeatures->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    @include('backend::institute.modal.send_credential')
@endsection

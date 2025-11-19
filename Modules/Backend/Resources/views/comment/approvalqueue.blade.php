@extends('backend::layouts.master')
@livewireStyles
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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Blog Comment Approval <span
                                class="badge badge-danger">
                                {{ $blogcomment->count() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Comment Approval</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')


                <div class="table-responsive">
                    <div class="row">
                        @include('backend::comment._search')
                    </div>

                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Comment </th>
                                <th scope="col">Date / Time </th>
                                <th scope="col">User Details</th>
                                <th scope="col">Status </th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($blogcomment)
                                @foreach ($blogcomment as $blog)
                                    <tr>
                                        <td scope="col"><b>{{ $blog->blog->title ?? '' }}
                                        </td>
                                        <td scope="col"><b>{{ $blog->comment }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            @if (empty($blog->blog->author))
                                                <div>{{ $blog->user->name ?? '' }}</div>
                                                <div>{{ $blog->user->email ?? '' }}</div>
                                                <div>{{ $blog->user->phone ?? '' }}</div>
                                            @else
                                                <div>{{ $blog->blog->author ?? '' }}
                                            @endif
                                        </td>
                                        <td scope="col">
                                            <span
                                                class="btn btn-rounded
                                            {{ $blog->is_approved == 1 ? 'btn-success' : ($blog->is_approved == 2 ? 'btn-danger' : 'btn-warning') }}">
                                                {{ $blog->is_approved == 1 ? 'Approve' : ($blog->is_approved == 2 ? 'Rejected' : 'On Hold') }}
                                            </span>
                                        </td>


                                        <td scope="col">
                                            @if ($blog->is_approved != App\Models\Backend\BlogComment::REJECT)
                                                <a href="#" class="btn btn-sm btn-link changeChapter"
                                                    data-bs-toggle="modal" data-bs-target="#chapterchangeModel"
                                                    data-action="{{ route('comment.publish', $blog->id) }}"
                                                    data-bs-placement="top" title="Change Chapter Or Designation"
                                                    style="float: left; margin-left:10px;">Moderation</a>
                                            @endif



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

        </div>
    </div>
    <div class="modal fade" id="chapterchangeModel" tabindex="-1" aria-labelledby="chapterchangeModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chapterchangeModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="chapterchangeForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        @livewire('backend::comment-queue')

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @livewireScripts
    <script>

        $(".changeChapter").click(function() {
            console.log($(this).attr('data-package'));
            $('#chapterchangeModelLabel').html($(this).attr('data-name'));
            $('#chapterchangeForm').attr('action', $(this).attr('data-action'));
            $('#chapterchangeForm #package_id option[value="' + $(this).attr('data-package') + '"]').prop(
                'selected', true)
        });

        </script>
@endsection

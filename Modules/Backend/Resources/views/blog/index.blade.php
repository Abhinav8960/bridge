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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Blog<span class="badge badge-danger">
                                {{ $blogs->count() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('blog.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::blog._search')
                    </div>

                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Image Preview </th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Comment Allowed</th>
                                <th scope="col">Comment Approval</th>
                                <th scope="col">Author</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Published Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($blogs->category); --}}
                            @if ($blogs)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}

                                        <td scope="col">
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="" width="80px"
                                                height="50px">
                                        </td>
                                        <td scope="col">{{ $blog->title }}</td>
                                        <td scope="col">
                                            @foreach ($blog->categories as $blogcat)
                                                {{ $loop->first ? '' : ', ' }}
                                                {{ isset($blogcat->categoryBlog->name) ? $blogcat->categoryBlog->name : 'Category Deleted' }}
                                            @endforeach
                                        </td>
                                        <td scope="col">
                                            @if ($blog->is_comment == \App\Models\Backend\Blog::COMMENTALLOWED)
                                                Yes <a class="btn btn-rounded btn-info"
                                                    href="{{ route('blog.show', $blog->id) }}">{{ count($blog->comments) }}</a>
                                            @elseif ($blog->is_comment == \App\Models\Backend\Blog::COMMENTNOTALLOWED)
                                                No
                                            @endif
                                        </td>

                                        <td>
                                            <span>
                                                {{ $blog->is_approved == \App\Models\Backend\Blog::APPROVED ? 'Yes' : 'No' }}</span>
                                        </td>

                                        <td scope="col">
                                            @if (empty($blog->author))
                                                {{ $blog->user ? $blog->user->name : '' }}
                                            @else
                                                {{ $blog->author }}
                                            @endif
                                        </td>
                                        <td scope="col">
                                            {{-- <span
                                                class="btn btn-rounded
                                                {{ $blog->status == 1 ? 'btn-success' : ($blog->status == 2 ? 'btn-info' : 'btn-danger') }}">
                                                {{ $blog->status == 1 ? 'Active' : ($blog->status == 2 ? 'Scheduled' : 'Suspended') }}
                                            </span> --}}
                                            <span
                                                class="btn btn-rounded
                                            {{ $blog->published_date_time > date('Y-m-d H:i:s') ? 'btn-info' : ($blog->status == 1 ? 'btn-success' : 'btn-danger') }}
                                            ">
                                                {{ $blog->published_date_time > date('Y-m-d H:i:s') ? 'Scheduled' : ($blog->status == 1 ? 'Active' : 'Suspended') }}
                                            </span>
                                        </td>
                                        <td scope="col">
                                            {{-- {{ \Carbon\Carbon::parse($blog->schedule_date)->format('d-m-Y') }},
                                            {{ \Carbon\Carbon::parse($blog->schedule_time)->format('h:i A') }} --}}
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d-m-Y') }},
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('h:i A') }}
                                        </td>

                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($blog->published_date_time)->format('d-m-Y h:i A') }}
                                        </td>

                                        {{-- <td scope="col"><span
                                                class="btn btn-rounded {{ $blog->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $blog->status == 1 ? 'Published' : 'Suspended' }}</span>
                                        </td> --}}
                                        <td scope="col">
                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary"
                                                style="float: left"><i class="fa fa-edit"></i></a>
                                            @if ($blog->status != 2)
                                                <a class="btn btn-sm {{ $blog->status == 1 ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                    href="{{ route('blog.publish', $blog->id) }}">{{ $blog->status == 1 ? 'Suspend' : 'Active' }}</a>
                                            @endif
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('blog.destroy', $blog->id) }}">
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
                                    <th colspan="12">No Record Found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @livewireScripts
@endsection
@section('script')
    {{-- <script type="javascript">
    document.onsubmit=function(){
        return confirm('Sure?')
    }
</script> --}}
@endsection

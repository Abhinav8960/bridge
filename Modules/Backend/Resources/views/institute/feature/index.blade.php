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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Institute Featured</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Institutes Featurd List</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('institute.feature.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::institute.feature._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Institute Name</th>
                                <th scope="col">Page</th>

                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($instituteListFeatures)
                                @foreach ($instituteListFeatures as $InstituteFeatured)
                                    <tr>
                                        <td scope="col"><b>{{ $InstituteFeatured->institute->name }}
                                        </td>
                                        <td scope="col">
                                            {{ $InstituteFeatured->isHome == true ? 'Home' : '' }}
                                            @if ($InstituteFeatured->isCategory == true)
                                                <div>

                                                    {{ $InstituteFeatured->isCategory == true ? 'Category' : '' }}
                                                    (@foreach ($InstituteFeatured->FeturelistCategories as $feturelistCategories)
                                                        {{ $feturelistCategories->category->name }}
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach)
                                                </div>
                                            @endif
                                        </td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $InstituteFeatured->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $InstituteFeatured->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($InstituteFeatured->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($InstituteFeatured->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            <a href="{{ route('institute.feature.edit', $InstituteFeatured->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('institute.feature.destroy', $InstituteFeatured->id) }}">
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
                    {{ $instituteListFeatures->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('backend::institute.modal.send_credential')
@endsection

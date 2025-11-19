@extends('backend::layouts.master')
@livewireStyles
@section('content')
    <!-- Loader -->
    <div id="global-loader">
        <img src="/assets/backend/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- main-content -->
    <div class="main-content app-content" style="margin-top:70px;">

        <!-- container -->
        <div class="main-container container-fluid">


            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Redirects <span
                                class="badge badge-danger">{{ $redirectDatas->count() }}</span> <span>
                            </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Redirect</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->


            <div class="col-xl-12">
                {{-- @include('backend::layouts.flash-message') --}}
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('redirectCreate') }}">Create

                    </a>


                </div>

                <div class="table-responsive">
                    <div class="row">
                        {{-- @include('backend.academy.contact._search') --}}
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="event">
                        <thead>
                            <tr>
                                <th scope="col">Old Url</th>
                                <th scope="col">New Url</th>
                                {{-- <th scope="col">Contact Source</th> --}}
                                {{-- <th scope="col">Is Redirect</th> --}}
                                <th scope="col">Redirection Code</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($redirectDatas->count() > 0)
                                @foreach ($redirectDatas as $t)
                                    <tr>
                                        <td>{{ $t->old_url }}</td>
                                        <td>{{ $t->new_url }}</td>
                                        {{-- <td>{{ $t->is_redirect == '1' ? 'Yes' : 'No' }}</td> --}}

                                        <td>{{ $t->method }}</td>

                                        <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d-m-Y h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($t->updated_at)->format('d-m-Y h:i A') }}</td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>

                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{-- {{ $catelogs->links() }} --}}
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

<style>
    .cusbtn {
        padding: 0.25rem 0.78rem;
    }
</style>

@extends('backend::layouts.master')

@section('content')
    <!-- Loader -->
    <div id="global-loader">
        <img src="/assets/backend/assets/img/loader.svg" class="loader-img" alt="Loader">
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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">SAC Codes</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payments</li>
                            <li class="breadcrumb-item active" aria-current="page">SAC Codes</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    {{-- <h4 class="card-title mg-b-0">Season</h4> --}}
                    <a class="btn btn-md btn-primary active" href="{{ route('payment.saccode.create') }}">Create</a>
                </div>
                <div class="table-responsive">
                    <div class="row">
                        {{-- @include('template_detail.twinkle.assesment._search') --}}
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="saccode">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">SAC Code</th>
                                <th scope="col">Code Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saccodes as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $model->sac_code }}</td>
                                    <td>{{ $model->description }}</td>

                                    <td><span
                                            class="btn btn-rounded {{ $model->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $model->status == 1 ? 'Active' : 'Suspended' }}</span>
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($model->created_at)->format('d-m-Y h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($model->updated_at)->format('d-m-Y h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('payment.saccode.edit', $model->id) }}"
                                            class="btn btn-sm btn-primary" style="margin-left:10px;"><i
                                                class="fa fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" style="float: left;margin-left:10px;"
                                            data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-id="50"
                                            onclick="$('#itemId').attr('action','{{ route('payment.saccode.destroy', ['saccode' => $model->id]) }}');$('#itemname').text('{{ $model->sac_code }}');"><i
                                                class="fa fa-trash"></i></button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">

                    {{ $saccodes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('backend::layouts.modal.del_custom_dialog')
@endsection

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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Billing Accounts</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Billing Accounts</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    {{-- <h4 class="card-title mg-b-0">Event Category</h4> --}}

                    <a class="btn btn-md btn-primary active" href="{{ route('payment.billingaccount.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    {{-- <div class="row">
                        @include('backend.event._search')
                    </div> --}}
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="event">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Company Logo</th>
                                <th scope="col">Company Name (Nickname)</th>
                                <th scope="col">Formation</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">GST Number</th>
                                <th scope="col">PAN Number</th>
                                <th scope="col">Contact Detail</th>
                                <th scope="col">Billing Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($billingaccounts->count() > 0)
                                @foreach ($billingaccounts as $billingaccount)
                                    <tr>
                                        <td scope="col"><img
                                                src="{{ asset('storage/' . $billingaccount->company_logo) }}" alt=""
                                                width="40px" height="40px"></td>
                                        <td scope="col">{{ $billingaccount->nick_name }}
                                        </td>
                                        <td scope="col">
                                            {{ \App\Helpers\Helper::formationType()[$billingaccount->formation_type] }} /
                                            {{ \Carbon\Carbon::parse($billingaccount->formation_date)->format('d-m-Y') }}
                                        </td>
                                        <td scope="col">
                                            {{ $billingaccount->company_name }}
                                        </td>
                                        <td scope="col">
                                            {{ $billingaccount->gst_number }}
                                        </td>
                                        <td scope="col">
                                            {{ $billingaccount->pan_number }}
                                        </td>
                                        <td scope="col">
                                            {{ $billingaccount->phone }} / {{ $billingaccount->email }}
                                        </td>
                                        <td scope="col">
                                            {{ $billingaccount->address }} <br> {{ $billingaccount->country_code }} /
                                            {{ $billingaccount->state_name }} / {{ $billingaccount->city_name }} /
                                            {{ $billingaccount->area }}
                                        </td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $billingaccount->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $billingaccount->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($billingaccount->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($billingaccount->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            <a href="{{ route('payment.billingaccount.edit', $billingaccount->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left;margin-left:10px;"
                                                data-bs-placement="top" title="Update"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" style="float: left;margin-left:10px;"
                                                data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-id="50"
                                                onclick="$('#itemId').attr('action','{{ route('payment.billingaccount.destroy', ['billingaccount' => $billingaccount->id]) }}');$('#itemname').text('{{ $billingaccount->nick_name }}');"><i
                                                    class="fa fa-trash"></i></button>
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
                    {{ $billingaccounts->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('backend::layouts.modal.del_custom_dialog')

@endsection

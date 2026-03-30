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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Institutes <span class="badge badge-danger">
                                {{ $institutes->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Institutes</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('backend::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('institute.create') }}">Create</a>
                    <a class="btn btn-md btn-primary active" href="{{ route('institute.bulk.index') }}">Bulk Upload</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('backend::institute._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Institute Details</th>
                                <th scope="col">Streams</th>
                                <th scope="col">Is Recommended </th>
                                <th scope="col">Package Name</th>
                                <th scope="col">Expiry</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($institutes)
                                @foreach ($institutes as $institute)
                                    <tr class="{{ $institute->currentstatus(true) == 0 ? 'text-danger' : '' }}">
                                        <td scope="col">
                                            {{ $institute->id }}
                                        </td>
                                        <td scope="col">
                                            @if (!empty($institute->latitude) && !empty($institute->longitude))
                                                <a href="https://maps.google.com?q={{ $institute->latitude }},{{ $institute->longitude }}"
                                                    target="_blank"><i
                                                        class="fa fa-map-marked"></i>&nbsp;{{ $institute->name }}</a>
                                            @else
                                                {{ $institute->name }}
                                            @endif
                                            <div>
                                                @if (!empty($institute->corporateoffice))
                                                    <a href="https://maps.google.com?q={{ $institute->corporateoffice->latitude }},{{ $institute->corporateoffice->longitude }}"
                                                        target="_blank">

                                                        {{ $institute->corporateoffice->area }},
                                                        {{ $institute->corporateoffice->city_name }},
                                                        {{ $institute->corporateoffice->state_name }}
                                                    </a>
                                                @endif

                                            </div>
                                            <div>
                                                {{ $institute->email }} / {{ $institute->mobile }}
                                            </div>
                                            <div>
                                                Package: {{ $institute->package->name }}
                                            </div>


                                        </td>
                                        <td>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                                data-bs-target="#institute_id_{{ $institute->id }}">
                                                View Streams
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="institute_id_{{ $institute->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Streams</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($institute->streams->count())
                                                                @foreach ($institute->streams as $streams)
                                                                    @php
                                                                        $institutestreams[$streams->category_id][] = $streams->stream->name;
                                                                    @endphp
                                                                @endforeach
                                                                @foreach ($institutestreams as $key => $stream)
                                                                    <div>
                                                                        <strong>
                                                                            {{ \App\Helpers\Helper::getCategory($key)->name }}
                                                                        </strong>
                                                                    </div>
                                                                    @foreach ($stream as $st)
                                                                        <span class="tag">
                                                                            {{ $st }}
                                                                        </span>
                                                                    @endforeach
                                                                @endforeach
                                                                @php
                                                                    unset($institutestreams);
                                                                @endphp
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                        <td>
                                            {{ $institute->is_recommended == 1 ? 'Yes' : 'No' }}
                                        </td>

                                        <td>
                                            {{ $institute->package->name }}
                                        </td>

                                        <td scope="col">

                                            <div>{{ \Carbon\Carbon::parse($institute->plan_valid_upto)->format('d-m-Y') }}
                                            </div>
                                            @if (\Carbon\Carbon::parse($institute->plan_valid_upto) >= \Carbon\Carbon::now())
                                                <div>
                                                    {{ \Carbon\Carbon::now()->diffInDays($institute->plan_valid_upto, false) }}
                                                    days left</div>
                                            @else
                                                <span class="text-danger">Expired</span>
                                            @endif
                                        </td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $institute->currentstatus(true) == 1 ? 'btn-success' : 'btn-danger' }}">{{ $institute->currentstatus() }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($institute->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($institute->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">

                                            @if ($institute->status)
                                                <button type="button" class="btn btn-sm btn-link renewInstitute"
                                                    style="float: left;margin-left:10px;" data-bs-toggle="modal"
                                                    data-bs-target="#renewModel"
                                                    data-package="{{ $institute->package_id }}"
                                                    data-name="{{ $institute->name }}"
                                                    data-action="{{ route('institute.packageupgrade', $institute->id) }}">
                                                    Renew</button>
                                            @endif

                                            @if ($institute->packagehistory()->count() > 1)
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-link historyInstitute"
                                                        style="float: left;margin-left:10px;" data-bs-toggle="modal"
                                                        data-bs-target="#HistoryModal" data-name="{{ $institute->name }}"
                                                        data-institute="{{ $institute->id }}">
                                                        History</button>

                                                </div>
                                            @endif
                                        </td>
                                        <td scope="col">
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-toggle="tooltip" title="Send Credentials"
                                                data-bs-target="#sendCredentialModal" style="float: left;"
                                                onclick="$('#vendorId').attr('value',{{ $institute->id }})"><i
                                                    class="fas fa-comment-dots"></i></a>

                                            <a href="{{ route('institute.edit', $institute->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left; margin-left:10px;"
                                                data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('institute.destroy', $institute->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    data-toggle="tooltip" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                            <a href="{{ route('instituteCheckout', $institute->id) }}"
                                                data-toggle="tooltip" title="Manage Institute"
                                                class="btn btn-sm btn-primary" style="float: left; margin-left:10px;"><i
                                                    class="fas fa-sign-in-alt"></i></a>

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
                    {{ $institutes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('backend::institute.modal.send_credential')

    <!--Renew Modal -->
    <div class="modal fade" id="renewModel" tabindex="-1" aria-labelledby="renewModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renewModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="renewForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <label for="package_id" class="form-label">Package</label>
                                <select name="package_id" id="package_id"
                                    class="form-select @error('package_id') is-invalid @enderror"
                                    aria-label="Default select example">
                                    <option value="">Select Package</option>
                                    @foreach ($packages as $package)
                                        @if ($package->id != $starterpackageId)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('package_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 my-2">
                                <label for="duration" class="form-label">Duration</label>
                                <select name="duration" id="duration"
                                    class="form-select @error('duration') is-invalid @enderror"
                                    aria-label="Default select example">
                                    <option value="">Select Duration</option>
                                    @foreach ($durationOption as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('duration')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <button class="btn btn-outline-success " type="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--History Modal -->
    <div class="modal fade" id="HistoryModal" tabindex="-1" aria-labelledby="HistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="HistoryModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Renew By</th>
                                <th scope="col">Renewal Date</th>
                                <th scope="col">Package</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Expiry</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(".renewInstitute").click(function() {
            $('#renewModelLabel').html($(this).attr('data-name'));
            $('#renewForm').attr('action', $(this).attr('data-action'));
            $('#renewForm #package_id option[value="' + $(this).attr('data-package') + '"]').prop('selected', true)
        });

        $(".historyInstitute").click(function() {
            var institute = $(this).attr('data-institute');
            var url = "{{ route('institute.packagehistory', ':id') }}";
            $('#HistoryModalLabel').html($(this).attr('data-name'));
            url = url.replace(':id', institute);
            $.ajax({
                type: "GET",
                url: url,
                // dataType: "json",
                success: function(response) {

                    $('#HistoryModal tbody').html("");
                    $('#HistoryModal tbody').html(response);
                    //     $.each(response.customers, function(key, item) {
                    //         $('tbody').append('<tr>\
                    //     <td>' + item.first_name + '</td>\
                    //     <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                    //     <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                    // \</tr>');
                    //     });
                }
            });
        });
    </script>
@endpush

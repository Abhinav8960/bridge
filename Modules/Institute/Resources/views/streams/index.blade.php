@extends('institute::layouts.master')
@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Streams <span class="badge badge-danger">
                                {{ $institutestreams->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Streams</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('institute::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    @can('create-stream')
                        <a class="btn btn-md btn-primary active" href="{{ route('institute.streams.create') }}">Create</a>
                    @endcan
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('institute::streams._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Stream</th>
                                <th scope="col">Exams</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($institutestreams)
                                @foreach ($institutestreams as $institutestream)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col">{{ $institutestream->category->name }}</td>
                                        <td scope="col">{{ $institutestream->stream->name }}</td>
                                        <td>
                                            @if ($institutestream->exams->count() > 0)
                                                @foreach ($institutestream->exams as $exam)
                                                    <span class="tag">
                                                        {{ $exam->exam->name }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $institutestream->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $institutestream->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($institutestream->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($institutestream->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{-- <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are You Sure to delete this?')"
                                                href="{{ route('popularcity.destroy', $city->id) }}"><i
                                                    class="fa fa-trash"></i></a> --}}
                                            {{-- <button type="button" style="float: left;margin-right:10px;"
                                                class="btn btn-sm btn-secondary" data-bs-custom-class="beautifier"
                                                data-bs-trigger="hover focus" data-bs-toggle="popover" tabindex="0"
                                                data-bs-placement="left" title="{{ $institutestream->profile }}">
                                                <i class="fa fa-eye"></i>
                                            </button> --}}
                                            <a href="{{ route('institute.streams.edit', $institutestream->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            {{-- <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('institute.streams.destroy', $institutestream->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form> --}}
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
                    {{ $institutestreams->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @livewireStyles
@endpush
@push('js')
    @livewireScripts
@endpush

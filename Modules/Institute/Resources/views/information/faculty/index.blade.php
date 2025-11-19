@extends('institute::layouts.master')
@livewireStyles
@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Faculty</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Information</li>
                            <li class="breadcrumb-item active" aria-current="page">Faculty</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('institute::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    <a class="btn btn-md btn-primary active" href="{{ route('information.faculty.create') }}">Create</a>
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('institute::information.faculty._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Faculty Image</th>
                                <th scope="col">Faculty Name</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Category / Exam Stream / Exam</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($faculty)
                                @foreach ($faculty as $fac)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col"><img src="{{ asset('storage/' . $fac->faculty_image) }}"
                                                alt="" width="40px" height="40px"></td>
                                        <td scope="col">{{ $fac->faculty_name }}</td>
                                        <td scope="col">{{ $fac->subject->ucFirstSubject() }}</td>
                                        <td scope="col">




                                            @if ($fac->facultyexams->count() > 0)
                                                @foreach ($fac->facultyexams as $facultyexam)
                                                    @php
                                                        $stream[$facultyexam->stream_id][] = $facultyexam;
                                                    @endphp
                                                @endforeach

                                                @foreach ($stream as $key => $facultyexam)
                                                    <div>
                                                        <strong> 
                                                            {{ \App\Helpers\Helper::fetchStreamByStreamId($key, true) }} >
                                                            {{ \App\Helpers\Helper::fetchStreamByStreamId($key) }}
                                                        </strong>
                                                    </div>
                                                    @foreach ($facultyexam as $exam)
                                                        <span class="tag">
                                                            {{ $exam->exam->name }}
                                                        </span>
                                                    @endforeach
                                                @endforeach
                                                @php
                                                    unset($stream);
                                                @endphp
                                            @endif


                                        </td>

                                        <td scope="col"><span
                                                class="btn btn-rounded {{ $fac->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $fac->status == 1 ? 'Active' : 'Suspended' }}</span>
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($fac->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($fac->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            <button type="button" style="float: left;margin-right:10px;"
                                                class="btn btn-sm btn-secondary" data-bs-custom-class="beautifier"
                                                data-bs-trigger="hover focus" data-bs-toggle="popover" tabindex="0"
                                                data-bs-placement="left" title="{{ $fac->description }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="{{ route('information.faculty.edit', $fac->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('information.faculty.destroy', $fac->id) }}">
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
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    {{ $faculty->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
@section('script')
    {{-- <script>
    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2("val");
            @this.set('selectExam', data);
        });
    });
</script> --}}
@endsection

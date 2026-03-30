@extends('institute::layouts.master')
@livewireStyles
@section('content')
    <div class="main-content app-content">
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="col-xl-12">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Courses <span class="badge badge-danger">
                                {{ $courses->total() }} </span></span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Information</li>
                            <li class="breadcrumb-item active" aria-current="page">Courses</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /breadcrumb -->

            <div class="col-xl-12">
                @include('institute::layouts.flash-message')
                <div class="d-flex justify-content-between pb-3">
                    @can('create-course')
                        <a class="btn btn-md btn-primary active" href="{{ route('information.course.create') }}">Create</a>
                    @endcan
                </div>

                <div class="table-responsive">
                    <div class="row">
                        @include('institute::information.course._search')
                    </div>
                    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Course Title</th>
                                <th scope="col">Category / Exam Stream / Exam</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Batch Size</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($courses)
                                @foreach ($courses as $course)
                                    <tr>
                                        {{-- <td scope="col">{{ $loop->iteration }}</td> --}}
                                        <td scope="col"><strong>{{ $course->course_title }}</strong>
                                            <div> Enrollment: {{  ($course->accept_enrollment == 1) ? "Yes":"No" }}</div>
                                            </td>
                                            <td>
                                                @if ($course->exams->count() > 0)
                                                @foreach ($course->exams as $coursesexam)
                                                    @php
                                                        $stream[$coursesexam->stream_id][] = $coursesexam;
                                                    @endphp
                                                @endforeach

                                                @foreach ($stream as $key => $coursesexam)
                                                    <div>
                                                        <strong>
                                                            {{ \App\Helpers\Helper::fetchStreamByStreamId($key, true) }} >
                                                            {{ \App\Helpers\Helper::fetchStreamByStreamId($key) }}
                                                        </strong>
                                                    </div>
                                                    @foreach ($coursesexam as $exam)
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

                                        <td scope="col">
                                            {{ $course->duration }} {{ $course->duration <= 1 ? 'Month' : 'Months' }}
                                            ({{ date('d-m-Y', strtotime($course->start_date)) }} to {{ date('d-m-Y', strtotime($course->end_date)) }})
                                        </td>
                                        <td scope="col">{{ $course->batch_size }}</td>
                                        <td scope="col"><span
                                            class="btn btn-rounded {{ $course->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $course->status == 1 ? 'Active' : 'Suspended' }}</span>
                                    </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($course->created_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">
                                            {{ \Carbon\Carbon::parse($course->updated_at)->format('d-m-Y h:i A') }}
                                        </td>
                                        <td scope="col">


                                            <a href="{{ route('information.course.edit', $course->id) }}"
                                                class="btn btn-sm btn-primary" style="float: left"><i
                                                    class="fa fa-edit"></i></a>
                                            <form style="float: left;margin-left:10px;" method="post"
                                                action="{{ route('information.course.destroy', $course->id) }}">
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
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection
@section('script')
@endsection

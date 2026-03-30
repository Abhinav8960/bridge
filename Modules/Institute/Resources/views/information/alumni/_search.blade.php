<form class="align-items-center">
    <div class="row">
        <div class="col-md-4">
            @include('institute::includes._pagesize')
        </div>
        <div class="col-md-8">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Search by name/designation/company/year" name="name"
                        value="{{ $request['name'] ? $request['name'] : '' }}"
                        onblur="setTimeout(this.form.submit(), 3000)">
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="exam_category_id" class="form-label">Category </label>
                    <select name="category" id="exam_category_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Category</option>
                        @foreach (\App\Helpers\Helper::fetchCategory() as $categ)
                            <option value="{{ $categ->id }}"
                                {{ !empty(request()->category) && request()->category == $categ->id ? 'selected' : '' }}>
                                {{ $categ->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="exam_stream_id" class="form-label">Stream</label>
                    <select name="stream" id="exam_stream_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Stream</option>
                        @foreach (\App\Helpers\Helper::fetchInstituteStream(request()->category,session()->get('institute.id')) as $stream)
                            <option value="{{ $stream->stream_id }}"
                                {{ !empty(request()->stream) && request()->stream == $stream->stream_id ? 'selected' : '' }}>
                                {{ $stream->stream->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="exam_id" class="form-label">Exam</label>
                    <select name="exam" id="exam_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select Exam</option>
                        @foreach (\App\Helpers\Helper::fetchInstituteExam(request()->stream,session()->get('institute.id')) as $exam)
                            <option value="{{ $exam->exam_id }}"
                                {{ !empty(request()->exam) && request()->exam == $exam->exam_id ? 'selected' : '' }}>
                                {{ $exam->exam->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<div>
    <div class="col-lg-12 col-md-12">
        <div class="card shadow-1">
            {{-- <div class="card-header">
                <h3 class="card-title">Exam</h3>
            </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 my-2">
                        <label for="category_id" class="form-label">Exam Category</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('categoryId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="categoryId"
                            @if (!empty($model->id)) disabled @endif>
                            <option value="">Select Category</option>
                            @foreach ($categoryOptions as $key => $categ)
                                <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 my-2">
                        {{-- @dd($streamOptions); --}}
                        <label for="stream_id" class="form-label">Exam Stream</label>
                        <select name="stream_id" id="stream_id"
                            class="form-select @error('streamId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="streamId"
                            @if (!empty($model->id)) disabled @endif>
                            <option value="">Select Stream</option>
                            @foreach ($streamOptions as $key => $stream)
                                <option value="{{ $stream->id }}">{{ $stream->name }}</option>
                            @endforeach
                        </select>
                        @error('streamId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('stream_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="exam" class="form-label">Exam</label>

                        @foreach ($selectedExams as $selectedExam)
                            <input type="hidden" name="exam[]" value="{{ $selectedExam }}">
                        @endforeach
                        <select id="exam"
                            class="form-control select2 class_SelectMultiple  @error('exam') is-invalid @enderror"
                            aria-label="Default select example" wire:model="exam" multiple>

                            @foreach ($examOptions as $key => $option)
                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                        @if (!empty($examOptions))
                            <input type="checkbox" id="checkAll" class="form-controll mt-1"
                                aria-label="Checkbox for following text input"> &nbsp; Select All
                        @endif


                        @error('exam')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">

                        <label for="AddExams" class="form-label">&nbsp;</label>

                        <button type="button" class="btn btn-block btn-outline-primary" id="AddExams"
                            wire:click="addSelectedExam()">Add Exams</button>

                    </div>

                    @if (count($selectedExams) > 0)
                        <div class="col-12">
                            <div class="card custom-card shadow-1 mt-3">

                                <div class="card-body">



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tags">
                                                @foreach ($selectedExams as $key => $exam)
                                                    <span
                                                        class="tag">{{ \App\Helpers\Helper::examByExamId($exam)->name }}
                                                        <div wire:click="removeSelectedExam({{ $exam }})"
                                                            class="tag-addon"><i class="fe fe-x"></i></div>
                                                    </span>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                    @if (!empty($model->id))
                        <div class="col-md-12 my-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example" @if ($isExceedAllowedStreams == true) disabled @endif>
                                <option value="">Select Status</option>
                                <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>
                                    Suspended
                                </option>
                                <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>
                                    Active
                                </option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @if ($isExceedAllowedStreams == true)
                                <div class="text-muted">You can't changes status. You need to suspend any other stream
                                    first then only you mark this as Active</div>
                            @endif
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <button class="btn btn-outline-success submit-button"
                                @if ($isValidatedForm) type="submit" @else type="button" wire:click="submitForm()" @endif>Submit</button>
                        </div>
                    </div>
                    @if ($isValidatedForm)
                        <script>
                            $('.submit-button').click();
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <!-- INTERNAL Select2 js -->

        @livewireScripts()
        <script>
            document.addEventListener('livewire:load', function(event) {

                Livewire.hook('message.processed', () => {

                    $('.select2').select2();

                    $("#checkAll").click(function() {
                        if ($("#checkAll").is(':checked')) {
                            $("#exam > option").prop("selected", "selected");
                            $("#exam").trigger("change");
                        } else {
                            $("#exam > option").removeAttr("selected");
                            $("#exam").trigger("change");
                        }
                    });

                });

            });



            $('.select2').select2();
            $('.select2[multiple]').siblings('.select2-container').append('<span class="select-all"></span>');


            $('#exam').on('change', function(e) {
                Livewire.emit('examListen', $('#exam').val())
            });



           
        </script>
    @endsection
</div>

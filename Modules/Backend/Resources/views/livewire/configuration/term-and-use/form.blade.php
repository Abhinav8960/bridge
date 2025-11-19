<div>
    <div class="row">
        <div class="col-md-12">
            @include('backend::layouts.flash-message')
        </div>
    </div>
    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-md-6 my-2">
                        <label for="module_sequence" class="form-label">Module Sequence</label>
                        <input name="module_sequence" type="text"
                            class="form-control @error('moduleSequence') is-invalid @enderror" id="moduleSequence"
                            wire:model="moduleSequence">
                        @error('moduleSequence')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('module_sequence')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-6 my-2">
                        <label for="module_title" class="form-label">Module Title</label>
                        <input name="module_title" type="text"
                            class="form-control @error('moduleTitle') is-invalid @enderror" id="moduleTitle"
                            wire:model="moduleTitle">
                        @error('moduleTitle')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('module_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2" wire:ignore>
                        <label for="module_description" class="form-label">Module Description </label>
                        <textarea name="module_description" id="moduleDescription" cols="30" rows="3"
                            class="form-control ckeditor5 @error('moduleDescription') is-invalid @enderror">{{ old('moduleDescription', $moduleDescription) }}</textarea>
                        @error('moduleDescription')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('module_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <button class="btn btn-outline-success submit-button" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend::layouts.ckeditor5',['editorIds' => ['moduleDescription']])


</div>

{{-- @push('js')
    <script type="text/javascript">
        document.addEventListener('livewire:load', function() {
            $('#moduleDescription').summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('moduleDescription', contents);
                    }
                }
            });
        });
    </script>
@endpush

@push('css')
    <style>
        .note-btn-group.note-insert .note-btn:nth-child(2),
        .note-btn-group.note-insert .note-btn:nth-child(3) {
            display: none;
        }
    </style>
@endpush --}}

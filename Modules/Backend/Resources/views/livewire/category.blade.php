<div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 my-2">
                        <label for="name" class="form-label">Category Name
                        </label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name', $name) }}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 my-5" style="margin-left:-34px;">
                        <label for="is_category_color" class="form-label custom-switch">
                            <span class="custom-switch-description tx-14">Color Coded Categories
                            </span>
                            <input type="checkbox" name="is_category_color"
                                class="custom-switch-input form-control @error('is_category_color') is-invalid @enderror"
                                id="is_category_color" {{ $is_category_color == true ? 'checked' : '' }}
                                wire:model="is_category_color">
                            <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                        </label>
                        @error('is_category_color')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($is_category_color)
                        <div class="col-md-3 my-2">
                            <label for="category_color" class="form-label">Category Color</label>
                            <input name="category_color" type="color"
                                class="form-control @error('category_color') is-invalid @enderror" id="category_color"
                                value="{{ old('category_color', $category_color) }}" wire:model="category_color">
                            @error('category_color')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="col-md-6 my-2">
                        <label for="parent_id" class="form-label">Parent Directory </label>
                        <select name="parent_id" id="parent_id"
                            class="form-select @error('parent_id') is-invalid @enderror"
                            aria-label="Default select example" wire:model="parent_id">
                            <option value="">Select Category</option>
                            @foreach ($category as $cat)
                                @if (old('parent_id', !empty($parent_id) ? $parent_id : ''))
                                    <option value="{{ isset($cat->id) ? $cat->id : $cat['id'] }}">
                                        {{ isset($cat->name) ? $cat->name : $cat['name'] }}</option>
                                @else
                                    <option value="{{ isset($cat->id) ? $cat->id : $cat['id'] }}">
                                        {{ isset($cat->name) ? $cat->name : $cat['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!empty($model->id))
                        <div class="col-md-6 my-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example">
                                <option value="">Select Status</option>
                                <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>
                                    Suspended
                                </option>
                                <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>
                                    Published
                                </option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="col-md-12 my-2" wire:ignore>
                        <label for="description" class="form-label">Description (Max 75 Word) (Optional)</label>
                        <textarea name="description" id="description" cols="30" rows="2"
                            class="form-control ckeditor5 @error('description') is-invalid @enderror">{{ old('description', $description) }}

                        </textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

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
    {{-- @include('backend::layouts.ckeditor5',['setterId'=>'description']) --}}
    @include('backend::layouts.ckeditor5',['editorIds' => ['description']])


</div>


{{-- @push('js')
    <script type="text/javascript">
        document.addEventListener('livewire:load', function() {
            $('#description').summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description', contents);
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

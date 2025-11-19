<div>
    <div class="row">
        
    </div>
    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif --}}
    <form method="POST" enctype="multipart/form-data" wire:submit.prevent="save">
        @csrf
        @method('POST')
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-1">
                <div class="card-header">
                    <h3 class="card-title">Blog Setting</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="is_category_color" class="form-label custom-switch">
                                <span class="custom-switch-description tx-14">Color Coded Categories 
                                </span>
                                <input type="checkbox" name="is_category_color"
                                    class="custom-switch-input form-control @error('is_category_color') is-invalid @enderror"
                                    id="is_category_color" {{ $is_category_color == true ? 'checked' : '' }} wire:model="is_category_color">
                                <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                            </label>
                            @error('is_category_color')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($is_category_color)
                            <div class="col-md-4 my-2">
                                <label for="category_color" class="form-label">Category Color</label>
                                <input name="category_color" type="color"
                                    class="form-control @error('category_color') is-invalid @enderror" id="category_color"
                                    value="{{ old('category_color', $category_color) }}" wire:model="category_color">
                                @error('category_color')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                            <div class="col-md-4 my-2">
                                <label for="is_commentable" class="form-label custom-switch">
                                    <span class="custom-switch-description tx-14">Enable Comments 
                                    </span>
                                    <input type="checkbox" name="is_commentable"
                                        class="custom-switch-input form-control @error('is_commentable') is-invalid @enderror"
                                        id="is_commentable" {{ $is_commentable == true ? 'checked' : '' }} wire:model="is_commentable">
                                    <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                                </label>
                                @error('is_commentable')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <label for="is_comment_moderation" class="form-label custom-switch">
                                    <span class="custom-switch-description tx-14">Comments Moderation 
                                    </span>
                                    <input type="checkbox" name="is_comment_moderation"
                                        class="custom-switch-input form-control @error('is_comment_moderation') is-invalid @enderror"
                                        id="is_comment_moderation" {{ $is_comment_moderation == true ? 'checked' : '' }} wire:model="is_comment_moderation">
                                    <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                                </label>
                                @error('is_comment_moderation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12 my-2">
                    <button class="btn btn-outline-success " type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<style>
    .custom-switch {
        padding-left: 0px !important;
    }
</style>
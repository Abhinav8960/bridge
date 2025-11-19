
<div>
    {{-- @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif --}}
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comment</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 my-2">
                        <label for="comment_by" class="form-label">Comment By</label>
                        <input name="comment_by" type="text" class="form-control @error('comment_by') is-invalid @enderror"
                            id="comment_by" value="{{ old('comment_by', $comment_by) }}" wire:model="comment_by">
                        @error('comment_by')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="blog_post" class="form-label">Blog Post</label>
                        <input name="blog_post" type="text" class="form-control @error('blog_post') is-invalid @enderror"
                            id="blog_post" value="{{ old('blog_post', $blog_post) }}" wire:model="blog_post">
                        @error('blog_post')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-12 my-2">
                        <label for="comment" class="form-label">  Comment (Max 75 Word)</label>
                        <textarea name="comment" id="comment" cols="30" rows="2"
                            class="form-control @error('comment') is-invalid @enderror" id="comment" wire:model="comment">{{ old('comment', $comment) }}</textarea>
                        @error('comment')
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
</div>

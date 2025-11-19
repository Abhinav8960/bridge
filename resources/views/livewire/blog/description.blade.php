<div>
    <div class="row">
        <div class="col-12">
            <div class="blog-heading">
                <h1>{{ $description->title }}</h1>
                <h2 class="sub-title">{{ $description->sub_title }}</h2>
            </div>
        </div>
    </div>
    <div class="blog-slider pt-5">
        @if (empty($description->images))
            <div class="blog-slide">
                <div class="blog-slide-img">
                    @if (!empty($description->image))
                        <img src="{{ Storage::url($description->image) }}" alt="{{$description->featured_alt}}">
                    @else
                        <img src="/assets/img/blog/slider-img-1.jpg" alt="">
                    @endif
                    <span> <i class="bi bi-tag"></i>
                        {{ $categoryname->name }}</span>
                </div>
            </div>
        @endif
        @foreach ($description->images as $gallery)
            <div class="blog-slide">
                <div class="blog-slide-img">
                    @if (Storage::disk('public')->exists($gallery->image) && !empty($gallery->image))
                        <img src="{{ Storage::url($gallery->image) }}" alt="{{$gallery->gallery_alt}}">
                    @endif
                    <span> <i class="bi bi-tag"></i>
                        {{ $categoryname->name }}</span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="blog-details">
        <div class="d-lg-flex  justify-content-between align-items-center pb-4">
            <div>
                <div class="blog-author">
                    <span>
                        by <b> {{ $description->author }} @if (empty($description->author))
                                {{ $description->user ? $description->user->name : '' }}
                            @endif
                        </b>
                    </span>
                    <span class="v-line"></span>
                    <span>{{ \Carbon\Carbon::parse($description->published_date_time)->format('d M Y, h:i A') }}</span>
                </div>

            </div>

            <div class="blog-item-footer">
                <div class="d-flex gap-3">
                    <img src="assets/img/share.png" alt="" class="social-img">
                    @if ($description->is_approved == App\Models\Backend\Blog::COMMENTNOTALLOWED)
                        <a href="#section-comment">
                            Comment(s) <span>{{ count($blogComment) }}</span> </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="blog-details-text pt-4">
            <p>{!! $description->description !!}</p>
        </div>
        <div class="blog-comment" id="section-comment">
            <div class="blog-comment-container">
                @if ($description->is_approved == App\Models\Backend\Blog::COMMENTNOTALLOWED)
                    <h3>{{ count($blogComment) }} Comment(s)</h3>
                @endif
                @foreach ($blogComment as $comment)
                    <div class="blog-comment-text">
                        <span class="comment-author"><a href="">{{ $comment->student->name ?? '' }}</a> </span>
                        <span class="comment-date"><a
                                href="">{{ \Carbon\Carbon::parse($description->published_date_time)->format('d M Y, h:i A') }}
                            </a></span>
                        <div class="comment-text">
                            <p>{{ $comment->comment }}</p>
                        </div>
                        <div class="comment-reply">
                            <a href=""><i class="bi bi-pencil"></i>Reply</a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($description->is_comment == App\Models\Backend\Blog::COMMENTALLOWED)
                <div class="comment-form">
                    @include('backend::layouts.flash-message')

                    <h3>Leave a Comment</h3>
                    <form enctype="multipart/form-data" wire:submit.prevent="submit">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="5" placeholder="Message" wire:model="comment" required></textarea>
                        </div>
                        <div class="btn-wrapper">
                            <button type="submit" class="btn yellow-btn ">Submit</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

</div>

<style>
    .blog-details-text ul li {
        list-style-type: disc;
        color: #000
    }
    .blog-details-text ol li {
        list-style-type: inherit;
        color: #000
    }
</style>

<style>
    .blog-details h3 {
        font-size: 24px;
        /* color: #004b84; */
    }
</style>

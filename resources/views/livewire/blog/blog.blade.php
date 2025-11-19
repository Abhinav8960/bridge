<div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex gap-5 justify-content-between">
                <div class="blog-heading">
                    <h1>Blog <span>{{ count($blogs) }}</span></h1>
                </div>
                <div class="blog-search w-50">
                    <form action="">
                        <div>
                            <input type="text" wire:model="search" class="form-control" placeholder="Search here..">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-5 gap-40">
        @foreach ($blogs as $blog)
            <div class="col-md-6">
                <div class="blog-item">
                    @if (!empty($blog->tag()))
                        <span class="blog-popover">{{ $blog->tag() }}</span>
                    @endif
                    <div class="blog-img">
                        <a href="{{ route('blog.detail', $blog->post_slug) }}">
                            @if (!empty($blog->image))
                                <img src="{{ Storage::url($blog->image) }}" alt="{{$blog->featured_alt}}">
                            @else
                                <img src="assets/img/blog/img-1.jpg" alt="profile-img">
                            @endif
                        </a>
                    </div>
                    <div class="blog-content pTagColor">
                        <a href="{{ route('blog.detail', $blog->post_slug) }}">
                            <h2>{{ $blog->title }}</h2>
                        </a>
                        <div class="blog-author">
                            <span>
                                by <a href="">{{ $blog->author }} @if (empty($blog->author))
                                        {{ $blog->user ? $blog->user->name : '' }}
                                    @endif
                                </a>
                            </span>
                            <span class="v-line"></span>
                            <a href="">{{ \Carbon\Carbon::parse($blog->published_date_time)->format('d M Y, h:i A') }}</a>
                        </div>
                        @if (!empty($blog->description))
                            <p>{!! strlen(strip_tags($blog->description)) > 260 ? substr(strip_tags($blog->description), 0, 260) . '...' : $blog->description !!}
                            </p>
                        @endif
                    </div>
                    <div class="blog-item-footer">
                        <div class="d-flex align-items-center justify-content-between">
                            @if ($blog->activecategory == null)
                            @else
                                @php
                                    $title = '';
                                @endphp
                                @foreach ($blog->activecategories as $cat)
                                    @php
                                        $title .= $cat->categoryBlog->name . ',';
                                    @endphp
                                @endforeach
                                <a style="color:{{ $blog->activecategory->categoryBlog->category_color }}"
                                    href="{{ route('blog.category', $blog->activecategory->categoryBlog->name) }}"> <i
                                        class="bi bi-tag "></i>
                                    {{ $blog->activecategory->categoryBlog->name ?? '' }} @if ($blog->activecategories->count() - 1 > 0)
                                        <span
                                            title="
                                        {{ substr($title, 0, -1) }}">
                                            +{{ $blog->activecategories->count() - 1 }} </span>
                                    @endif
                                </a>
                            @endif

                            <a href="{{ route('blog.detail', $blog->post_slug) }} #section-comment"> <i
                                    class="bi bi-chat-left-text"></i>
                                {{ count($blog->comments) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-section">
        <nav aria-label="Page navigation example">
            {{ $blogs->links() }}

        </nav>
    </div>
    <style>
        .text-editors h3 strong,
        .text-editors h3 {
            font-size: 25px;
            font-weight: 400;
            color: #5f3813;
        }

        .pTagColor p {
            color: black !important;
        }
    </style>
</div>

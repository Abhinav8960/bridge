<div>
    <div class="categories">
        <h4>Categories</h4>
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{ route('blog.category', $category->name) }}"
                        style="color:{{ $category->category_color }}">{{ $category->name }}</a><span>{{ $category->blog_categories_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="archives categories">
        @if ($blogPosts->count() > 0)
            <h4>Archives</h4>
        @endif
        <ul>
            @foreach ($blogPosts as $post)
                <li><a href="{{ route('blog.archives', ['month' => $post->month, 'year' => $post->year]) }}">{{ \Carbon\Carbon::createFromDate($post->year, $post->month, 1)->monthName }}
                        {{ $post->year }}</a><span>{{ $post->count }}</span></li>
            @endforeach

        </ul>

    </div>
    <div class="recent-blog">
        @if ($blogs->count() > 0)
            <h4>Similar Posts</h4>
        @endif
        @foreach ($blogs as $blog)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-4 pe-0">
                        @if (!empty($blog->image))
                            <img src="{{ Storage::url($blog->image) }}" class="card-img w-100 h-100" alt="{{$blog->featured_alt}}">
                        @else
                            <img src="assets/img/blog/img-1.jpg" class="card-img w-100 h-100" alt="...">
                        @endif
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <div class="card-top">
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
                                    <span style="color:{{ $blog->activecategory->categoryBlog->category_color }}"
                                        href=""> <i class="bi bi-tag "></i>
                                        {{ $blog->activecategory->categoryBlog->name ?? '' }} </span>
                                @endif

                                    <span class="text-blue" href=""><i class="bi bi-calendar"></i>
                                        {{ \Carbon\Carbon::parse($blog->published_date_time)->format('M m , Y') }}</span>

                            </div>
                            <a href="{{ route('blog.detail', $blog->post_slug) }}">
                                <h5 class="card-title">{{ $blog->title }} </h5>
                            </a>
                            <p class="card-text"><small class="text-muted">by {{ $blog->author }} @if (empty($blog->author))
                                        {{ $blog->user ? $blog->user->name : '' }} @endif </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

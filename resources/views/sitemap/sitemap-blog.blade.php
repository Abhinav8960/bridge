<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
    <url>
        <loc>{{ env('APP_URL') }}/blog</loc>
    </url>
    @foreach ($categories as $category)
        <url>
            <loc>{{ env('APP_URL') }}/blog/category/{{ $category->name }}</loc>
        </url>
    @endforeach
    @foreach ($blogs as $blog)
        <url>
            <loc>{{ env('APP_URL') }}/blog/{{ $blog->post_slug }}</loc>
        </url>
    @endforeach

    @foreach ($archives as $archive)
        <url>
            <loc>{{ env('APP_URL') }}/blog/archives/{{ $archive->month }}/{{ $archive->year }}</loc>
        </url>
    @endforeach


</urlset>

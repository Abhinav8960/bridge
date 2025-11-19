<?php

namespace Modules\Backend\Http\Controllers;

use App\Http\Controllers\Modules\Backend\BlogController as BackendBlogController;
use App\Models\Backend\{Blog, BlogCategory, BlogComment, BlogGalleryImage, Category};
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session as FacadesSession;
use Modules\Backend\Http\Requests\BlogStoreRequest;
use Modules\Backend\Http\Requests\BlogUpdateRequest;


class BlogController extends BaseController
{
    private $image_dir = 'images/blog';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $blogs = Blog::filter($request->all())->with('user')->orderBy('id', 'DESC')->get();
        $category = Category::where('status', true)->get();

        return view('backend::blog.index', compact('blogs', 'request', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Blog();
        $category = Category::where('status', true)->get();
        return view('backend::blog.create', compact(['model', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogStoreRequest $request)
    {

        $blog = new Blog();
        $blog->title = !empty($request->title) ? $request->title : NULL;
        $blog->author = !empty($request->author) ? $request->author : NULL;
        $blog->sub_title = !empty($request->sub_title) ? $request->sub_title : NULL;
        $blog->featured_alt = !empty($request->featured_alt) ? $request->featured_alt : NULL;
        $blog->is_comment = !empty($request->is_comment) ? $request->is_comment : 0;
        $blog->is_approved = !empty($request->is_approved) ? $request->is_approved : 0;
        // dd($blog->is_approved);
        $blog->description = !empty($request->description) ? $request->description : NULL;
        $blog->meta_description = !empty($request->meta_description) ? $request->meta_description : NULL;
        $blog->meta_title = !empty($request->meta_title) ? $request->meta_title : NULL;
        $blog->meta_keywords = !empty($request->meta_keywords) ? $request->meta_keywords : NULL;
        $blog->schedule = ($request->schedule == 'on') ? true : false;
        if ($request->schedule == 'on') {
            // $blog->status = 2;
            $blog->published_date_time = !empty($request->published_date_time) ? $request->published_date_time : NULL;
        } else {
            // $blog->status = 1;
            $blog->published_date_time =  Carbon::now()->format('Y-m-d H:i');
        }
        // $blog->post_slug = !empty($request->post_slug) ? $request->post_slug : NULL;
        $slug = !empty($request->post_slug) ? $request->post_slug : NULL;
        $slug1 = strtolower($slug);
        $slug2 = preg_replace('/[^a-z0-9]+/', '-', $slug1);
        $slug_data = trim($slug2, '-');
        // dd($string);
        $blog->post_slug = !empty($slug_data) ? $slug_data : NULL;

        if (!empty($request->file('image'))) {
            $filename = 'blog_' . date('dmyHis') . '.' . $request->image->getClientOriginalExtension();
            $blog->image =  $this->fileupload($this->image_dir, $request->image, $filename);
        }

        if ($blog->save()) {
            $this->BlogCategory($blog, $request);
            if (!empty($request->file('images'))) {

                $i = 0;
                foreach ($request->file('images') as $image) {
                    $filename = 'blog-gallery-image_' . \Carbon\Carbon::now()->addSeconds($i)->format('dmyHis') . '.' . $image->getClientOriginalExtension();

                    $image_path =  $this->fileupload($this->image_dir . '/gallery-image', $image, $filename);

                    // dd($image_path,$request->alt_texts[$i] ?? '');
                    BlogGalleryImage::create(['blog_id' => $blog->id, 'image' => $image_path, 'gallery_alt' => $request->gallery_alt[$i] ?? '']);
                    $i++;
                }
            }


            return redirect()->route('blog.index')->with('success', 'Blog Added successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
        // return redirect()->route('blog.index')->with('success', 'Blog added successfully.');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $blog = Blog::where('id', $id)->first();
        $comments = BlogComment::filter($request->all())->where('blog_id', $id)->where('is_approved', 1)->orderBy('id', 'DESC')->get();
        return view('backend::comment.index', compact('comments', 'request', 'blog'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $model = Blog::findOrFail($id);
        return view('backend::blog.edit', compact(['model']));

        //    $model = Blog::findOrFail($id);
        //    //dd($model);
        //    return view('backend::blog.edit', compact(['model']));
        //return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        // dd ($request);

        $blog = Blog::findOrFail($id);
        $blog->title = !empty($request->title) ? $request->title : NULL;
        $blog->author = !empty($request->author) ? $request->author : NULL;
        $blog->sub_title = !empty($request->sub_title) ? $request->sub_title : NULL;
        $blog->featured_alt = !empty($request->featured_alt) ? $request->featured_alt : NULL;
        // $blog->post_slug = !empty($request->post_slug) ? $request->post_slug : NULL;
        $slug = !empty($request->post_slug) ? $request->post_slug : NULL;
        $slug1 = strtolower($slug);
        $slug2 = preg_replace('/[^a-z0-9]+/', '-', $slug1);
        $slug_data = trim($slug2, '-');
        // dd($string);
        $blog->post_slug = !empty($slug_data) ? $slug_data : NULL;
        $blog->is_comment = !empty($request->is_comment) ? $request->is_comment : NULL;
        $blog->is_approved = !empty($request->is_approved) ? $request->is_approved : NULL;
        $blog->description = !empty($request->description) ? $request->description : NULL;
        $blog->meta_description = !empty($request->meta_description) ? $request->meta_description : NULL;
        $blog->meta_title = !empty($request->meta_title) ? $request->meta_title : NULL;
        $blog->meta_keywords = !empty($request->meta_keywords) ? $request->meta_keywords : NULL;
        $blog->schedule = ($request->schedule == 'on') ? true : false;

        if ($request->schedule == 'on') {
            // $blog->status = 2;
            $blog->published_date_time = !empty($request->published_date_time) ? $request->published_date_time : NULL;
        } else {
            // $blog->status = $request->status;
            $blog->published_date_time =  Carbon::now()->format('Y-m-d H:i');
        }
        // $blog->post_slug = !empty($request->post_slug) ? $request->post_slug : NULL;
        $blog->status = !empty($request->status) ? $request->status : 0;
        if (!empty($request->file('image'))) {
            $filename = 'blog_' . date('dmyHis') . '.' . $request->image->getClientOriginalExtension();
            $blog->image =  $this->fileupload($this->image_dir . '/blog', $request->image, $filename);
        }
        if ($blog->save()) {
            $this->BlogCategory($blog, $request);

            if (!empty($request->file('images'))) {
                $i = 0;
                foreach ($request->file('images') as $image) {
                    $filename = 'blog-gallery-image_' . \Carbon\Carbon::now()->addSeconds($i)->format('dmyHis') . '.' . $image->getClientOriginalExtension();

                    $image_path =  $this->fileupload($this->image_dir . '/gallery-image', $image, $filename);
                    // dump($request->alt_texts[$i] ?? '');

                    BlogGalleryImage::create(['blog_id' => $blog->id, 'image' => $image_path, 'gallery_alt' => $request->gallery_alt[$i] ?? '']);
                    $i++;
                }
            }

            return redirect()->route('blog.index')->with('success', 'Blog Updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blog.index', compact('blog'));
    }

    private function  BlogCategory($blog, $request)
    {

        $catdel = BlogCategory::where('blog_id', $blog->id)->delete();
        if ($request->category_id) {
            foreach ($request->category_id as $category) {

                $cat = new BlogCategory();

                $cat->blog_id = $blog->id;
                $cat->category_id = $category;
                $cat->save();
            }
        }
        // exit;
    }

    public function Setting($id)
    {

        $blog = Blog::findOrFail($id);
        return view('backend::blog.setting', compact('blog'));
    }

    public function updateBlogSetting(Request $request)
    {
        // dd ($request);

        $blog = Blog::findOrFail($request->id);
        //$blog = Blog::findOrFail($id);

        $blog->is_category_color =   $request->is_category_color;

        if ($request->is_category_color == 1) {
            $blog->category_color =   $request->category_color;
        } else {
            $blog->category_color =   '';
        }
        $blog->is_commentable            =   $request->is_commentable;
        $blog->is_comment_moderation     =   $request->is_comment_moderation;

        if ($blog->save()) {
            return redirect()->route('blog.index')->with('success', 'Blog Setting Updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }
    public function publish($id)
    {
        $model = Blog::find($id);
        if ($model->status == true) {
            $model->status = false;
        } else {
            $model->status = true;
        }
        $model->update();
        // flash('Updated Successfully')->success();
        return redirect()->back();
    }
}

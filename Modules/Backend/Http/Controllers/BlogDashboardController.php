<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\Backend\Blog;
use App\Models\Backend\BlogComment;
use App\Models\Backend\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class BlogDashboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $publishedBlog = Blog::where('status',1)->get();
        $publishedBeforeWeekBlog = Blog::where('status',1)->whereDate('created_at','>=',$date)->get();

        $suspendedBlog = Blog::where('status',3)->get();
        $suspendedBeforeWeekBlog = Blog::where('status',3)->whereDate('created_at','>=',$date)->get();

        $schuldedBlog = Blog::where('status',2)->get();
        $schuldedBeforeWeekBlog = Blog::where('status',2)->whereDate('created_at','>=',$date)->get();

        $activeCategories = Category::where('status',true)->get();
        $activeBeforeWeekCategory = Category::where('status',true)->whereDate('created_at','>=',$date)->get();

        $suspendCategories = Category::where('status',false)->get();
        $suspendBeforeWeekCategory = Category::where('status',false)->whereDate('created_at','>=',$date)->get();


        $publishedcomment = BlogComment::where('is_approved',BlogComment::APPROVED)->get();
        $publishedBeforeWeekComment = BlogComment::where('is_approved',BlogComment::APPROVED)->whereDate('created_at','>=',$date)->get();


        $rejectcomment = BlogComment::where('is_approved',BlogComment::REJECT)->get();
        $rejectBeforeWeekComment = BlogComment::where('is_approved',BlogComment::REJECT)->whereDate('created_at','>=',$date)->get();

        $holdcomment = BlogComment::where('is_approved',BlogComment::HOLD)->get();
        $holdBeforeWeekComment = BlogComment::where('is_approved',BlogComment::HOLD)->whereDate('created_at','>=',$date)->get();

        $totalViews = Blog::where('status',1)->sum('views');
        $totalViewsBeforeweek = Blog::where('status',1)->whereDate('created_at','>=',$date)->sum('views');

        $trendingposts = Blog::orderBy('views', 'desc')->where('status', 1)->take(4)->get();


        return view('backend::dashboard.index',compact('publishedBlog','request','suspendedBlog','schuldedBlog','activeCategories','suspendCategories','publishedcomment','rejectcomment','totalViews','trendingposts','holdcomment','publishedBeforeWeekBlog','suspendedBeforeWeekBlog','schuldedBeforeWeekBlog','activeBeforeWeekCategory','suspendBeforeWeekCategory','publishedBeforeWeekComment','rejectBeforeWeekComment','holdBeforeWeekComment','totalViewsBeforeweek') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

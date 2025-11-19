<?php

namespace App\Http\Livewire\BlogMobile;

use App\Models\Backend\Blog;
use App\Models\Backend\Category;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class RightSidebar extends Component
{
    public $categories;
    public $blogs;
    public $blogPosts;

    public function mount()
    {
        $this->blogs = Blog::take(9)->where('published_date_time', '<=', now())->where('status', 1)->orderBy('published_date_time','desc')->get();
        $this->categories = Category::withCount('blogCategories')->where('status', true)->get();

        $this->blogPosts = Blog::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))->where('status', 1)
            ->orderBy('published_date_time','desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.blog-mobile.right-sidebar');
    }
}


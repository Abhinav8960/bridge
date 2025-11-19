<?php

namespace App\Http\Livewire\Blog;

use App\Models\Backend\Blog;
use App\Models\Backend\Category;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class RightSidebar extends Component
{

    public $categories;
    public $blogs;
    public $blogPosts;

    public function mount()
    {
        $this->blogs = Blog::take(9)->where('published_date_time', '<=', now())->where('status',1)->orderBy('published_date_time','desc')->get();
        $this->categories = Category::withCount('blogCategories')->where('status',true)->get();

        $this->blogPosts = Blog::selectRaw('YEAR(published_date_time) as year, MONTH(published_date_time) as month, COUNT(*) as count')
        ->groupBy(DB::raw('YEAR(published_date_time), MONTH(published_date_time)'))->where('status',1)
        ->orderBy('published_date_time','desc')
        ->get();
    }
    public function render()
    {
        return view('livewire.blog.right-sidebar');
    }

}

<?php

namespace App\Http\Livewire\BlogMobile;

use App\Models\Backend\Blog;
use App\Models\Backend\Category as BackendCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $category;
    public $search;
    protected $paginationTheme = 'bootstrap';

    public function mount($categoryname)
    {
        // dd($categoryname,$month,$year);
        $this->category = BackendCategory::where('name', $categoryname)->withCount('blogCategories')->first();
        // dd($this->category);


    }
    public function render()
    {
        $blogs = Blog::where('status', true)->where('published_date_time', '<=', now())->orderBy('published_date_time', 'desc');
        $blogs = $blogs->whereHas('categories', function ($q) {
            $q->where('category_id', $this->category->id);
        });
        if (!empty($this->search)) {
            $blogs = $blogs->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            });
        }
        $blogs = $blogs->paginate(6);

        return view('livewire.blog-mobile.category', [
            'blogs' => $blogs
        ]);
    }
}

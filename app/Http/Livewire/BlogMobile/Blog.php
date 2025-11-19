<?php

namespace App\Http\Livewire\BlogMobile;

use App\Models\Backend\Blog as BackendBlog;
use App\Models\Backend\Category;
use Livewire\Component;

use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    public $categories;
    public $search;
    protected $paginationTheme = 'bootstrap';
    public $month;
    public $year;

    public function mount($month, $year)
    {

        $this->categories = Category::where('status', true)->get();
    }

    public function render()
    {
        if ($this->month == null && $this->year == null) {

            $blogs = BackendBlog::where('status', 1)->where('published_date_time', '<=', now())->orderBy('published_date_time', 'desc');
            if (!empty($this->search)) {
                $blogs = $blogs->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                });
            }
            $blogs = $blogs->paginate(10);
        } else {
            $blogs = BackendBlog::where('status', 1)
            // ->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year)
            ->where('published_date_time', '<=', now())
            ->orderBy('published_date_time', 'desc');
            if (!empty($this->search)) {
                $blogs = $blogs->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                });
            }
            $blogs = $blogs->paginate(10);
        }
        return view('livewire.blog-mobile.blog', [
            'blogs' => $blogs
        ]);
        // return view('livewire.blog-mobile.blog');
    }
}

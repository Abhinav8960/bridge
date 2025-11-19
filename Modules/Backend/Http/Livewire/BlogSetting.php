<?php

namespace Modules\Backend\Http\Livewire;

use App\Models\Backend\Blog;
use Livewire\Component;

class BlogSetting extends Component
{
    public $model;
    public $is_commentable;
    public $category_color;
    public $is_category_color;
    public $is_comment_moderation;
    public $blog;


    public function mount($model)
    {
        $this->model = Blog::find($model->id);
        // dd($this->blog);

        // $this->model = Blog::where('status', true)->first();

        // ($this->model);
        $this->is_commentable = ($this->model->is_commentable) ? $this->model->is_commentable : false;
        $this->is_category_color = ($this->model->is_category_color) ? $this->model->is_category_color : false;
        $this->category_color = $this->category_color;
        $this->is_comment_moderation = ($this->model->is_comment_moderation) ? $this->model->is_comment_moderation : false;

    }

    public function rules()
    {
        $rules = [];

        // $rules['is_commentable']          = 'required|integer';
        //$rules['is_category_color']       = 'required|integer';
        // $rules['category_color']          = 'required|string|max:50';
         $rules['is_comment_moderation']   = 'required|integer';


        return $rules;
    }



    public function render()
    {
        return view('backend::livewire.blog-setting');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        // dd($this->blog->id);
        // dd($this->feature);
        $this->validate();

        Blog::updateOrCreate(

            [
                'id'    => $this->model->id,
            ],
            [
                'is_commentable'                       => $this->is_commentable,
                'is_category_color'                    => $this->is_category_color,
                'category_color'                       => $this->category_color,
                'is_comment_moderation'                => $this->is_comment_moderation,
                ]
        );
        // $this->storeFeatures($this->feature);
        session()->flash('success', 'Setting update successfully');

         return redirect()->route('blog.index');
    }

}

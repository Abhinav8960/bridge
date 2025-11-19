<?php

namespace App\Http\Livewire\Blog;

use App\Models\Backend\Blog;
use App\Models\Backend\BlogCategory;
use App\Models\Backend\BlogComment;
use App\Models\Backend\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Description extends Component
{

    public $description;
    public $categoryname;
    public $categoryid;
    public $comment;
    public $blogComment;


    public function mount($slug)
    {
        $this->description = Blog::where('post_slug', $slug)->first();
        $this->blogComment = BlogComment::where('blog_id',$this->description->id)->where('is_approved',BlogComment::APPROVED)->get();
        $this->categoryid = BlogCategory::where('blog_id', $this->description->id)->first();
        $this->categoryname = Category::where('id', $this->categoryid->category_id)->first();
    }
    public function render()
    {
        return view('livewire.blog.description');
    }
    public function rules()
    {
        $rules = [];
        $rules['comment'] = 'required';

        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    // public function submit()
    // {
    //     $validatedData = $this->validate();

    //     $comments = new BlogComment();

    //     $comments->blog_id = $this->description->id;
    //     $comments->student_id = Auth::guard('students')->user()->id;
    //     $comments->comment = $this->comment;
    //     if ($this->description->is_approved == Blog::APPROVED) {
    //         $comments->is_approved = BlogComment::HOLD;
    //     } else {
    //         $comments->is_approved = BlogComment::APPROVED;
    //     }



    //     if ($comments->save()) {
    //         \Session::flash('success', 'Your comment Are Successfully Save!');
    //         $this->reset('comment');
    //         // return redirect()->route('founderspen.show', $this->description->post_slug)->with('success', 'Your Comment Are Successfully Saved!');
    //     } else {

    //         // \Session::flash('success', 'Something is Missing;');

    //         return back()->with('error', 'Something is Missing;');
    //     }
    // }

    public function submit()
{
    $validatedData = $this->validate();

    $student = Auth::guard('students')->user();

    if ($student) {
        $comments = new BlogComment();

        $comments->blog_id = $this->description->id;
        $comments->student_id = $student->id;
        $comments->comment = $this->comment;

        if ($this->description->is_approved == Blog::APPROVED) {
            $comments->is_approved = BlogComment::HOLD;
        } else {
            $comments->is_approved = BlogComment::APPROVED;
        }

        if ($comments->save()) {
            \Session::flash('success', 'Your comment was successfully saved!');
            $this->reset('comment');
            // return redirect()->route('founderspen.show', $this->description->post_slug)->with('success', 'Your Comment was successfully saved!');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    } else {
        // Handle the case where the student is not authenticated
        return back()->with('error', 'You must be logged in to leave a comment.');
    }
}



}

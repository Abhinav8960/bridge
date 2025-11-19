<?php

namespace Modules\Backend\Http\Livewire;

use App\Models\Backend\Blog as BackendBlog;
use App\Models\Backend\BlogGalleryImage;
use App\Models\Backend\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Blog extends Component
{


    use WithFileUploads;

    public $model;
    public $title;
    public $author;
    public $sub_title;
    public $post_slug;
    public $images;
    public $featured_alt;
    public $image_dir = 'images/backend/blog';
    public $maxGalleryFileUpload = 10;
    public $schedule = false;
    public $publishedDateTime;

    public $description;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $isSchedule = false;
    public $image;
    public $categoryId = [];
    public $categoryOptions = [];
    public $categoryNames;
    public $postSlug;
    public $counter;
    public $isComment;
    public $categoriesId = [];
    public $isApproved;

    public $submitButton;
    public $categories;
    // public $alt_texts = []; // Optional if you need alt text for each image
    public $gallery_alt = [];


    public $isValidatedForm = false;

    public function mount()
    {
        $this->categoryOptions = Category::where('status', true)->get();

        $this->author =  $this->model->author ?? Auth::user()->name;
        $this->title = $this->model->title;
        $this->featured_alt = $this->model->featured_alt;
        $this->sub_title = $this->model->sub_title;
        $this->schedule = ($this->model->schedule) ? $this->model->schedule : false;

        $this->description = $this->model->description;
        $this->meta_title = $this->model->meta_title;
        $this->meta_keywords = $this->model->meta_keywords;

        $this->meta_description = $this->model->meta_description;
        if (!empty($this->model)) {
            $this->author = $this->model->author ?? Auth::user()->name;
            $this->postSlug = $this->model->post_slug;
            $this->isSchedule = $this->model->schedule;
            $this->isComment = $this->model->is_comment;
            $this->isApproved = $this->model->is_approved;
            $this->publishedDateTime = $this->model->published_date_time;
            foreach ($this->model->categories as $categoriesId) {
                $this->categoriesId[] = $categoriesId['category_id'];
            }
        }
        $images = BlogGalleryImage::all();

        foreach ($images as $image) {
            $this->gallery_alt[$image->id] = $image->gallery_alt;
        }
    }


    public function render()
    {
        return view('backend::livewire.blog');
    }
    public function rules()
    {
        $rules = [];


        $rules['title']          = 'required|string';
        $rules['featured_alt']          = 'required|string';

        $rules['isComment']          = 'required';

        $rules['sub_title']          = 'required|string|max:75';
        $rules['postSlug'] = [
            'required',
            Rule::unique('blog', 'post_slug')
                ->ignore($this->model->id, 'id')
                ->whereNull('deleted_at'),
        ];

        $rules['meta_title']          = 'required|string|max:150';
        $rules['meta_keywords']          = 'required|string';


        $rules["schedule"] = "boolean";
        if ($this->schedule == 'on') {
            $rules["publishedDateTime"] = 'required|after:' . Carbon::now();
        }
        if ($this->isComment == 1) {
            $rules["isApproved"] = 'required';
        }
        if (!empty($this->image)) {

            // $rules['image']          = 'dimensions:width=1080,height=400|mimes:jpeg|max:100';
            $rules['image']          = 'image|mimes:jpeg,webp|max:100';
        }

       

        $rules['categoriesId']                    = 'required';


        return $rules;
    }

    protected $messages = [
        'image.dimensions' => 'The :attribute dimension should be  Jpeg,Webp Only.',
    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function updatedSchedule($Schedule)
    {
        if ($this->schedule == true) {
            $this->isSchedule = true;
        } else {
            $this->isSchedule = false;
        }
    }


    public function updatedTitle()
    {

        // $slug = Str::slug($this->title);
        // $count = 2;
        // while (BackendBlog::where('post_slug', $slug)->exists()) {
        //     $slug = Str::slug($this->title) . '-' . $count;
        //     $count++;
        // }
        // $this->postSlug = $slug;
    }


    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }


    public function updatedImages($propertyName)
    {
        $this->validate([
            'images'                    => 'max:' . $this->maxGalleryFileUpload,
            'images.*'                  => 'image|mimes:jpeg,webp',
            // 'images.*'                  => 'image|dimensions:width=1080,height=400|mimes:jpeg',
        ], [
            'images.max' => 'The images must be less than or equal to ' . $this->maxGalleryFileUpload . ' files now, and maximum 10',
            'images.*.image' => 'Only Image file can be upload',
            // 'images.*.dimensions' => 'Image dimensions should be 1080 pixels x 400 pixels.',
            'images.*.mimes' => 'Image File should be jpeg Format'
        ]);
    }


    public function resetImage($key)
    {

        $image = BlogGalleryImage::where('id', $key)->first();
        $blog = $image->blog_id;
        $image->delete();

        return redirect()->route('blog.edit', $blog)->with('success', 'image removed successfully.');
    }

    public function updateImageAlt($imageId)
    {
        // Find the image and update the alt text
        $image = BlogGalleryImage::find($imageId);

        if ($image && isset($this->gallery_alt[$imageId])) {
            $image->gallery_alt = $this->gallery_alt[$imageId];  // Update with the current input value
            $image->save();

            session()->flash('message', 'Image alt text updated successfully!');
        }
    }

}

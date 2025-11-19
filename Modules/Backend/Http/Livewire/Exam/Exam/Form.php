<?php

namespace Modules\Backend\Http\Livewire\Exam\Exam;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;

class Form extends Component
{
    use WithFileUploads;

    public $model;
    public $action;
    public $method;
    public $enctype;

    public $category_id;
    public $stream_id;
    public $name;
    public $fullname;
    public $status;
    public $icon;
    public $submitButton;
    public $category;
    public $streams = [];

    public function mount()
    {
        $this->category = Category::where('status', '1')->get();
        $this->category_id = $this->model->category_id;
        $this->stream_id = $this->model->stream_id;
        $this->name = $this->model->name;
        $this->fullname = $this->model->fullname;
        $this->status = $this->model->status;
    }
    public $stream;


    public function render()
    {
        if (!empty($this->category_id)) {

            $this->streams = Stream::where(['status' => '1', 'category_id' => $this->category_id])->get();
        }

        return view('backend::livewire.exam.exam.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['category_id']           = 'required|integer';
        $rules['stream_id']             = 'required|integer';
        $rules['name']                  = 'required|string|max:120';
        $rules['fullname']              = 'string|max:120';
        if (!empty($this->icon)) {

            $rules['icon']          = 'dimensions:width=300,height=200|mimes:jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'icon.dimensions' => 'The :attribute dimension should be 300 pixels x 200 pixels.',
    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if ($propertyName == 'category_id') {
            $this->streams = Category::where(['status' => '1', 'id' => $this->category_id])->get();
        }
    }

    public function updatedCategory_id()
    {
        $this->streams = Stream::where(['status' => '1', 'category_id' => $this->category_id])->get();
    }
}

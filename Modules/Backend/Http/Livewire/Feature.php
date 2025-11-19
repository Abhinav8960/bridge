<?php

namespace Modules\Backend\Http\Livewire;

use Livewire\Component;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Packages;
//use App\Models\Backend\Feature;
use App\Models\Institute;

class Feature extends Component
{

    public $model;
    public $instituteId;
    public $categoryId;
    public $isHome;
    public $status;
    public $categoryOptions;
    public $institutes;
    public $isCategory = false;
    public $seletedCategories = [];

    public function mount()
    {
        // $this->institutes = Institute::where('status', true)->where('package_id', Packages::PREMIUM_PACKAGE)->get();
        $this->institutes = Institute::where('status', true)->get();
        $this->categoryOptions = Category::where('status', true)->get();

        if (!empty($this->model->id)) {
            $this->setAllAttRibutes();
        }
    }


    public function render()
    {
        return view('backend::livewire.feature');
    }


    public function rules()
    {
        $rules = [];

        $rules['instituteId']                         = 'required|integer';

        if ($this->isCategory == true) {
            $rules['seletedCategories']                 = 'required|integer';
        }

        return $rules;
    }



    public function updatedIsCategory($isCategory)
    {
        $this->validateOnly('seletedCategories');
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    private function setAllAttRibutes()
    {

        $this->status = $this->model->status;
        $this->instituteId = $this->model->institute_id;
        $this->isHome = ($this->model->isHome) ? $this->model->isHome : false;
        $this->isCategory = ($this->model->isCategory) ? $this->model->isCategory : false;
        if ($this->isCategory) {
            foreach ($this->model->FeturelistCategories as $feturelistCategory)
                $this->seletedCategories[$feturelistCategory->category_id] = true;
        }
    }
}

<?php

namespace Modules\Backend\Http\Livewire\Exam\Category;

use App\Rules\MaxWordsRule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Backend\Entities\BillingAccount;
use Modules\Backend\Entities\SacCode;
use Modules\Backend\Entities\Tax;

class Form extends Component
{
    use WithFileUploads;

    public $model;

    public $name;
    public $bookingFees;
    public $teasure_line;
    public $status;
    public $icon;
    public $banner;
    public $isShowHomepage;
    public $mobile_dashboard_banner;
    public $mobile_category_page_banner;
    public $description;
    public $taxId;
    public $billingAccountId;
    public $sacCodeId;
    public $taxOptions;
    public $sacCodeOptions;
    public $billingOptions;
    public $submitButton;
    public $taxTypeId;


    public $isValidatedForm = false;


    public function mount()
    {
        $this->taxOptions = Tax::where('status', true)->get();
        $this->sacCodeOptions = SacCode::where('status', true)->get();
        $this->billingOptions = BillingAccount::where('status', true)->get();

        $this->name = $this->model->name;
        $this->bookingFees = $this->model->booking_fees;
        $this->teasure_line = $this->model->teasure_line;
        $this->description = $this->model->description;
        $this->taxId = $this->model->tax_id;
        $this->sacCodeId = $this->model->sac_code_id;
        $this->billingAccountId = $this->model->billing_account_id;
        $this->taxTypeId = $this->model->tax_type_id;
        $this->status = $this->model->status;
        $this->isShowHomepage = $this->model->is_show_homepage;
    }

    public function render()
    {
        return view('backend::livewire.exam.category.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['name']          = 'required|string|max:50';
        $rules['isShowHomepage']   = 'required';
        $rules['bookingFees']   = 'required|integer';
        $rules['teasure_line']   = 'required';
        $rules['taxTypeId']   = 'required';
        $rules['taxId']   = 'required';
        $rules['billingAccountId']   = 'required';
        $rules['sacCodeId']   = 'required';
        if (!empty($this->teasure_line)) {
            $rules['teasure_line']   = new MaxWordsRule(10);
        }
        $rules['description']   = 'required';
        if (!empty($this->description)) {
            $rules['description']   = new MaxWordsRule(75);
        }
        if (!empty($this->icon)) {

            $rules['icon']          = 'dimensions:width=144,height=144|mimes:jpeg|max:100';
        }
        if (!empty($this->banner)) {

            $rules['banner']        = 'dimensions:width=1600,height=325|mimes:jpeg|max:100';
        }
        if (!empty($this->mobile_dashboard_banner)) {

            $rules['mobile_dashboard_banner']        = 'dimensions:width=1080,height=400|mimes:png|max:150';
        }
        if (!empty($this->mobile_category_page_banner)) {

            $rules['mobile_category_page_banner']        = 'dimensions:width=1080,height=450|mimes:jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'icon.dimensions' => 'The :attribute dimension should be 144 pixels x 144 pixels.',
        'banner.dimensions' => 'The :attribute dimension should be 1600 pixels x 325 pixels.',
        'mobile_dashboard_banner.dimensions' => 'The :attribute dimension should be 1080 pixels x 400 pixels.',
        'mobile_category_page_banner.dimensions' => 'The :attribute dimension should be 1080 pixels x 450 pixels.',
    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}

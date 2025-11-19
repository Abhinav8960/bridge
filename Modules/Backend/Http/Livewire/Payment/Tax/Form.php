<?php

namespace Modules\Backend\Http\Livewire\Payment\Tax;

use Livewire\Component;
use Modules\Backend\Entities\Tax;
use Modules\Backend\Entities\TaxBreakup;

class Form extends Component
{
    public $model;
    public $name;
    public $percentage;
    public $breakupLoop;
    public $breakupTaxName;
    public $breakupTaxArray = [];
    public $breakupTaxPercentage;
    public $breakupTaxPercentagemax = 0;
    public $isBreakup = false;
    public $status;

    public function mount($model)
    {
        $this->model = $model;
        if ($this->model->id) {
            $this->name =  $this->model->name;
            $this->percentage =  $this->model->percentage;
            $this->isBreakup =  $this->model->is_breakup;
            $this->status =  $this->model->status;
            if ($this->isBreakup == true) {
                foreach ($this->model->breakups as $key => $arr) {

                    $this->breakupTaxArray[] = [
                        'name' => $arr->name,
                        'percentage' => $arr->percentage,
                    ];
                }
            }

            $this->doCalculation();
        }
    }

    public function render()
    {
        return view('backend::livewire.payment.tax.form');
    }

    public function rules()
    {
        $rules = [];

        if (!empty($this->model->id)) {

            $rules['name']                      = 'required|unique:taxes,name,' . $this->model->id;
        } else {

            $rules['name']                      = 'required|unique:taxes,name';
        }
        $rules['percentage']                = 'required|numeric|max:100';
        if ($this->breakupTaxPercentagemax > 0) {
            if($this->isBreakup == true){
                $rules['breakupTaxName']            = 'required|string';
                $rules['breakupTaxPercentage']      = 'required|numeric|lte:' . $this->breakupTaxPercentagemax;
            }
        }


        return $rules;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPercentage($percentage)
    {

        $this->doCalculation();
    }

    public function updatedIsBreakup($isBreakup)
    {


        if ($isBreakup == true) {
            if (!empty($this->percentage)) {
                $this->breakupTaxPercentage = $this->percentage;
                $this->breakupTaxPercentagemax = $this->percentage;
            }
        } else {

            $this->reset(['breakupTaxPercentagemax', 'breakupTaxArray']);
        }
    }

    public function addBreakup()
    {

        $validatedData = $this->validate();
        if ($validatedData) {
            $this->breakupTaxArray[] =
                [
                    'name' => $this->breakupTaxName,
                    'percentage' => $this->breakupTaxPercentage,
                ];

            $this->doCalculation();


            $this->reset(['breakupTaxName', 'breakupTaxPercentage']);
        }
    }

    public function removeBreakups($array_key)
    {

        unset($this->breakupTaxArray[$array_key]);

        $this->doCalculation();
    }

    private function doCalculation()
    {

        $this->breakupTaxPercentagemax = $this->percentage - array_sum(array_column($this->breakupTaxArray, 'percentage'));
    }


    public function submit()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            if (!empty($this->model->id)) {

                $model = Tax::where('id', $this->model->id)->first();
                $model->status = $this->status;
            } else {

                $model = new Tax();
            }
            $model->name = $this->name;
            $model->percentage = $this->percentage;
            $model->is_breakup = $this->isBreakup;

            if ($model->save()) {
                if ($this->isBreakup == true) {
                    TaxBreakup::where('tax_id', $model->id)->delete();
                    foreach ($this->breakupTaxArray as $key => $arr) {
                        $m = new TaxBreakup();
                        $m->tax_id = $model->id;
                        $m->name = $arr['name'];
                        $m->percentage = $arr['percentage'];
                        $m->save();
                    }
                }
            }

            return redirect()->route('payment.tax.index')->with('success', 'Tax Saved successfully');
        }
    }
}


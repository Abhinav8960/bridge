<?php

namespace Modules\Backend\Http\Livewire\Payment\SacCode;

use Livewire\Component;
use Modules\Backend\Entities\SacCode;

class Form extends Component
{
    public $model;
    public $SacCode;
    public $description;
    public $status;

    public function mount($model)
    {
        $this->model = $model;
        if ($this->model->id) {
            $this->SacCode =  $this->model->sac_code;
            $this->description =  $this->model->description;
            $this->status =  $this->model->status;
        }
    }


    public function render()
    {
        return view('backend::livewire.payment.sac-code.form');
    }

    public function rules()
    {
        $rules = [];

        if (!empty($this->model->id)) {

            $rules['SacCode']                       = 'required|integer|digits_between:1,999999|unique:sac_codes,sac_code,' . $this->model->id;
        } else {

            $rules['SacCode']                       = 'required|integer|digits_between:1,999999|unique:sac_codes,sac_code';
        }
        $rules['description']                      = 'required|string|max:255';



        return $rules;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function submit()
    {
        $validatedData = $this->validate();
        if ($validatedData) {

            if (!empty($this->model->id)) {

                $model = SacCode::where('id', $this->model->id)->first();
                $model->status = $this->status;
            } else {

                $model = new SacCode();
            }
            $model->sac_code = $this->SacCode;
            $model->description = $this->description;

            $model->save();

            return redirect()->route('payment.saccode.index')->with('success', 'SAC Code Saved successfully');
        }
    }
}

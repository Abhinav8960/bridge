<?php

namespace Modules\Backend\Http\Livewire\Configuration\PrivacyPolicy;

use App\Models\Backend\Configuration\PrivacyPolicyDates;
use Livewire\Component;

class Listing extends Component
{

    public $model;

    public  $effective_date;
    public  $last_updated;

    public $submitDate;
    public $submitButton;
    public $isValidatedForm = false;

    public function mount()
    {
        $this->updatedModel();
        $this->effective_date = $this->model->effective_date;
        $this->last_updated = $this->model->last_updated;
        //  $this->defaultload();
    }

    public function render()
    {
        return view('backend::livewire.configuration.privacy-policy.listing');
    }

    public function rules()
    {
        $rules = [];


        $rules['effective_date']               = 'required';
        $rules['last_updated']                 = 'required';

        return $rules;
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        // dd($validatedData);
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {

        $this->validate();

        PrivacyPolicyDates::updateOrCreate(
            [
                'id'                    => $this->model->id,
            ],
            [
                'effective_date' => $this->effective_date,
                'last_updated'   => $this->last_updated,
            ]

        );
        $this->defaultload();
        session()->flash('success', 'Privacy Policy Dates update successfully');

        return redirect()->route('configuration.privacypolicy.index');
    }

    private function defaultload()
    {
        if (!empty($this->model->id)) {
            $this->effective_date = $this->model->effective_date;
            $this->last_updated = $this->model->last_updated;
        }
    }

    public function updatedModel()
    {

        if (!empty($this->model)) {
            $this->model =  PrivacyPolicyDates::where('status', true)->first();
        }

        if (empty($this->model)) {
            $this->model = new PrivacyPolicyDates();
        }
    }




}

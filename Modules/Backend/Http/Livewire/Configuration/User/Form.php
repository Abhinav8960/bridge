<?php

namespace Modules\Backend\Http\Livewire\Configuration\User;

use App\Helpers\Helper;
use Livewire\Component;

class Form extends Component
{
    public $model;
    public $name;
    public $role_id;
    public $phone;
    public $email;
    public $roleOptions;
    public $isValidatedForm = false;

    public function mount($model)
    {

        $this->roleOptions = Helper::InternalRoles();

        if (!empty($this->model->id)) {
            $this->model = $model;
            $this->name = $model->name;
            $this->email = $model->email;
            $this->phone = $model->phone;
            $this->role_id = $model->role_id;
        }
    }

    public function render()
    {
        return view('backend::livewire.configuration.user.form');
    }


    public function rules()
    {
        $rules = [];

        $rules['name']                          = 'required|string|max:50';
        $rules['email']                         = 'required|email';
        if (!empty($this->model->id)) {
            $rules['phone']                         = 'required|numeric|digits:10|unique:\App\Models\User,id,' . $this->model->id;
        } else {
            $rules['phone']                         = 'required|numeric|digits:10|unique:\App\Models\User,phone,NULL,id,deleted_at,NULL';
        }
        $rules['role_id']                       = 'required|integer|in:' . implode(', ', array_keys(Helper::InternalRoles()));


        return $rules;
    }



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

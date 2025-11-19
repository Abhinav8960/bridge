<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Helpers\SmsHelper;
use App\Models\Institute\Information\Center;
use App\Models\InstituteContact;
use App\Rules\MaxWordsRule;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Contact extends Component
{
    public $institute;
    public $corporateOffice;
    public $name;
    public $phone;
    public $email;
    public $subject;
    public $mesaage;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {
        $this->institute = $institute;

        $this->corporateOffice = Center::where(['institute_id' => $this->institute->id, 'branch_type' => Center::CORPORATE_HEADQUARTER])->first();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.institute.microsite.contact');
    }

    public function rules()
    {
        $rules = [];


        $rules['name']   = 'required|string|max:50';
        $rules['phone'] = 'required|integer|digits:10';
        $rules['email'] = 'required|email';
        $rules['subject'] = 'required';
        $rules['mesaage'] = 'required';
        $rules['mesaage']   = new MaxWordsRule(50);
        // if (config('app.env') === 'production') {
        //     $rules['recaptcha']      = 'required';
        // }

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {

        // $valid =   $this->validate();

        // if ($valid) {
            $model  = new InstituteContact();
            $model->institute_id  = $this->institute->id;
            $model->user_id  = (Auth::check()) ? Auth::user()->id : NULL;
            $model->student_id  = (Auth::guard('students')->check()) ? Auth::guard('students')->user()->id : NULL;
            $model->name  = $this->name;
            $model->phone  = $this->phone;
            $model->email  = $this->email;
            $model->subject  = $this->subject;
            $model->mesaage  = $this->mesaage;
            $model->save();
            SmsHelper::instituteLead($this->institute->user->phone, $this->institute->name, $this->name);
            session()->flash('success', 'We will get back to you shortly !');
            $this->reset();
        // }
    }
}

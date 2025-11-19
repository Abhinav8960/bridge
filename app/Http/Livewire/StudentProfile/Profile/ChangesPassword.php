<?php

namespace App\Http\Livewire\StudentProfile\Profile;

use App\Models\Student;
use App\Models\User;
use App\Rules\CheckCurrentPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class ChangesPassword extends Component
{
    public $user;
    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        $this->user = Auth::guard('students')->user();
        $this->name = Auth::guard('students')->user()->name;
        $this->email = Auth::guard('students')->user()->email;

        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }
    public function render()
    {
        return view('livewire.student-profile.profile.changes-password');
    }

    public function rules()
    {
        $rules = [];
        $rules['name']   = 'required|string|max:50';
        $rules['email']   = 'required|email';
        $rules['current_password']   = 'required|string|max:50';
        $rules['current_password']   = new CheckCurrentPassword($this->user->password);
        $rules['password'] = 'required|min:6';
        $rules['password_confirmation'] = 'required|min:6|same:password';

        return $rules;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedName($name)
    {
        $user =  Student::where('id', $this->user->id)->first();
        $user->name = $name;
        $user->save();
        session()->flash('success', 'Name changed successfully!');
    }

    public function updatedEmail($email)
    {
        $user =  Student::where('id', $this->user->id)->first();
        $user->email = $email;
        $user->save();
        session()->flash('success', 'Email changed successfully!');
    }

    public function submit()
    {

        $validate = $this->validate();
        if ($validate) {
            $usr = Student::where('id', $this->user->id)->first();
            $usr->actual_password = $this->password;
            $usr->password = Hash::make($this->password);
            $usr->save();
            session()->flash('success', 'Your Password is successfully changed!');
            $this->reset(['current_password', 'password', 'password_confirmation']);
        }
    }
}

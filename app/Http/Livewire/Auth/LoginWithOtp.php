<?php

namespace App\Http\Livewire\Auth;

use App\Helpers\SmsHelper;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class LoginWithOtp extends Component
{

    public $phone;
    public $digitOne;
    public $digitTwo;
    public $digitThree;
    public $digitFour;
    public $digitFive;
    public $digitSix;
    public $isOtpSend = false;
    public $isOtpSendButtonActive = false;
    public $isOtpReSendButtonActive = false;
    public $seconds = 20;
    public $isFormValid = false;
    public $randomNumber;
    public $enteredOtp;
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {

        return view('livewire.auth.login-with-otp');
    }

    public function rules()
    {
        $rules = [];
        // $rules['phone']                         = 'required|numeric|exists:students,phone';
        $rules['phone']                         = 'required|numeric|digits:10';
        // $rules['digitOne']                    = 'required|numeric';
        // $rules['digitTwo']                    = 'required|numeric';
        // $rules['digitThree']                    = 'required|numeric';
        // $rules['digitFour']                    = 'required|numeric';
        // $rules['digitFive']                    = 'required|numeric';
        // $rules['digitSix']                    = 'required|numeric';
        return $rules;
    }

    protected $messages = [
        'phone.exists' => 'This no is not in our record.',
    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }


    public function updatedPhone($phone)
    {
        $this->isOtpSendButtonActive = true;
    }

    public function updatedDigitOne($digitOne)
    {
        $this->checkCredentials();
    }

    public function updatedDigitTwo($digitTwo)
    {
        $this->checkCredentials();
    }

    public function updatedDigitThree($digitThree)
    {
        $this->checkCredentials();
    }

    public function updatedDigitFour($digitFour)
    {
        $this->checkCredentials();
    }

    public function updatedDigitFive($digitFive)
    {
        $this->checkCredentials();
    }

    public function updatedDigitSix($digitSix)
    {
        $this->checkCredentials();
    }


    // $validatedData = Validator::make(
    //     ['password' => $this->digitSix],
    //     ['password' => 'required|numeric'],
    //     ['required' => 'This field is required'],
    // )->validate();

    public function checkCredentials()
    {
        $this->enteredOtp = $this->digitOne . $this->digitTwo . $this->digitThree . $this->digitFour . $this->digitFive . $this->digitSix;
        if ($this->randomNumber !=  $this->enteredOtp) {
            $this->addError('password', 'Otp is not correct');
        } else {
            $this->isFormValid = true;
        }
    }

    public function sendOtp()
    {
        $this->isOtpSendButtonActive = false;
        $this->randomNumber = random_int(100000, 999999);
        $passwordNumber = random_int(100000, 999999);


        $model = Student::where('phone', $this->phone)->first();

        if (empty($model)) {
            $model = new Student();
            $model->phone = $this->phone;
            $model->password = Hash::make($passwordNumber);
            $model->actual_password = $passwordNumber;
        }
        $model->otp = $this->randomNumber;
        $model->otp_generate_datetime = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $model->save();

        SmsHelper::loginWithOtp($this->phone, $this->phone, $this->randomNumber);
        $this->reset('digitOne');
        $this->reset('digitTwo');
        $this->reset('digitThree');
        $this->reset('digitFour');
        $this->reset('digitFive');
        $this->reset('digitSix');
        $this->isOtpSend = true;
    }

    public function resendOtp()
    {
        $this->sendOtp();
        $this->isOtpReSendButtonActive = false;
        $this->seconds = 20;
    }


    public function timerCountDown()
    {
        if ($this->seconds >= 1) {
            $sec = $this->seconds--;
            return  "00:" . sprintf("%02d", $sec);
        } else {
            $this->isOtpReSendButtonActive = true;
        }
    }
}

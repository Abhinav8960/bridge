<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required', 'numeric', 'exists:students,phone'],
        ]);
    }

    public function sendOtp(Request $request)
    {

        $this->validator($request->all())->validate();
        $randomNumber = random_int(100000, 999999);

        $model = Student::where('phone',$request->phone)->firstOrFail();
        // $model->otp = $randomNumber;
        // $model->otp_generate_datetime = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        // $model->save();

        SmsHelper::userFetchPassword($request->phone,$model->name,$model->actual_password);

        return redirect()->back()->with('success', 'Password sent on your mobile.');;
    }
}

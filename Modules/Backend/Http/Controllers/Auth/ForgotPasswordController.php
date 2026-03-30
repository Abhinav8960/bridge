<?php

namespace Modules\Backend\Http\Controllers\Auth;

use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showForgetPasswordForm()
    {
        return view('backend::auth.forgetpassword');
    }

    protected function validator(array $data)
    {
        if (config('app.env') === 'production') {
            return Validator::make($data, [
                'phone' => ['required', 'numeric', 'exists:users,phone'],
                'g-recaptcha-response' => ['required', 'captcha'],
            ]);
        } else {

            return Validator::make($data, [
                'phone' => ['required', 'numeric', 'exists:users,phone'],
            ]);
        }
    }

    public function sendOtp(Request $request)
    {

        $this->validator($request->all())->validate();

        $model = User::where('phone', $request->phone)->firstOrFail();
        $instituteName = isset($model->institute->name) ? $model->institute->name : 'Admin';
        // SmsHelper::vendorCredentialSend($request->phone, $instituteName,  $model->name, $model->actual_password);  //template11


        return redirect()->back()->with('success', 'Password sent on your mobile.');;
    }
}

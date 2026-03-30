<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Jenssegers\Agent\Agent;

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




    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showForgetPasswordForm()
    {
        $agent = new Agent();

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
            return view('auth.mobile.passwords.otp');
        }

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('auth.passwords.otp');
        }

        $tabletResult = $agent->isTablet();
        if ($tabletResult) {
            return view('auth.passwords.otp');
        }

        $tabletResult = $agent->isPhone();
        if ($tabletResult) {
            return view('auth.mobile.passwords.otp');
        }
        // return view('auth.passwords.otp');
    }
}

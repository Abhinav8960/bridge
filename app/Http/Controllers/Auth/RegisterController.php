<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:students');
        parent::__construct();
    }

    public function showRegistrationForm()
    {
        $agent = new Agent();

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
            return view('auth.mobile.register');
        }

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('auth.register');
        }

        $tabletResult = $agent->isTablet();
        if ($tabletResult) {
            return view('auth.register');
        }

        $tabletResult = $agent->isPhone();
        if ($tabletResult) {
            return view('auth.mobile.register');
        }
        // return view('auth.register');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'school-name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:students'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Student
     */
    protected function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10|unique:students',
            'email' => 'required|email',
            'tc' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $validator->after(function ($validator) use ($request) {
            $phone = $request->phone;

            $userExists = \DB::table('users')->where('phone', $phone)->exists();

            $studentExists = Student::where('phone', $phone)->exists();

            if ($userExists || $studentExists) {
                $validator->errors()->add('phone', 'This number already registered as student or institute');
            }
            // if ($request->password !=  $request->password_confirmation) {
            //     $validator->errors()->add('password', 'password did not match');
            // }
        });

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->password = Hash::make($request->password);
        $student->actual_password = $request->password;
        if ($student->save()) {

            SmsHelper::userRegistration($student->phone, $student->name, $student->actual_password);
            return redirect()->back()->with('success' , 'Your Registration is Successful');
        }
    }
    }

    protected function guard()
    {
        return Auth::guard('students');
    }
}

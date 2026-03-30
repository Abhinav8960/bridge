<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{

    public function index()
    {
        return view('student.home');
    }

    // public function login()
    // {
    //     return view('auth.login');
    // }

    public function login($user,$isStudent,$student){
        $user = Student::findorfail($user);
        session()->invalidate();
        Auth::login($user);
        session()->put('student.id', Auth::user()->student->id);
        if($isStudent){
            session(['isStudent' => true]);
            session(['student' => $student]);
        }
        return redirect()->route('/');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('students')
               ->attempt($req->only(['email', 'password'])))
        {
            return redirect()
                ->route('student.home');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::guard('students')
            ->logout();

        return redirect()
            ->route('/');
    }

    // protected function redirectTo($request)
    // {
    //     if (!$request->expectsJson()) {
    //         if ($request->routeIs('student.*')) {
    //             return route('student.login');
    //         }
    //     }
    // }
}

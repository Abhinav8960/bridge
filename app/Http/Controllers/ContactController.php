<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class ContactController extends Controller
{

    public function index(Request $request)
    {   //dd($request->all());

        $model = Contact::where('status', true)->latest()->paginate()->withQueryString();

        return view('backend::contactUs.index', compact(['model', 'request']));
    }

    public function contact(Request $request)
    {   //dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|integer|digits:10',
            'type' => 'required|in:1',
            'message' => 'required|string|max:255',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model = new Contact();
            $model->name = $request->name;
            $model->mobile = $request->mobile;
            $model->email = $request->email;
            $model->type = $request->type;
            $model->message = $request->message;
            $model->status = true;
            $model->save();

            $request->session()->flash('alert-success', 'Thanks for Contact!');
            return redirect()->back();
        }
    }
}

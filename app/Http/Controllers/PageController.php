<?php

namespace App\Http\Controllers;

use App\Models\Backend\Blog;
use App\Helpers\LocationHelper;
use App\Models\Backend\Configuration\Faq;
use App\Models\Backend\Configuration\PrivacyPolicy;
use App\Models\Backend\Configuration\PrivacyPolicyDates;
use App\Models\Backend\Configuration\TermAndUse;
use App\Models\Backend\Configuration\TermAndUseDates;
use App\Models\Contact;
use App\Models\EnrollContact;
use App\Models\Institute;
use App\Models\Institute\Information\General;
use App\Rules\MaxWordsRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Agent;

class PageController extends Controller
{
    public function home()
    {
        $agent = new Agent();


        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.home');
        }

        return view('page.mobile.home');




        // dd($result);
        // dd(LocationHelper::postAllArea(6, 150));
        // return view('page.home');
    }

    public function about()
    {
        return view('page.about');
    }

    public function faq()
    {
        $faqs = Faq::where('status', true)->orderBy('order_by', 'asc')->get();
        return view('page.faq', compact('faqs'));
    }

    public function contact()
    {
        $conatctTypeOptions =  \App\Helpers\Helper::conatctTypeOptions();
        return view('page.contact', compact(['conatctTypeOptions']));
    }

    public function microsite($slug)
    {
        $institute = Institute::where('slug', $slug)->where('status', true)->firstOrFail();
        $i_id  = $institute->id;
        $generalsData = General::where('institute_id',$i_id)->first();

        $agent = new Agent();



        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.microsite', compact('institute','generalsData'));
        }
        return view('page.mobile.microsite', compact('institute','generalsData'));
    }

    public function enroll()
    {
        $cities = LocationHelper::allCities();
        return view('page.enroll', compact('cities'));
    }
    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::where('status', true)->orderBy('module_sequence', 'asc')->get();
        // dd($privacyPolicy);
        $date = PrivacyPolicyDates::where('status', true)->first();
        return view('page.privacy-policy', compact('privacyPolicy', 'date'));
    }
    public function termsOfUse()
    {
        $termsOfUse = TermAndUse::where('status', true)->orderBy('module_sequence', 'asc')->get();
        $date = TermAndUseDates::where('status', true)->first();
        return view('page.terms_of_use', compact('termsOfUse', 'date'));
    }

    public function compare()
    {
        $agent = new Agent();


        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.compare');
        }
        return view('page.mobile.compare');
    }


    public function blog()
    {
        $agent = new Agent();

        $month = null;
        $year = null;

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.blog.blog', compact('month', 'year'));
        }
        return view('page.mobile.blog.blog', compact('month', 'year'));
    }

    public function blogdetail($slug)
    {
        $agent = new Agent();

        $desktopResult = $agent->isDesktop();
        $post = Blog::where('post_slug', $slug)->first();

        $post->increment('views');

        if ($desktopResult) {
            return view('page.blog.description', compact('slug', 'post'));
        }
        return view('page.mobile.blog.description', compact('slug', 'post'));


    }

    public function blogcategory($category)
    {
        $agent = new Agent();

        $desktopResult = $agent->isDesktop();

        if ($desktopResult) {
            return view('page.blog.category', compact('category'));
        }
        return view('page.mobile.blog.category', compact('category'));

    }

    public function blogarchives($month, $year)
    {
        $agent = new Agent();

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.blog.blog', compact('month', 'year'));

        }
        return view('page.mobile.blog.blog', compact('month', 'year'));
    }

    public function profile()
    {
        $agent = new Agent();



        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.profile');
        }
        return view('page.mobile.profile');
    }


    public function wishlist()
    {
        $agent = new Agent();

        $desktopResult = $agent->isDesktop();
        if (!$desktopResult) {
            return view('page.mobile.wishlist');
        }
        abort(404);
        // return view('page.wishlist');
    }
    public function enrolled()
    {
        $agent = new Agent();

        $desktopResult = $agent->isDesktop();
        if (!$desktopResult) {
            return view('page.mobile.enrolled');
        }
        abort(404);
    }


    public function contactStore(Request $request)
    {

        if (env('APP_ENV') == 'production') {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|integer|digits:10',
                'type' => 'required',
                'message' => 'required',
                'message' => new MaxWordsRule(100),
                'g-recaptcha-response' => 'required|captcha'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|integer|digits:10',
                'type' => 'required',
                'message' => 'required',
                'message' => new MaxWordsRule(100),
                // 'g-recaptcha-response' => 'required|captcha'
            ]);
        }


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
            return redirect()->back()->with('success', 'Thanks for contacting us! You will soon be contacted ');
        }
    }

    public function storeEnroll(Request $request)
    {

        if (env('APP_ENV') == 'production') {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'institute' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => 'required|integer|digits:10',
                'email' => 'required|email',
                'g-recaptcha-response' => 'required|captcha'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'institute' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => 'required|integer|digits:10',
                'email' => 'required|email',
            ]);
        }


        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $model = new EnrollContact();
            $model->name = $request->name;
            $model->institute = $request->institute;
            $model->city = $request->city;
            $model->phone = $request->phone;
            $model->email = $request->email;
            $model->save();
            return redirect()->back()->with('success', 'Thank you for Enroll yourself with Us!');
        }
    }
}

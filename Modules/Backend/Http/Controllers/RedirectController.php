<?php

namespace Modules\Backend\Http\Controllers;


use App\Models\Backend\Blog\Blog;
use App\Models\Backend\Blog\Category;
use App\Models\Backend\Config\Misc\Topic;
use App\Models\Backend\Institute;
use App\Models\Institute\News;
use App\Models\Institute\NewsLocationTargeting;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;



class RedirectController extends Controller
{

    public function index()
    {
        $redirectDatas  = Redirect::get();

        return view('backend::redirect.index', compact('redirectDatas'));
    }

    public function create()
    {
        $model = new Redirect();
        return view('backend::redirect.create', compact('model'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'old_url' => 'required|url',
            'new_url' => 'required|url',
        ]);

        // dd($request->method);
        // Save the redirect data
        $redirect = new Redirect();
        $redirect->old_url = $request->old_url;
        $redirect->new_url = $request->new_url;
        $redirect->method = $request->method ? $request->method : 301;
        $redirect->is_redirect = 0; // Set the default value
        $redirect->save();

        // Redirect back with a success message
        return redirect()->route('redirectIndex')->with('success', 'Redirect created successfully.');
    }
}

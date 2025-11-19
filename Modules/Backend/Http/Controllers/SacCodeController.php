<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\SacCode;

class SacCodeController extends Controller
{
    public $pageSize;

    public function __construct()
    {
        $this->pageSize = !empty(request()->pagesize) ? request()->pagesize : 10;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saccodes = SacCode::where('status', true)->paginate($this->pageSize);

        return view('backend::payment.saccode.index', compact('saccodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new SacCode();
        return view('backend::payment.saccode.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Payment\SacCode  $saccode
     * @return \Illuminate\Http\Response
     */
    public function show(SacCode $saccode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Payment\SacCode  $saccode
     * @return \Illuminate\Http\Response
     */
    public function edit(SacCode $saccode)
    {
        $model = $saccode;
        return view('backend::payment.saccode.create', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Payment\SacCode  $saccode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SacCode $saccode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Payment\SacCode  $saccode
     * @return \Illuminate\Http\Response
     */
    public function destroy(SacCode $saccode)
    {
        // if($saccode->events()->count() <= 0){
        $saccode->delete();
        return redirect()->route('payment.saccode.index')->with('success', 'SAC Code Deleted successfully');
        // }
        // return redirect()->route('payment.saccode.index')->with('warning', 'SAC Code can not delete beacause already used in seasoon');

    }
}

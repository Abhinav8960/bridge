<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Models\Backend\Configuration\Faq;
use App\Models\Backend\Configuration\FaqCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Controllers\BaseController;

class FaqController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $faqs = Faq::where('status', true)->get();
        $categories = FaqCategory::where('status', true)->get();
        return view('backend::configuration.faq.index', compact(['faqs', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Faq();
        return view('backend::configuration.faq.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $faq = new Faq();

        $faq->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        // $faq->order_by = !empty($request->order_by) ? $request->order_by : NULL;
        $faq->question = !empty($request->question) ? $request->question : NULL;
        $faq->answer = !empty($request->answer) ? $request->answer : NULL;

        $order_by = Faq::max('order_by');
        $faq->order_by = ($order_by + 1);

        if ($faq->save()) {
            return redirect()->route('configuration.faq.index')->with('success', 'FAQ successfully added.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = Faq::findOrFail($id);
        return view('backend::configuration.faq.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $faq->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        // $faq->order_by = !empty($request->order_by) ? $request->order_by : NULL;
        $faq->question = !empty($request->question) ? $request->question : NULL;
        $faq->answer = !empty($request->answer) ? $request->answer : NULL;
        $faq->status = !empty($request->status) ? $request->status : 0;
        if ($faq->save()) {
            return redirect()->route('configuration.faq.index')->with('success', 'FAQ Updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('configuration.faq.index')->with('success', 'FAQ Deleted successfully.');
    }
}

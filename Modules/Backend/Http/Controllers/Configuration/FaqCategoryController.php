<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Models\Backend\Configuration\FaqCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\FaqCategoryStoreRequest;
use Modules\Backend\Http\Requests\Configuration\FaqCategoryUpdateRequest;

class FaqCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $faqcategories = FaqCategory::orderBy('id', 'DESC')->paginate($this->pageSize);

        return view('backend::configuration.faq-category.index',compact('faqcategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new FaqCategory();

        return view('backend::configuration.faq-category.create',compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(FaqCategoryStoreRequest $request)
    {
        $faqcategory = new FaqCategory();

        $faqcategory->faq_category = !empty($request->faq_category) ? $request->faq_category : NULL;
        if ($faqcategory->save()) {
            return redirect()->route('configuration.faqcategory.index')->with('success', 'Faq Category successfully added.');
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
        $model = FaqCategory::findOrFail($id);

        return view('backend::configuration.faq-category.edit',compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(FaqCategoryUpdateRequest $request, $id)
    {
        $faqcategory = FaqCategory::findOrFail($id);

        $faqcategory->faq_category = !empty($request->faq_category) ? $request->faq_category : NULL;
        $faqcategory->status = !empty($request->status) ? $request->status : 0;
        if ($faqcategory->save()) {
            return redirect()->route('configuration.faqcategory.index')->with('success', 'Faq Category Updated successfully.');
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
        $faqcategory = FaqCategory::findOrFail($id);
        $faqcategory->forcedelete();
        return redirect()->route('configuration.faqcategory.index', compact(['faqcategory']))->with('success', 'Faq Category deleted successfully.');
    }
}

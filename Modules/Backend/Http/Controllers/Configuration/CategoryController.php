<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Backend\Configuration\Category;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\CategoryStoreRequest;
use Modules\Backend\Http\Requests\Configuration\CategoryUpdateRequest;

class CategoryController extends BaseController
{

    private $image_dir = 'images/configuration/category';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $examscategory = Category::filter($request->all())->orderBy('id', 'DESC')->paginate($this->pageSize)->withQueryString();
        return view('backend::configuration.category.index', compact(['examscategory', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Category();
        return view('backend::configuration.category.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryStoreRequest $request
     * @return Renderable
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();

        if (!empty($request->file('icon'))) {
            $filename = 'category_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $category->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }
        if (!empty($request->file('banner'))) {
            $filename = 'banner_' . date('dmyHis') . '.' . $request->banner->getClientOriginalExtension();
            $category->banner =  $this->fileupload($this->image_dir, $request->banner, $filename);
        }

        if (!empty($request->file('mobile_dashboard_banner'))) {
            $filename = 'mobile_dashboard_banner_' . date('dmyHis') . '.' . $request->mobile_dashboard_banner->getClientOriginalExtension();
            $category->mobile_dashboard_banner =  $this->fileupload($this->image_dir, $request->mobile_dashboard_banner, $filename);
        }

        if (!empty($request->file('mobile_category_page_banner'))) {
            $filename = 'mobile_category_page_banner_' . date('dmyHis') . '.' . $request->mobile_category_page_banner->getClientOriginalExtension();
            $category->mobile_category_page_banner =  $this->fileupload($this->image_dir, $request->mobile_category_page_banner, $filename);
        }

        $category->name = !empty($request->name) ? $request->name : NULL;
        $category->is_show_homepage = isset($request->is_show_homepage) ? $request->is_show_homepage : 1;
        $category->booking_fees = !empty($request->booking_fees) ? $request->booking_fees : 0;
        $category->tax_id = !empty($request->tax_id) ? $request->tax_id : 0;
        $category->tax_type_id = !empty($request->tax_type_id) ? $request->tax_type_id : 0;
        $category->sac_code_id = !empty($request->sac_code_id) ? $request->sac_code_id : 0;
        $category->billing_account_id = !empty($request->billing_account_id) ? $request->billing_account_id : 0;
        $category->teasure_line = !empty($request->teasure_line) ? $request->teasure_line : NULL;
        $category->description = !empty($request->description) ? $request->description : NULL;
        if ($category->save()) {
            return redirect()->route('configuration.category.index')->with('success', 'Exam Category successfully added.');
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
        $model = Category::findOrFail($id);
        return view('backend::configuration.category.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if (!empty($request->file('icon'))) {
            $icon               = $request->file('icon');
            $icon               = $request->icon->store($this->image_dir, ['disk' => 'public']);
            $category->icon     = $icon;
        }
        if (!empty($request->file('banner'))) {
            $banner  = $request->file('banner');
            $banner  = $request->banner->store($this->image_dir, ['disk' => 'public']);
            $category->banner = $banner;
        }

        if (!empty($request->file('mobile_dashboard_banner'))) {
            $filename = 'mobile_dashboard_banner_' . date('dmyHis') . '.' . $request->mobile_dashboard_banner->getClientOriginalExtension();
            $this->deleteFromStorage($category->mobile_dashboard_banner);
            $category->mobile_dashboard_banner =  $this->fileupload($this->image_dir, $request->mobile_dashboard_banner, $filename);
        }

        if (!empty($request->file('mobile_category_page_banner'))) {
            $filename = 'mobile_category_page_banner_' . date('dmyHis') . '.' . $request->mobile_category_page_banner->getClientOriginalExtension();
            $this->deleteFromStorage($category->mobile_category_page_banner);
            $category->mobile_category_page_banner =  $this->fileupload($this->image_dir, $request->mobile_category_page_banner, $filename);
        }

        $category->name = !empty($request->name) ? $request->name : NULL;
        $category->is_show_homepage = isset($request->is_show_homepage) ? $request->is_show_homepage : 1;
        $category->booking_fees = !empty($request->booking_fees) ? $request->booking_fees : 0;
        $category->tax_id = !empty($request->tax_id) ? $request->tax_id : 0;
        $category->tax_type_id = !empty($request->tax_type_id) ? $request->tax_type_id : 0;
        $category->sac_code_id = !empty($request->sac_code_id) ? $request->sac_code_id : 0;
        $category->billing_account_id = !empty($request->billing_account_id) ? $request->billing_account_id : 0;
        $category->teasure_line = !empty($request->teasure_line) ? $request->teasure_line : NULL;
        $category->description = !empty($request->description) ? $request->description : NULL;
        $category->status = !empty($request->status) ? $request->status : 0;
        if ($category->save()) {
            return redirect()->route('configuration.category.index')->with('success', 'Exam Category Updated successfully added.');
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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('configuration.category.index', compact(['category']));
    }
}

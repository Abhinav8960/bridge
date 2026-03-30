<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\Backend\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Requests\CategoryStoreRequest;

use App\Helpers\{Helper,LocationHelper};
class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $category = Category::withCount('blogCategories')->get();
        // dd ('xfcgtvbhikl');
        return view('backend::category.index',compact('category') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Category();

       $category = Category::where('parent_id',0)->orWhere('parent_id', null)->get();
    //    $categories = Category::where('parent_id', '=', 0)->get();
    //    $allCategories = Category::pluck('name','id')->all();
         return view('backend::category.create',compact('model','category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();
        $category->name = !empty($request->name) ? $request->name : NULL;
        //$category->slug = !empty($request->slug) ? $request->slug : NULL;
        $category->	parent_id= !empty($request->parent_id) ? $request->	parent_id :NULL ;
        $category->description = !empty($request->description) ? $request->description : NULL;
        $category->is_category_color = ($request->is_category_color == 'on') ? true: false;
        $category->category_color = !empty($request->category_color) ? $request->category_color : NULL;
       // $category->status = !empty($request->status) ? $request->status : 0;

        if ($category->save()) {
            return redirect()->route('blog.category.index')->with('success', 'Category Added successfully.');
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
        $model = Category::findOrfail ($id);


        return view('backend::category.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);

        $category->name = !empty($request->name) ? $request->name : NULL;
        $category->slug = !empty($request->slug) ? $request->slug : NULL;
        $category->	parent_id= !empty($request->parent_id) ? $request->	parent_id :NULL ;
        $category->description = !empty($request->description) ? $request->description : NULL;
        $category->status = !empty($request->status) ? $request->status : 0;
        $category->is_category_color = ($request->is_category_color == 'on') ? true: false;
        $category->category_color = !empty($request->category_color) ? $request->category_color : NULL;

        if ($category->save()) {
            return redirect()->route('blog.category.index')->with('success', 'Category Updated successfully.');
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
        return redirect()->route('blog.category.index', compact('category'));
    }
    public function publish($id)
    {
        $model = Category::find($id);
        if ($model->status == true) {
            $model->status = false;
        } else {
            $model->status = true;
        }
        $model->update();
        // flash('Updated Successfully')->success();
        return redirect()->back();
    }
}

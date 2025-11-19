<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\StreamStoreRequest;
use Modules\Backend\Http\Requests\Configuration\StreamUpdateRequest;

class StreamController extends BaseController
{

    private $image_dir = 'images/configuration/stream';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $examsstream = Stream::filter($request->all())->orderBy('id', 'DESC')->paginate($this->pageSize)->withQueryString();;
        $category = Category::where('status', '1')->get();
        return view('backend::configuration.stream.index', compact(['examsstream', 'category', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Stream();

        return view('backend::configuration.stream.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param StreamStoreRequest $request
     * @return Renderable
     */
    public function store(StreamStoreRequest $request)
    {
        $examstream = new Stream();

        if (!empty($request->file('icon'))) {
            $filename = 'examstream_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $examstream->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }
        if (!empty($request->file('icon_hover'))) {
            $filename = 'examstream-hover_' . date('dmyHis') . '.' . $request->icon_hover->getClientOriginalExtension();
            $examstream->icon_hover =  $this->fileupload($this->image_dir, $request->icon_hover, $filename);
        }

        $examstream->name = !empty($request->name) ? $request->name : NULL;
        $examstream->priority = !empty($request->priority) ? $request->priority : 0;
        $examstream->is_show_homepage = isset($request->is_show_homepage) ? $request->is_show_homepage : 1;
        $examstream->is_show_categorypage = isset($request->is_show_categorypage) ? $request->is_show_categorypage : 1;
        $examstream->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        if ($examstream->save()) {
            return redirect()->route('configuration.stream.index')->with('success', 'Exam Stream successfully added.');
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
        $model = Stream::findOrFail($id);
        $category = Category::where('status', '1')->get();
        return view('backend::configuration.stream.edit', compact(['model', 'category']));
    }

    /**
     * Update the specified resource in storage.
     * @param StreamUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(StreamUpdateRequest $request, $id)
    {
        $examstream = Stream::findOrFail($id);

        if (!empty($request->file('icon'))) {
            $filename = 'examstream_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $this->deleteFromStorage($examstream->icon);
            $examstream->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }
        if (!empty($request->file('icon_hover'))) {
            $filename = 'examstream-hover_' . date('dmyHis') . '.' . $request->icon_hover->getClientOriginalExtension();
            $this->deleteFromStorage($examstream->icon_hover);
            $examstream->icon_hover =  $this->fileupload($this->image_dir, $request->icon_hover, $filename);
        }

        $examstream->name = !empty($request->name) ? $request->name : NULL;
        $examstream->is_show_homepage = isset($request->is_show_homepage) ? $request->is_show_homepage : 1;
        $examstream->is_show_categorypage = isset($request->is_show_categorypage) ? $request->is_show_categorypage : 1;
        $examstream->priority = !empty($request->priority) ? $request->priority : 0;
        $examstream->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        $examstream->status = !empty($request->status) ? $request->status : 0;
        if ($examstream->save()) {
            return redirect()->route('configuration.stream.index')->with('success', 'Exam Stream Updated successfully.');
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
        $examstream = Stream::findOrFail($id);
        $this->deleteFromStorage($examstream->icon);
        $this->deleteFromStorage($examstream->icon_hover);
        $examstream->delete();
        return redirect()->route('configuration.stream.index', compact(['examstream']));
    }
}

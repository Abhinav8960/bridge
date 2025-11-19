<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\Backend\BlogComment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request )
    {
      // dd ($request->all());
        // $comment = BlogComment::all ();
        // return view('backend::comment.index',compact('comment'));

       // return view('backend::index');
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // echo "hiiiii";
        // die ();
        $model = new BlogComment();
        return view('backend::comment.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $comment = BlogComment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }
    public function publish(Request $request, $id)
    {
        $model = BlogComment::find($id);
       $model->is_approved = $request->is_approved;
        $model->update();
        return redirect()->back();
    }

        public function approvalqueue(Request $request){
            $blogcomment = BlogComment::filter($request->all())->where('is_approved','!=',BlogComment::APPROVED)->orderBy('id', 'DESC')->get();

            return view('backend::comment.approvalqueue',compact('blogcomment','request'));
        }
}

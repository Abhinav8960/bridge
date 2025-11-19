<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\Backend\Spotlite;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SpotliteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // dd("sdsd");
        $spotlites  = Spotlite::all();
        return view('backend::spotlite.index', compact('spotlites'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('backend::spotlite.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'institute_name' => 'required|string',
            'location'       => 'required|string',
            'establish_year' => 'required|string',
            'batch_training' => 'required|string',
            'virtual_classroom' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',

        ]);

        $spotlite = new Spotlite();

        $spotlite->institute_name = $request->input('institute_name');
        $spotlite->location = $request->input('location');
        $spotlite->establish_year = $request->input('establish_year');
        $spotlite->batch_training = $request->input('batch_training');
        $spotlite->virtual_classroom = $request->input('virtual_classroom');
        $spotlite->description = $request->input('description');
        $spotlite->institute_url = $request->input('institute_url');
        $spotlite->dyntube_project_id = $request->input('dyntube_project_id');
        $spotlite->dyntube_video_id = $request->input('dyntube_video_id');

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images/spotlite', 'public');
        //     $spotlite->image = $imagePath;
        // }

        $spotlite->save();
        return redirect()->route('spotlites.index')->with('success', 'Spotlite created successfully.');
    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $spotlite = Spotlite::findOrFail($id); // Fetch the spotlite data by id

        return view('backend::spotlite.edit', compact('spotlite')); // Pass data to the edit view
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'institute_name' => 'required|string',
            'location'       => 'required|string',
            'establish_year' => 'required|string',
            'batch_training' => 'required|string',
            'virtual_classroom' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ]);

        $spotlite = Spotlite::findOrFail($id);

        $spotlite->institute_name = $request->input('institute_name');
        $spotlite->location = $request->input('location');
        $spotlite->establish_year = $request->input('establish_year');
        $spotlite->batch_training = $request->input('batch_training');
        $spotlite->virtual_classroom = $request->input('virtual_classroom');
        $spotlite->description = $request->input('description');
        $spotlite->institute_url = $request->input('institute_url');
        $spotlite->dyntube_project_id = $request->input('dyntube_project_id');
        $spotlite->dyntube_video_id = $request->input('dyntube_video_id');
        $spotlite->status = $request->input('status');


        // if ($request->hasFile('image')) {
        //     // Delete the old image if it exists
        //     if ($spotlite->image && \Storage::disk('public')->exists($spotlite->image)) {
        //         \Storage::disk('public')->delete($spotlite->image);
        //     }

        //     // Store the new image
        //     $imagePath = $request->file('image')->store('images/spotlite', 'public');
        //     $spotlite->image = $imagePath;
        // }

        // Save the updated record
        $spotlite->save();

        // Redirect to index with success message
        return redirect()->route('spotlites.index')->with('success', 'Spotlite updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $spotlite = Spotlite::findOrFail($id);
        $spotlite->delete();

        return redirect()->route('spotlites.index')->with('success', 'Spotlite deleted successfully.');
    }

    public function publish($id)
    {
        // $model = Student::find($id);
        // if ($model->status == true) {
        //     $model->status = false;
        // } else {
        //     $model->status = true;
        // }
        // $model->update();
        // return redirect()->back();
    }
}

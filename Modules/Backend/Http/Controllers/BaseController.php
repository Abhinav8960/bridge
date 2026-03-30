<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public $pageSize;
    
    public function __construct(Request $request)
    {
        $this->pageSize = !empty($request->pagesize) ? $request->pagesize : 10;
    }

    public function fileupload($dir, $file, $filename)
    {
        // dd($dir,
        // $file,
        //  $filename);
        return $file->storeAs($dir, $filename, ['disk' => 'public']);
    }

    public function deleteFromStorage($path)
    {

        if (!empty($path)) {

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        return;
    }
}

<?php

namespace Modules\Institute\Http\Controllers;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->pageSize = !empty(request()->pagesize) ? request()->pagesize : 10;
        $this->request = request();
    }

    public function institute()
    {
        return Institute::where('user_id', Auth::user()->id)->firstOrFail();
    }

    public function fileupload($dir, $file)
    {
        return $file->store($dir, ['disk' => 'public']);
    }


    public function category()
    {

        return Category::where('status', '1')->get();
    }

    public function streams()
    {
        if (!empty($this->request->category)) {
            return Stream::where('category_id', $this->request->category)->where('status', true)->get();
        }
        return Stream::where('status', true)->get();
    }

    public function exams()
    {
        if (!empty($this->request->stream)) {
            return Exam::where('stream_id', $this->request->stream)->where('status', '1')->get();
        }
        return Exam::where('status', true)->get();
    }

    public function deleteFromStorage($filepath)
    {

        if (!empty($filepath)) {
            if (Storage::disk('public')->exists($filepath)) {
                Storage::disk('public')->delete($filepath);
            }
        }
        return;
    }
}

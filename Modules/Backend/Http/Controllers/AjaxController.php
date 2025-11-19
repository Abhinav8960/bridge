<?php

namespace Modules\Backend\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\LocationHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class  AjaxController  extends Controller
{
    public function fetchCategory()
    {
        $data = Helper::fetchCategory();

        return response()->json($data);
    }

    public function fetchStream(Request $request)
    {

        $data = Helper::fetchStream($request->category_id);

        return response()->json($data);
    }

    public function fetchExam(Request $request)
    {
        $data = Helper::fetchExam($request);

        return response()->json($data);
    }

    public function fetchCity($state)
    {
        $data = LocationHelper::getAllCities($state)->response;
        return response()->json($data);
    }

    public function fetchAllArea($state, $city)
    {
        $data = LocationHelper::postAllArea($state, $city)->response;
        return response()->json($data);
    }
}

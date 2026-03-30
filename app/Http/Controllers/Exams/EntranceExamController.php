<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class EntranceExamController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $category = Category::where('id', Category::CATEGOEY_ENTRANCE)->first();
        // $ins =  Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('instituteexam', function ($query) {
        //     $query->where('category_id', Category::CATEGOEY_ENTRANCE)->distinct();
        // })->get();

        $ins =  Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('streamexam', function ($query) {
            $query->where('category_id', Category::CATEGOEY_ENTRANCE)->distinct();
        })->get();
        $instituteCategoryWise = $ins->count();
        
        $institutes = Institute::where('is_plan_expired', false)->where('status', true)
            ->withWhereHas('featured.FeturelistCategories', function ($query) {
                $query->where('category_id', Category::CATEGOEY_ENTRANCE)->distinct();
            })->withWhereHas('featured', function ($query) {
                $query->where('isCategory', true);
            })->get();

        $streamstobeshown = Stream::where('category_id', $category->id)->where('status', true)->where('is_show_homepage', true)->get();


        $desktop = $agent->isDesktop();
        if ($desktop) {
            return view('page.exams.entrance', compact('category', 'instituteCategoryWise', 'institutes', 'streamstobeshown'));
        }
        return view('page.mobile.exams.entrance', compact('category', 'instituteCategoryWise', 'institutes', 'streamstobeshown'));
    }
}

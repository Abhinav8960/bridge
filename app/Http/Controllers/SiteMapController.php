<?php

namespace App\Http\Controllers;

use App\Models\Backend\Blog;
use App\Models\Backend\Category;
use App\Models\Backend\Configuration\Category as ConfigurationCategory;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteMapController extends Controller
{
    public function siteMap()
    {
        return response()->view('sitemap.sitemap')->header('Content-Type', 'text/xml');
    }
    public function sitemapStatic()
    {
        return response()->view('sitemap.sitemapStatic')->header('Content-Type', 'text/xml');
    }

    public function sitemapLocations()
    {

        $institutesStateWises  =  Institute::select('state_id', 'state_name', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id')
            ->get();

        $institutesStateCityWises  = Institute::select('state_id', 'city_id', 'state_name', 'city_name', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id', 'city_id')
            ->get();

        $institutesStateCityAreaWises  = Institute::select('state_id', 'city_id', 'area_id', 'state_name', 'city_name', 'area', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id', 'city_id', 'area_id')
            ->get();


        return response()->view('sitemap.sitemap-locations', compact('institutesStateWises', 'institutesStateCityWises', 'institutesStateCityAreaWises'))->header('Content-Type', 'text/xml');
    }


    public function sitemapLocationWiseCategory()
    {
        $exams = ConfigurationCategory::with('instituteExams')
            ->select('id', 'name')
            ->where('status', 1)
            ->get();
        $institutesStateWises  =  Institute::select('state_id', 'state_name', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id')
            ->get();
        $institutesStateCityWises  = Institute::select('state_id', 'city_id', 'state_name', 'city_name', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id', 'city_id')
            ->get();
        return response()->view('sitemap.sitemap-locationwise-category', compact('exams', 'institutesStateWises', 'institutesStateCityWises'))->header('Content-Type', 'text/xml');
    }

    public function sitemapLocationWiseCategoryWiseStream()
    {
        $exams = ConfigurationCategory::with('instituteExams')
            ->select('id', 'name')
            ->where('status', 1)
            ->get();
        $exam_stream = Stream::with('category')
            ->where('status', 1)
            ->get();
        $institutesStateWises  =  Institute::select('state_id', 'state_name', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id')
            ->get();
        $institutesStateCityWises  = Institute::select('state_id', 'city_id', 'state_name', 'city_name', DB::raw('COUNT(*) as total'))
            ->where('status', 1)
            ->groupBy('state_id', 'city_id')
            ->get();
        return response()->view('sitemap.sitemap-locationwise-categorywise-stream', compact('exams', 'institutesStateWises', 'institutesStateCityWises','exam_stream'))->header('Content-Type', 'text/xml');
    }

    // blog
    public function sitemapBlog()
    {
        $categories  = Category::withCount('blogCategories')->where('status', true)->get();
        $blogs = Blog::orderBy('updated_at', 'DESC')->where('status', true)->get();
        $archives  = Blog::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))->where('status', true)
            ->get();;

        return response()->view('sitemap.sitemap-blog', compact('blogs', 'categories', 'archives'))->header('Content-Type', 'text/xml');
    }
}

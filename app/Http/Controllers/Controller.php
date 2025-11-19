<?php

namespace App\Http\Controllers;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Backend\InstituteLeaderborad;
use App\Models\Popularsearches;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function __construct()
    {
        $searches =  Popularsearches::where('rcategory', $this->rcategory())->where('rstream', $this->rstream())->where('rexam', $this->rexam())->where('rcity', $this->rcity())->where('rarea', $this->rarea())->first();
        if (!empty($searches)) {
            $searches->count = $searches->count + 1;
            $searches->save();
        } else {
            $searches = new Popularsearches();
            $searches->rcategory = $this->rcategory();
            $searches->rstream = $this->rstream();
            $searches->rexam = $this->rexam();
            $searches->rstate =  $this->rstate();
            $searches->rcity =  $this->rcity();
            $searches->rarea =  $this->rarea();
            $searches->slug =  $this->seourl();
            $searches->search = str_replace('-', ' ', $this->seourldb());
            $searches->count = 1;
            $searches->save();
        }

        View::share('rcategory', $this->rcategory());
        View::share('rstream', $this->rstream());
        View::share('rexam', $this->rexam());
        View::share('rstate', $this->rstate());
        View::share('rcity', $this->rcity());
        View::share('rarea', $this->rarea());
        // View::share('rnearme', $this->nearme());
        View::share('rseoprefix', $this->rseoprefix());
        View::share('rseourl', $this->seourl());
        View::share('leaderbaord', $this->leaderbaord());
        View::share('entrance', $this->entrance());
        View::share('government', $this->government());
        View::share('foreign', $this->foreign());


    }


    private function rcategory()
    {
        // dd($this->app->request->server->all()['REQUEST_URI']);
        return request()->rcategory ? request()->rcategory : 0;
    }

    private function rstream()
    {
        return request()->rstream ? request()->rstream : 0;
    }

    private function rexam()
    {
        return request()->rexam ? request()->rexam : 0;
    }

    // private function rcountry()
    // {
    //     return request()->rcountry ? request()->rcountry : 1;
    // }

    private function rstate()
    {
        return request()->rstate ? request()->rstate : 0;
    }

    private function rcity()
    {
        return request()->rcity ? request()->rcity : 0;
    }

    private function rarea()
    {
        return request()->rarea ? request()->rarea : 0;
    }

    private function rseoprefix()
    {
        return request()->rseoprefix ? request()->rseoprefix : NULL;
    }

    private function rcountry()
    {
        return request()->rcountry ? request()->rcountry : 1;
    }



    private function seourl()
    {
        // return \App\Helpers\Helper::SeoUrl(['category' => $this->category(), 'stream' => $this->stream(), 'exam' => $this->exam(), 'state' => $this->state(), 'city' => $this->city(), 'area' => $this->area(), 'nearme' => $this->nearme()]);
        return \App\Helpers\Helper::SeoUrl(['category' => $this->rcategory(), 'stream' => $this->rstream(), 'exam' => $this->rexam(), 'state' => $this->rstate(), 'city' => $this->rcity(), 'area' => $this->rarea()]);
    }
    private function seourldb()
    {
        // return \App\Helpers\Helper::SeoUrl(['category' => $this->category(), 'stream' => $this->stream(), 'exam' => $this->exam(), 'state' => $this->state(), 'city' => $this->city(), 'area' => $this->area(), 'nearme' => $this->nearme()]);
        return \App\Helpers\Helper::SeoUrldb(['category' => $this->rcategory(), 'stream' => $this->rstream(), 'exam' => $this->rexam(), 'state' => $this->rstate(), 'city' => $this->rcity(), 'area' => $this->rarea()]);
    }

    private function leaderbaord()
    {
        $leaderbaord = "/assets/skoodos/assets/img/defaultImages/Search_Leaderboard.jpg";
        $lb = NULL;
        if ($this->rstate() > 0) {
            $lb =  InstituteLeaderborad::whereHas('LeaderbaordCities', function ($q) {
                $q->where('state_id', $this->rstate());
            })->get();

        }elseif ($this->rcity() > 0) {
            $lb =  InstituteLeaderborad::whereHas('LeaderbaordCities', function ($q) {
                $q->where('city_id', $this->rcity());
            })->get();
        }else {
            $lb =  InstituteLeaderborad::where('isAllIndia', true)->get();

        }
        if (!empty($lb) && $lb->count() > 0) {
            $lb =   $lb->random(1)->first();
        } else {
            $lb = NULL;
        }
        if (!empty($lb) && $lb->count() > 0) {
            return  Storage::url($lb->file_path);
        }
        return $leaderbaord;
    }

    public function entrance()
    {
        // return $entrance  = Stream::where('status', true)->where('category_id', Category::CATEGOEY_ENTRANCE)->get();
        return $entrance = Stream::where('status', true)->where('category_id', Category::CATEGOEY_ENTRANCE)
        ->whereHas('institutestream', function ($query) {
            $query->whereHas('institute', function ($q) {
                $q->where('status', true)->where('is_plan_expired', false);
            });
        })
        ->get();

    }
    public function government()
    {
        return $government = Stream::where('status', true)->where('category_id', Category::CATEGOEY_GOVERMENT)
        ->whereHas('institutestream', function ($query) {
            $query->whereHas('institute', function ($q) {
                $q->where('status', true)->where('is_plan_expired', false);
            });
        })
        ->get();

    }

    public function foreign()
    {
        return $foreign = Stream::where('status', true)->where('category_id', Category::CATEGOEY_FOREIGN)
        ->whereHas('institutestream', function ($query) {
            $query->whereHas('institute', function ($q) {
                $q->where('status', true)->where('is_plan_expired', false);
            });
        })
        ->get();

    }
}

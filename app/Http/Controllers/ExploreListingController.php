<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ExploreListingController extends Controller
{
    public function explorepage()
    {

        $agent = new Agent();

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
            return view('page.mobile.explore-listing');
        }

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.explore-listing');
        }

        // $tabletResult = $agent->isTablet();
        // if ($tabletResult) {
        //     return view('page.explore-listing');
        // }

        // $tabletResult = $agent->isPhone();
        // if ($tabletResult) {
        //     return view('page.mobile.explore-listing');
        // }
        // return view('page.explore-listing');
    }
    public function india()
    {

        $agent = new Agent();

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
            return view('page.mobile.explore-institute-listing');
        }

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.explore-listing');
        }

        // $tabletResult = $agent->isTablet();
        // if ($tabletResult) {
        //     return view('page.explore-listing');
        // }

        // $tabletResult = $agent->isPhone();
        // if ($tabletResult) {
        //     return view('page.mobile.explore-listing');
        // }
        // return view('page.explore-listing');
    }

    public function explore()
    {
        $agent = new Agent();

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
            return view('page.mobile.explore-institute-listing');
        }

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            return view('page.explore-listing');
        }

        // $tabletResult = $agent->isTablet();
        // if ($tabletResult) {
        //     return view('page.explore-listing');
        // }

        // $tabletResult = $agent->isPhone();
        // if ($tabletResult) {
        //     return view('page.mobile.explore-listing');
        // }
        // return view('page.explore-listing');
    }

    public function nearme()
    {
        if (empty(session()->get('longitude')) && empty(session()->get('latitude'))) {
            return  redirect()->back();
        }
        return view('page.explore-listing');
    }
}

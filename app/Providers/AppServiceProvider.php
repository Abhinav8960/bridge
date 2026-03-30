<?php

namespace App\Providers;

use App\Models\Backend\Configuration\Category;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();


        Blade::if('IsIntitutesuspended', function () {
            if (Session::has('institute.id')) {

                return Institute::where('id', Session::get('institute.id'))->where('status', false)->first();
            }
            return false;
        });

        Blade::if('IsIntituteexpire', function () {
            if (Session::has('institute.id')) {

                return Institute::where('id', Session::get('institute.id'))->where('is_plan_expired', true)->first();
            }
            return false;
        });

        Blade::if('isTabAccessable', function ($tab) {

            $institute =  Institute::where('id', Session::get('institute.id'))->first();
            return $institute->package->$tab;
        });

        Blade::if('isRoles', function ($roles) {


            foreach ($roles as $role) {

                if (Auth::user()->role_id == $role) {
                    return true;
                }
            }

            return false;
        });


        Blade::if('isForeignExam', function () {
            $foreign = Category::where('status', false)->where('id', Category::CATEGOEY_FOREIGN)->get();
            if ($foreign->count() == 1) {
                return false;
            } else {
                return true;
            }
        });

        Blade::if('isGovernmentExam', function () {
            $gov = Category::where('status', false)->where('id', Category::CATEGOEY_GOVERMENT)->get();
            if ($gov->count() == 1) {
                return false;
            } else {
                return true;
            }
        });

        Blade::if('isEntranceExam', function () {
            $entrance = Category::where('status', false)->where('id', Category::CATEGOEY_ENTRANCE)->get();
            if ($entrance->count() == 1) {
                return false;
            } else {
                return true;
            }
        });



    }
}

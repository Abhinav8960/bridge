<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\PopularCity;
use App\Models\Institute;
use App\Models\Institute\Information\General;
use App\Models\Institute\Information\Uploads;
use App\Models\InstituteReview;
use Illuminate\Http\Request;

class FeaturedStateCityController extends Controller
{

    public function stateCityGet(Request $request)
    {
        $authorizedToken = "$93OAAwwpUduqZOpoqMUfOeUduqZOpoqMknCC$841";
        $authToken = $request->header('Authorization');
        $expectedToken = "Bearer " . $authorizedToken;

        if ($authToken !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($expectedToken == $authToken) {
            $stateCitydata = PopularCity::where('status', true)->where('is_featured', 1)
                ->select('state_name', 'state_id', 'city_name', 'city_id')->get();
            if ($stateCitydata->isEmpty()) {
                return response()->json(['status' => 'No state city Found...'], 404);
            }

            return response()->json($stateCitydata);
        }
    }


    // public function getInstituteFeaturedCitiesWise(Request $request, $cityId)
    // {
    //     $authorizedToken = "$93OAAwwpUduqZOpoqMUfOeUduqZOpoqMknCC$841";
    //     $authToken = $request->header('Authorization');
    //     $expectedToken = "Bearer " . $authorizedToken;

    //     if ($authToken !== $expectedToken) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $institutesDetails = [];
    //     if ($expectedToken == $authToken) {

    //         $institutes = Institute::where('city_id', $cityId)
    //             ->where('status', true)
    //             ->select('id', 'name', 'city_name', 'state_name', 'area')
    //             ->inRandomOrder()
    //             ->limit(6)
    //             ->get();

    //         if ($institutes->isEmpty()) {
    //             return response()->json(['status' => 'No Institute Found...'], 404);
    //         }

    //         $institutesDetails = $institutes->map(function ($institute) {
    //             $instituteImage = Uploads::where('institute_id', $institute->id)
    //                 ->select('logo')
    //                 ->first();

    //             $averageRating = InstituteReview::where('institute_id', $institute->id)
    //                 ->avg('average_rating');

    //             $institute->logo = $instituteImage ? $instituteImage->logo : 'No Image Found...';

    //             $institute->average_rating = $averageRating ?: 0;
    //             return $institute;
    //         });

    //         return response()->json($institutesDetails);
    //     }
    // }

    public function getInstituteFeaturedCitiesWise(Request $request, $cityId)
    {
        $authorizedToken = "$93OAAwwpUduqZOpoqMUfOeUduqZOpoqMknCC$841";
        $authToken = $request->header('Authorization');
        $expectedToken = "Bearer " . $authorizedToken;

        if ($authToken !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($expectedToken == $authToken) {
            $appUrl = config('app.url');

            $institutes = Institute::where('city_id', $cityId)
                ->where('status', true)
                ->select('id',  'name', 'city_name', 'state_name', 'area','slug')
                ->inRandomOrder()
                ->limit(3)
                ->get();

            if ($institutes->isEmpty()) {
                return response()->json(['status' => 'No Institute Found...'], 404);
            }

            $institutesDetails = $institutes->map(function ($institute) use ($appUrl) {
                $instituteImage = Uploads::where('institute_id', $institute->id)
                    ->select('logo')
                    ->first();

                $averageRating = InstituteReview::where('institute_id', $institute->id)
                    ->avg('average_rating');

                $institute->logo = $instituteImage ? $instituteImage->logo : "No Image Found...";
                $institute->average_rating = $averageRating ?: 0;
                $institute->url = $appUrl . '/coaching/' . $institute->slug;

                return $institute;
            });

            return response()->json($institutesDetails);
        }
    }
}

<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class LocationHelper
{

    // dd(LocationHelper::getAllCountries());
    // dd(LocationHelper::getAllState(1));
    // dd(LocationHelper::getAllCities(32));
    // dd(LocationHelper::postArea(25, 116, 'vik'));
    // dd(LocationHelper::postNewArea(25, 116, 'vik', 110091));

    const RESPONSE_STATUS_SUCCESS = 'success';
    const RESPONSE_STATUS_ERROR = 'error';
    const AUTHORIZATION_CODE = 'fc9f4a47-4f7f-41ba-a656-d30e0009d6f0';
    const GET_ALL_COUNTRIES_API_URL = 'http://app.spherionsolutions.com/public/api/get_all_countries'; // eg: URL: http://app.spherionsolutions.com/public/api/get_all_countries
    const GET_ALL_STATE_COUNTRY_WISE_API_URL = 'http://app.spherionsolutions.com/public/api/get_all_states';  // eg: URL: http://app.spherionsolutions.com/public/api/get_all_states/1
    const GET_CITIES_STATE_WISE_API_URL = 'http://app.spherionsolutions.com/public/api/get_citites'; //eg: http://app.spherionsolutions.com/public/api/get_citites/25
    const POST_AREA_BY_STATE_AND_CITY_API_URL = 'http://app.spherionsolutions.com/public/api/get_areas'; // eg: https://app.spherionsolutions.com/public/api/get_areas
    const POST_NEW_AREA_AND_PIN_CODE_API_URL = 'http://app.spherionsolutions.com/public/api/post_area_pincode'; // eg: https://app.spherionsolutions.com/public/api/post_area_pincode
    const POST_ALL_CITY_WITHOUT_STATE_API_URL = 'http://app.spherionsolutions.com/public/api/get_city_search'; // eg: https://app.spherionsolutions.com/public/api/post_area_pincode
    const COUNTRY_CODE_AL = "IN";
    const COUNTRY_CODE = 1;


    //     // Determine if the status code is >= 200 and < 300...
    //     // $response->successful();

    //     // // Determine if the status code is >= 400...
    //     // $response->failed();

    //     // // Determine if the response has a 400 level status code...
    //     // $response->clientError();

    //     // // Determine if the response has a 500 level status code...
    //     // $response->serverError();

    //     // // Immediately execute the given callback if there was a client or server error...
    //     // $response->onError(callable $callback);
    public static function returnResponse($response)
    {
        return $response->object();
    }



    public static function getAllCountries()
    {

        $response = Http::acceptJson()->withHeaders([
            'Authorization' => self::AUTHORIZATION_CODE,
        ])->get(self::GET_ALL_COUNTRIES_API_URL);

        return self::returnResponse($response);
    }


    public static function getAllState()
    {

        $response = Http::acceptJson()->withHeaders([
            'Authorization' => self::AUTHORIZATION_CODE,
        ])->get(self::GET_ALL_STATE_COUNTRY_WISE_API_URL . '/' . self::COUNTRY_CODE);

        return self::returnResponse($response);
    }



    public static function getAllCities($stateId)
    {

        $response = Http::acceptJson()->withHeaders([
            'Authorization' => self::AUTHORIZATION_CODE,
        ])->get(self::GET_CITIES_STATE_WISE_API_URL . '/' . $stateId);

        return self::returnResponse($response);
    }


    public static function getAllCitiesWithoutState($likeCity = NULL)
    {



        if (!empty($likeCity)) {
            $response = Http::acceptJson()->withHeaders([
                'Authorization' => self::AUTHORIZATION_CODE,
            ])->asForm()->post(self::POST_ALL_CITY_WITHOUT_STATE_API_URL, [
                'city' => $likeCity
            ]);
        } else {

            $response = Http::acceptJson()->withHeaders([
                'Authorization' => self::AUTHORIZATION_CODE,
            ])->post(self::POST_ALL_CITY_WITHOUT_STATE_API_URL);
        }
        return self::returnResponse($response);
    }



    public static function postArea($stateId, $cityId, $area)
    {
        $response = Http::asForm()->acceptJson()->withHeaders([
            'Authorization' => self::AUTHORIZATION_CODE,
        ])->post(self::POST_AREA_BY_STATE_AND_CITY_API_URL, [
            'state' => $stateId,
            'city' => $cityId,
            'area' => $area
        ]);
        return self::returnResponse($response);
    }


    public static function postAllArea($stateId, $cityId)
    {
        $response = Http::asForm()->acceptJson()->withHeaders([
            'Authorization' => self::AUTHORIZATION_CODE,
        ])->post(self::POST_AREA_BY_STATE_AND_CITY_API_URL, [
            'state' => $stateId,
            'city' => $cityId,
        ]);
        return self::returnResponse($response);
    }



    public static function postNewArea($stateId, $cityId, $area, $pincode)
    {
        $response = Http::acceptJson()->withHeaders([
            'Authorization' => self::AUTHORIZATION_CODE,
        ])->asForm()->post(self::POST_NEW_AREA_AND_PIN_CODE_API_URL, [
            'state' => $stateId,
            'city' => $cityId,
            'area' => $area,
            'pincode' => $pincode,
            'country' => self::COUNTRY_CODE_AL

        ]);

        return self::returnResponse($response);
    }

    public static function getCountryName($countryId)
    {
        $arr = array_column(self::getAllCountries()->response, "country_name", "id");
        return $arr[$countryId];
    }

    public static function getCountryCode($countryId)
    {
        $arr = array_column(self::getAllCountries()->response, "code", "id");
        return $arr[$countryId];
    }

    public static function getStateName($stateId)
    {
        $arr = array_column(self::getAllState()->response, "state", "id");
        return $arr[$stateId];
    }

    public static function getCityName($stateId, $cityId)
    {

        $arr = array_column(self::getAllCities($stateId)->response, "city", "id");

        return $arr[$cityId];
    }

    public static function getAreaName($stateId, $cityId, $area)
    {
        // dd(array_column(self::postAllArea($stateId, $cityId)->response, "area", "area_id"));
        $arr = array_column(self::postAllArea($stateId, $cityId)->response, "area", "area_id");

        return $arr[$area];
    }

    public static function allCities()
    {
        $city = array_column(self::getAllCitiesWithoutState()->response, "city", "city_id");
        return $city;
    }

    public static function allstateIdwithcityID()
    {
        $city = array_column(self::getAllCitiesWithoutState()->response, "state_id", "city_id");
        return $city;
    }

    public static function getPincode($stateId, $cityId, $area)
    {
        // dd(array_column(self::postAllArea($stateId, $cityId)->response, "area", "area_id"));
        $arr = array_column(self::postAllArea($stateId, $cityId)->response, "pincode", "area_id");
        return $arr[$area];
    }
}

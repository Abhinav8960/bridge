<?php

namespace Modules\Institute\Http\Requests\Information\Center;

use Illuminate\Foundation\Http\FormRequest;

class StoreCenterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];

        $rule["institute_id"] = "integer";
        $rule["center_head"] = "required|string";
        $rule["branch_type"] = "required|integer";
        $rule["google_business_address"] = "required|string";
        // $rule["latitude"] = "string";
        // $rule["longitude"] = "string";
        $rule["address"] = "string";
        $rule["country_id"] = "integer";
        $rule["state_id"] = "required|integer";
        $rule["city_id"] = "required|integer";
        $rule["area"] = "string";
        $rule["pincode"] = "integer";
        $rule["email_1"] = "email";
        $rule["email_2"] = "email";
        $rule["phone_type_1"] = "integer";
        $rule["phone_type_2"] = "integer";
        $rule["phone_number_1"] = "regex:/^([0-9\s\-\+\(\)]*)$/";
        $rule["phone_number_2"] = "regex:/^([0-9\s\-\+\(\)]*)$/";
        // $rule["sunday"] = "boolean";
        // $rule["monday"] = "boolean";
        // $rule["tuesday"] = "boolean";
        // $rule["wednesday"] = "boolean";
        // $rule["thursday"] = "boolean";
        // $rule["friday"] = "boolean";
        // $rule["saturday"] = "boolean";
        // $rule["sunday_open"] = "string";
        // $rule["sunday_close"] = "string";
        // $rule["monday_open"] = "string";
        // $rule["monday_close"] = "string";
        // $rule["tuesday_open"] = "string";
        // $rule["tuesday_close"] = "string";
        // $rule["wednesday_open"] = "string";
        // $rule["wednesday_close"] = "string";
        // $rule["thursday_open"] = "string";
        // $rule["thursday_close"] = "string";
        // $rule["friday_open"] = "string";
        // $rule["friday_close"] = "string";
        // $rule["saturday_open"] = "string";
        // $rule["saturday_close"] = "string";
        // $rule["facebook_url"] = "url";
        // $rule["instagram_url"] = "url";
        // $rule["youtube_url"] = "url";
        // $rule["twitter_url"] = "url";
        // $rule["linkedin_url"] = "url";


        return $rule;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Backend\Packages;
use App\Models\Institute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class InstituteUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        // $institute = Institute::where('email',$request->email)->first();
        $rule = [];
        $rule["name"] = "required|string";
        $rule["authorized_person"] = "required|string";
        $rule["email"] = "required|email";
        $rule["mobile"] = "required|regex:/^([0-9\s\-\+\(\)]*)$/";
        $rule["country_id"] = "required|integer";
        $rule["state_id"] = "required|integer";
        $rule["city_id"] = "required|integer";
        $rule["area"] = "required|string";
        $rule["pincode"] = "required|integer";
        $rule["google_institute_address"] = "required|string";


        $rule["is_recommended"] = "integer";

        

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

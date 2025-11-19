<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Backend\Packages;
use Illuminate\Foundation\Http\FormRequest;

class InstituteStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
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
        $rule["package_id"] = "required|integer";
        $rule["duration"] = "required_unless:package_id,".Packages::STARTER_PACKAGE."|integer";
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

<?php

namespace Modules\Backend\Http\Requests;

use App\Models\Backend\Packages;
use Illuminate\Foundation\Http\FormRequest;

class PackagesStoreRequest extends FormRequest
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
        $rule["no_of_centers"] = "required|integer";
        // $rule["is_course_enrollment"] = "boolean";
        $rule['package_duration_type']           = 'required|in:' . Packages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY . ',' . Packages::PACKAGE_DURATION_TYPE_AS_PER_DURATION . '';
        $rule['no_of_days']                  =  "required_if:package_duration_type," . Packages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY . "|integer";

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

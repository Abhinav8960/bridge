<?php

namespace Modules\Institute\Http\Requests\Information\General;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];

        $rule["user_id"] = "integer";
        $rule["institute_id"] = "integer";
        $rule["description"] = "string";
        $rule["email_1"] = "email";
        $rule["email_2"] = "email";
        $rule["phone_type_1"] = "integer";
        $rule["phone_type_2"] = "integer";
        $rule["phone_number_1"] = "regex:/^([0-9\s\-\+\(\)]*)$/";
        $rule["phone_number_2"] = "regex:/^([0-9\s\-\+\(\)]*)$/";
        $rule["admission_screening"] = "boolean";
        $rule["admission_screening_url"] = "bail|nullable|url";
        $rule["admission_screening_description"] = "bail|nullable|string";
        $rule["admission_screening_image"] = "dimensions:width=770,height=360|mimes:jpeg|max:100";
        $rule["mock_test"] = "boolean";
        $rule["mock_test_url"] = "bail|nullable|url";
        $rule["mock_test_description"] = "bail|nullable|string";
        $rule["mock_test_image"] = "dimensions:width=770,height=360|mimes:jpeg|max:100";
        $rule["founded"] = "string";
        $rule["batch_training"] = "boolean";
        $rule["personalized_training"] = "boolean";
        $rule["virtual_classroom"] = "boolean";
        $rule["doubt_session"] = "boolean";
        $rule["online_test_series"] = "boolean";
        $rule["mentor_session"] = "boolean";
        $rule["choice_of_faculty"] = "boolean";
        $rule["study_material"] = "boolean";
        $rule["resource_library"] = "boolean";
        $rule["performance_assessment"] = "boolean";
        $rule["admission_counselling"] = "boolean";
        $rule["leadership_name"] = "string";
        $rule["leadership_designation"] = "string";
        $rule["leadership_description"] = "string";
        $rule["leadership_image"] = "dimensions:width=300,height=300|mimes:jpeg|max:100";

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

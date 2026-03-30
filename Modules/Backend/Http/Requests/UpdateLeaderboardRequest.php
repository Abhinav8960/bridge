<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaderboardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];
        $rule["institute_id"] = "required|integer";
        // $rule["isAllIndia"] = "boolean";
        $rule["banner"] = "dimensions:width=1550,height=300|mimes:jpeg|max:100";

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

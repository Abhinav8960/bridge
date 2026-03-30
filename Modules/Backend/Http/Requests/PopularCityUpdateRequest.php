<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PopularCityUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];
        $rule["state_id"] = "required|integer";
        $rule["city_id"] = "required|integer";
        // $rule["is_metro"] = "boolean";
        $rule["icon"] = "dimensions:width=270,height=200|mimes:jpeg|max:100";

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

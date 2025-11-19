<?php

namespace Modules\Institute\Http\Requests\Information\Champions;

use Illuminate\Foundation\Http\FormRequest;

class StoreChampionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];

        $rule["exam_category_id"] = "required|integer";
        $rule["exam_stream_id"] = "required|integer";
        $rule["exam_id"] = "required|integer";
        $rule["candidate_name"] = "required|string";
        $rule["rank"] = "required|string";
        $rule["year"] = "required|string";
        // $rule["candidate_image"] = "dimensions:width=300,height=300|mimes:jpeg|max:100";

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

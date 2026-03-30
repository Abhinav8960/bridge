<?php

namespace Modules\Institute\Http\Requests\Information\Alumni;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlumniRequest extends FormRequest
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
        $rule["name"] = "required|string";
        $rule["designation"] = "required|string";
        $rule["company"] = "required|string";
        $rule["profile"] = "required|string";
        $rule["year"] = "required|string";
        $rule["alumni_image"] = "required|dimensions:width=300,height=300|mimes:jpeg|max:100";

        if (!empty($this->profile)) {
            $rule['profile'] = new MaxWordsRule(30);
        }
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

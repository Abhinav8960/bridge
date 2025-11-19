<?php

namespace Modules\Backend\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =[];
        $rule["category_id"] = "required|integer";
        $rule["stream_id"] = "required|integer";
        $rule["name"] = "required|string|max:120";
        $rule["icon"] = "dimensions:width=300,height=200|mimes:jpeg|max:100";
    
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

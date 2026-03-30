<?php

namespace Modules\Backend\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class StreamStoreRequest extends FormRequest
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
        $rule["name"] = "required|string|max:50";
        $rule["fullname"] = "string|max:50";
        $rule["icon"] = "dimensions:width=60,height=60|mimes:png|max:100";
        $rule["icon_hover"] = "dimensions:width=60,height=60|mimes:png|max:100";
    
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

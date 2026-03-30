<?php

namespace Modules\Backend\Http\Requests\Configuration;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class ParameterUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];
        $rule["title"] = "required|string|max:50";

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

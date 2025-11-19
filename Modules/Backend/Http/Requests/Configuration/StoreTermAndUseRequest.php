<?php

namespace Modules\Backend\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class StoreTermAndUseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];

        // $rule['module_sequence']                      = 'required|integer';
        $rule['module_description']                 = 'required|string';
        $rule['module_title']           = 'required|string';
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

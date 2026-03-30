<?php

namespace Modules\Backend\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class CalltoactionUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];
        $rule["call_to_action_type"] = "required|integer";
        // if(request()->call_to_action_type==1){
        //     $rule["specify_value"] = "required|email";
        // }else{
        //     $rule["specify_value"] = "required|integer";
        // }

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

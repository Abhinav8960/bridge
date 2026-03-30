<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        $rule = [];
       
        $rule["name"] = "required|string";
       // $rule["slug"] = "required|string";
        $rule["description"] = "required|string";
        //$rule["parent_id"] = "required|integer";
       
      
        
       

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

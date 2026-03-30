<?php

namespace Modules\Backend\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];
       
        $rule["title"] = "required|string";
        $rule["sub_title"] = "required|string";
        //$rule["description"] = "string";
        $rule["meta_title"] = "required|string";
        $rule["meta_description"] = "required|string";
      // $rule["image"] = "dimensions:width=1080,height=400|mimes:jpeg|max:100";
       //$rule["images"] = "dimensions:width=1080,height=400|mimes:jpeg|max:100";
        // $rule["schedule_date"] = "required|string";
        // $rule["	schedule_time"] = "required|string";
        
       

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

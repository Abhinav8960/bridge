<?php

namespace Modules\Backend\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class FaqCategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =[];
        $rule['faq_category']                  = 'required|string|unique:faq_categories,faq_category,NULL,id,deleted_at,NULL';


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

<?php

namespace Modules\Backend\Http\Requests\Configuration;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FeatureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        $rules = [];

        $rules['name']                  = 'required|string|max:75';
        $rules['field_type']            = 'required|in:' . implode(', ', array_keys(Helper::featutesInputType()));
        $rules['name']                  = 'required|string|max:50';
        if (!empty($this->icon)) {

            $rules['icon']              = 'image|mimes:png|max:100';
        }

        return $rules;
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

<?php

namespace Modules\Backend\Http\Requests\Configuration;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ParameterStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rule = [];
        $rule["title"] = "required|string|max:50";



        // $this->validate($request, $rule, [
        //     $request->description.'required' => 'a description is required',
        //     $request->description.'maxWords' => 'max words reached'
        // ]);
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

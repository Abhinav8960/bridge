<?php

namespace Modules\Backend\Http\Requests\Configuration;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CategoryStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rule = [];
        $rule["name"] = "required|string|max:50";
        // $rule["description"] = "required|string|max:75";
        // $description = $request->description;
        $rule["teasure_line"] = ["required", new MaxWordsRule(10)];
        $rule["description"] = ["required", new MaxWordsRule(75)];
        $rule['booking_fees'] = "required|integer";

        // $rule["description"] = new MaxWordsRule(75);
        // dd(count(explode(' ', $description)));
        $rule["icon"] = "dimensions:width=144,height=144|mimes:jpeg|max:100";
        $rule["banner"] = "dimensions:width=1600,height=325|mimes:jpeg|max:100";
        $rule["mobile_dashboard_banner"] = "dimensions:width=1080,height=400|mimes:png|max:150";
        $rule["mobile_category_page_banner"] = "dimensions:width=1080,height=450|mimes:jpeg|max:100";


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

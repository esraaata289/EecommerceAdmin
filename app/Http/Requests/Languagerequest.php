<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Languagerequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:100',
            'abbr'=>'required|string|max:10',
            //'active'=>'required|in:1',
            'direction'=>'required|in:rtl,ltr',
        ];
    }

    public function messages()
    {
        return[

                'required' =>'this Field Required',
                'string' =>'This Field should be characters',
                'name.max' =>'Language Name should not more than 100 character',
                'abbr.max' =>'Language Name should not more than 10 character',
                'in' =>'values that entered did not correct ',
            ];
    }
}

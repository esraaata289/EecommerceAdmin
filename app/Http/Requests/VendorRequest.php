<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    /**
     * @var mixed
     */
    /**
     * @var mixed
     */



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
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100',
            'mobile' =>'required|max:100|unique:vendors,mobile,'.$this -> id,
            'email'  => 'required|email|unique:vendors,email,'.$this -> id,
            'category_id'  => 'required|exists:main_categories,id',
            'address'   => 'required|string|max:500',
            'password'   => 'required_without:id'
        ];
    }
    public function messages()
    {
        return
        [
            'required' => 'This Field Required',
            'max' => 'This Field so long',
            'string' => 'This Field should be characters',
            'email.email' => 'This Field should be as  email',
            'category_id.exists' => 'This Field not found',
            'logo.required_without' => 'The logo Required',
            'email.unique' => 'This emails is used before',
            'mobile.unique' => 'This mobile number is used before',
        ];

    }
}

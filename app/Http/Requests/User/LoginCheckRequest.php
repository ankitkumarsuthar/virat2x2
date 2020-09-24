<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginCheckRequest extends FormRequest
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
        $rules = [];

         $rules['password']          = [ 'required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/' ];
        $rules['email']             = [ 'required','email' ];
       

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        
        $messages['password.required']          = 'Password is a required field.';
        $messages['password.regex']             = 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123';
        $messages['email.required']             = 'Email is a required field.';
        $messages['email.email']                = 'Invalid Eamil formage.';
        $messages['email.unique']               = 'Duplicate email detected.';

        return $messages;
    }
}

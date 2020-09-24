<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegistrationRequest extends FormRequest
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

        // dd('here', \Request::get('id'));

        $rules['user_name']        = [ 'required' ];
        if(\Request::get('id') != NULL) {
            if(\Request::get('password') != '') {
                $rules['password']          = [ 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/' ];
                // $rules['confirm_password']  = [ 'same:password' ];
            }
        } else {
            $rules['password']          = [ 'required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/' ];
            // $rules['confirm_password']  = [ 'required', 'same:password' ];
        }

        $rules['email']             = [ 'required', 
                                        'email', 
                                        Rule::unique('users')->where(function ($query) {
                                            $query = $query->where('id', '!=', \Request::get('id'));
                                            return $query;
                                        }) 
                                    ];
        // $rules['mobile']             = [  
        //                                 Rule::unique('user_master')->where(function ($query) {
        //                                     $query = $query->where('id', '!=', \Request::get('id'));
        //                                     return $query;
        //                                 }) 
        //                             ];

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        $messages['user_name.required']              = 'Name is a required field.';        
        $messages['password.required']          = 'Password is a required field';
        $messages['password.regex']             = 'Password must contains 8 to 16 characters which have 1 uppercase character, 1 lowercase character, 1 number and 1 special character (#?!@$%^&*-). Example: Sumit@123';
        $messages['email.required']             = 'Email is a required field.';
        $messages['email.email']                = 'Invalid Eamil formage.';
        $messages['email.unique']               = 'Duplicate email detected.';

        return $messages;
    }
}

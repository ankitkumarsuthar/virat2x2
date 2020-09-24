<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        // $rules['first_name']        = [ 'required' ];
        // if(\Request::get('id') != NULL) {
        //     if(\Request::get('password') != '') {
        //         $rules['password']          = [ 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/' ];
        //         // $rules['confirm_password']  = [ 'same:password' ];
        //     }
        // } else {
        //     $rules['password']          = [ 'required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/' ];
        //     // $rules['confirm_password']  = [ 'required', 'same:password' ];
        // }
        // $rules['email']             = [ 'required', 
        //                                 'email', 
        //                                 Rule::unique('users')->where(function ($query) {
        //                                     $query = $query->where('id', '!=', \Request::get('id'));
        //                                     return $query;
        //                                 }) 
        //                             ];

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        $add = 'admin/user/user/add.';

        $messages['first_name.required']        = \Lang::get($add.'first_name_err_lbl');
        $messages['status.required']            = \Lang::get($add.'status_err_lbl');
        $messages['password.required']          = \Lang::get($add.'password_err_lbl');
        $messages['password.regex']             = \Lang::get($add.'password_invalid_lbl');
        $messages['confirm_password.required']  = \Lang::get($add.'confirm_password_err_lbl');
        $messages['confirm_password.same']      = \Lang::get($add.'confirm_password_same_lbl');
        $messages['email.required']             = \Lang::get($add.'email_err_lbl');
        $messages['email.email']                = \Lang::get($add.'email_invalid_lbl');
        $messages['email.unique']               = \Lang::get($add.'email_unique_lbl');

        return $messages;
    }
}

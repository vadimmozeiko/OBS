<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required | string | max:255',
            'address' => 'required | string | max:255',
            'phone' => 'required | numeric | min:11',
            'email' => 'required | string | email | max:255| unique:users',
            'password' => 'required | string | min:8 | confirmed',
            'password_confirmation' => 'required | same:password',
            'status' => 'required | string' ,
            'isAdmin' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Please fill the name field',
            'user_name.max' => 'Name is too long',
            'user_address.required' => 'Please fill the address field',
            'user_address.max' => 'Address is too long',
            'user_phone.required' => 'Please fill the phone no. field',
            'isAdmin.required' => 'Please select user type',
        ];
    }
}

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
            'name' => 'required | string | min:3 |max:255',
            'address' => 'required | string | min:3 | max:255',
            'phone' => 'required | numeric | min:9',
            'email' => 'required | string | email | max:255 | unique:users',
            'password' => 'required | string | min:8 | confirmed',
            'password_confirmation' => 'required | same:password',
            'status' => 'required | string' ,
            'isAdmin' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please fill the name field',
            'name.max' => 'Name is too long',
            'address.required' => 'Please fill the address field',
            'address.max' => 'Address is too long',
            'phone.required' => 'Please fill the phone no. field',
            'isAdmin.required' => 'Please select user type',
        ];
    }
}

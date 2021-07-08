<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'user_name' => 'required | string | max:255',
            'user_email' => 'required | string | email | max:255',
            'user_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:9',
            'date' => 'required | date | after: today',
            'product_id' => 'required | integer | min:1',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Please fill the name field',
            'user_name.max' => 'Name is too long',
            'user_email.required' => 'Please fill the email field',
            'user_phone.required' => 'Please fill the phone no. field',
            'user_phone.regex' => 'Invalid phone no.',
            'date.after' => 'Incorrect date (for today bookings contact directly)'
        ];
    }
}
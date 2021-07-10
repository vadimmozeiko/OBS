<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'user_name' => 'required | string | min:3 | max:255',
            'user_email' => 'required | string | email | max:255',
            'user_address' => 'required | string | max:255',
            'user_phone' => ['required' , 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9'],
            'date' => 'required | date | after: today',
            'status_id' => 'required | integer | min:1',
            'user_id' =>'required | integer | min:1',
            'product_id' =>'required | integer | min:1',
            'price' => ['required', 'regex:/^\d*(\.\d{2})?$/']
        ];
    }

    public function messages()
    {
        return [
            'user_name.min' => 'Name is too short (min. 3 characters)',
            'user_name.required' => 'Please fill the name field',
            'user_name.max' => 'Name is too long',
            'user_address.required' => 'Please fill the address field',
            'user_address.max' => 'Address is too long',
            'user_phone.required' => 'Please fill the phone no. field',
            'user_phone.regex' => 'Invalid phone no.',
            'date.after' => 'Incorrect date (for today bookings contact directly)'
        ];
    }
}

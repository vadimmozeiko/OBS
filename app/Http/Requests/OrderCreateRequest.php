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
            'order_number' => 'required | integer',
            'user_name' => 'required | string | min:3 | max:64',
            'user_email' => 'required | string | email | max:128',
            'user_address' => 'required | string | min:3 | max:128',
            'user_phone' => ['required' , 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9', 'max:32'],
            'date' => 'required | date | after: today | max:64',
            'status_id' => 'required | integer | min:1',
            'user_id' => 'nullable',
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
            'date.after' => 'Incorrect date (for today bookings contact directly)',
            'product_id.integer' => 'Please select the product',

        ];
    }
}

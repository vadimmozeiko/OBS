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
            'name' => 'required | string | min:3 | max:32',
            'email' => 'required | string | email | max:128',
            'address' => 'required | string | min:3 | max:128',
            'phone' => ['required' , 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9', 'max:32'],
            'date' => 'required | date | after: yesterday | max:32',
            'product_id' => 'required | integer | min:1',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please fill the name field',
            'name.max' => 'Name is too long',
            'email.required' => 'Please fill the email field',
            'address.required' => 'Please fill the address field',
            'address.max' => 'Address is too long',
            'phone.required' => 'Please fill the phone no. field',
            'phone.regex' => 'Invalid phone no.',
            'date.after' => 'Incorrect date (for today bookings contact directly)',
        ];
    }
}

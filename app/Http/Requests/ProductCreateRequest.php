<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends FormRequest
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
            'image' => 'sometimes | mimes:jpg,gif,png',
            'title' => 'required | string | min:3 | max:64',
            'category' => 'required | string | min:3 | max:64',
            'description' => 'required | string',
            'status' => 'required | string | in:available, unavailable, broken',
            'price' => ['required', 'regex:/^\d*(\.\d{2})?$/']
        ];
    }

    public function messages()
    {
        return [
//            'image.mimes' => 'Title is too short (min. 3 characters)',
            'title.min' => 'Title is too short (min. 3 characters)',
            'title.required' => 'Please fill the title field',
            'category.min' => 'Category is too short (min. 3 characters)',
            'category.required' => 'Please fill the category field',
            'category.max' => 'Category is too long',
            'description.required' => 'Please fill the description field',
            'price.required' => 'Please fill the price field',
            'price.regex' => 'Incorrect format (use 0.00)',
        ];
    }
}

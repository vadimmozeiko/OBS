<?php

namespace App\Http\Requests;

use App\Rules\Captcha;
use Illuminate\Foundation\Http\FormRequest;

class ContactMessageCreateRequest extends FormRequest
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
            'name' => 'sometimes | string | max:32',
            'email' => 'required | string | email | max:128',
            'subject' =>'sometimes',
            'message' => 'required | min: 3 | max: 60000',
            'status' => 'sometimes | string | in:new',
            'g-recaptcha-response' => new Captcha(),
        ];
    }
}

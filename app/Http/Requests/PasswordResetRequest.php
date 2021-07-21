<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPass;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'password' => 'required | min:8',
            'password_confirmation' => 'required | same:password'
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => 'Please fill the new password field',
            'new_password.min' => 'Too short, min. 8 characters',
            'new_password.different' => 'New password cannot be the same as old one',
            'confirm_password.required' => 'Please fill the confirmed password field',
            'confirm_password.same' => 'Password do not match',
        ];
    }
}

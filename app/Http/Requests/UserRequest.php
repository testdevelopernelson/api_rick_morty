<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class UserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'email' => 'required|email',
            'password' => 'required',

        ];

    }

    public function messages() {

        return [
            'email.required' => Lang::get('register.email_required'),
            'email.email' => Lang::get('register.email_email'),
            'password.required' => Lang::get('register.password_required'),

        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class AccountRequest extends FormRequest {
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

        $rules = [
            'name' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            

        ];

        return $rules;

    }

    public function messages() {

        return [
            'name.required' => Lang::get('register.name_required'),
            'country.required' => Lang::get('register.country_required'),
            'address.required' => Lang::get('register.address_required'),
            'city.required' => Lang::get('register.city_required'),
            'phone.required' => Lang::get('register.phone_required'),
            'email.required' => Lang::get('register.email_required'),
            'email.email' => Lang::get('register.email_email'),
            'email.unique' => Lang::get('register.email_unique'),
            'password.required' => Lang::get('register.password_required'),

        ];
    }

}

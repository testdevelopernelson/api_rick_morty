<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class OrderRequest extends FormRequest {
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

        if (!auth()->check()) {
            $user = User::find($this->users);
            $rules = [
                'user.name' => 'required',
                'user.country' => 'required',
                'user.address' => 'required',
                'user.city' => 'required',
                'user.phone' => 'required',
                'user.email' => 'required|email|unique:users,email',
                'user.password' => 'required',

            ];
        }else{
            $rules = [];
        }

        return $rules;

    }

    public function messages() {

        return [
            'user.name.required' => Lang::get('register.name_required'),
            'user.country.required' => Lang::get('register.country_required'),
            'user.address.required' => Lang::get('register.address_required'),
            'user.city.required' => Lang::get('register.city_required'),
            'user.phone.required' => Lang::get('register.phone_required'),
            'user.email.required' => Lang::get('register.email_required'),
            'user.email.email' => Lang::get('register.email_email'),
            'user.email.unique' => Lang::get('register.email_unique'),
            'user.password.required' => Lang::get('register.password_required'),

        ];
    }

}

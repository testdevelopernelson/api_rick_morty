<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest {
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
            'name'  => 'required',
            'code'  => 'required|unique:coupons,code',
            'start' => 'required',
            'end'   => 'required|after_or_equal:start',
            'type_discount'  => 'required',
        ];

        if($this->method() == 'PUT'){
            $rules['code'] = 'required|unique:coupons,code,'.$this->coupon;
        }

        return $rules;

    }

    public function messages() {

        return [
            'name.required' => 'El nombre es requerido',
            'code.required' => 'El código es requerido',
            'code.unique' => 'El código ya existe',
            'start.required' => 'La fecha inicio es requerida',
            'end.required' => 'La fecha final es requerida',
            'end.after_or_equal' => 'La fecha final debe ser una fecha posterior a la inicial',
            'type_discount.required' => 'El tipo es requerido',
            'max_user.required' => 'La cantidad máxima por usuario es requerida',

        ];
    }

}

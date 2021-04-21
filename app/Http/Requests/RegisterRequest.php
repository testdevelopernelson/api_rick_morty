<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
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
            $rules = [
                'name' => 'required',

            ];
        }

        return $rules;

    }

    public function messages() {

        return [
            'name.required' => 'La imagen debe ser un archivo',
            'image.image' => 'El archivo debe ser una imagen',
            'image.max' => 'El archivo debe pesar máximo 2 MB',
            'image_2.mimes' => 'La imagen debe ser un archivo de tipo: :values',
            'image_2.image' => 'El archivo debe ser una imagen',
            'image_2.max' => 'El archivo debe pesar máximo 2 MB',
            'image_3.mimes' => 'La imagen debe ser un archivo de tipo: :values',
            'image_3.image' => 'El archivo debe ser una imagen',
            'image_3.max' => 'El archivo debe pesar máximo 2 MB',
            'image_4.mimes' => 'La imagen debe ser un archivo de tipo: :values',
            'image_4.image' => 'El archivo debe ser una imagen',
            'image_4.max' => 'El archivo debe pesar máximo 2 MB',

        ];
    }

}

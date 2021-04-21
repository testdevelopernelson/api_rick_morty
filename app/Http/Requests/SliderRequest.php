<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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

        $rules = [
              'text'=>'required'
        ];

        return $rules;

        
    }

    public function messages(){
        return [
          'image.required'=>'La imagen es requerida',
          'image.mimes'=>'La imagen debe ser un archivo de tipo: :values',
          'image.image'=>'El archivo debe ser una imagen',
          'image.max'=>'El archivo (imagen ES) debe pesar máximo 2 MB',
          'alt.required'=>'El alt es requerido',
          'text_es.required'=>'La descripción requerida',

        ];
    }

   
}

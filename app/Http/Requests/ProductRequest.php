<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $product = Product::find($this->product);
        $rules = [
              'name'=>'required',
         
        ];

        if($this->method() == 'POST' || !is_null(request()->file)){
          $rules['image'] = 'required|image|mimes:jpeg,bmp,png|max:2200';
        }

        if($this->method() == 'PUT'){
          $rules['slug'] = 'required|unique:products,slug,'.$product->id;
          $rules['image'] = 'image|mimes:jpeg,bmp,png|max:2200';
        }

        return $rules;

        
    }

   
}

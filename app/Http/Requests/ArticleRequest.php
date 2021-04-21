<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;

class ArticleRequest extends FormRequest
{  

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $article = Article::find($this->article);
        $rules = [
              'title'=>'required',
              'author'=>'required',
        ];

        if($this->method() == 'POST' || !is_null(request()->file)){
          $rules['image'] = 'required|image|mimes:jpeg,bmp,png|max:2200';
        }

        if($this->method() == 'PUT'){
          $rules['slug'] = 'required|unique:articles,slug,'.$article->id;
        }

        return $rules;        

    }



    public function messages(){
      
        return [

          'image.required'=>'La imagen es requerida',

          'image.mimes'=>'La imagen debe ser un archivo de tipo: :values',

          'image.image'=>'El archivo debe ser una imagen',

          'image.max'=>'El archivo (imagen ES) debe pesar máximo 2 MB',

          'title.required'=>'El título es requerido',

          'text.required'=>'El contenido es requerido',



        ];

    }



   

}


<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreRequest extends FormRequest
{

    static public function myRules()
    {
        return [
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500|unique:posts", //unique es para que el slug o url sea unico y no se repita, o sea en la tabla post, el campo slug sera unico
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required",
        ];
    }
    //funcion prepareforValidation para que el slug este saneado e igual al titulo 
    protected function prepareForValidation()
    {
        $this->merge([
            //'slug'=> Str::slug($this->title)
            //'slug'=> Str::of($this->title)->slug()->append("-adicional") append es una funcion que puede adicionar algo mas en el slug de forma estatica
            'slug'=> str($this->slug)->slug()
        ]);
    }
    
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Se define como true porque por defecto de crea con false y rechaza las reglas de validacion
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500|unique:posts",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required",
            
        ];
    }
}

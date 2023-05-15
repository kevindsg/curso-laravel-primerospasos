<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PutRequest extends FormRequest
{
    
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
            "slug" => "required|min:5|max:500|unique:posts,slug,".$this->route("post")->id, 
            //unique es para que el slug o url sea unico y no se repita, o sea en la tabla post, el campo slug sera unico. $this->route("post")->id, para obtener el identificados del slug para que no se repita en nuestro post.
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required",
            "image" => "mimes:jpeg,jpg,png|max:10240",
        ];
    }
}

<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    static public function myRules()
    {
        return [
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500|unique:posts"
        ];
    }
    //funcion prepareforValidation para que el slug este saneado e igual al titulo 
    protected function prepareForValidation()
    {
        $this->merge([
            'slug'=> str($this->title)->slug()
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
        return $this->myRules();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //fillable es una propiedad para porteger los campos que se quieren insertar. Y se inserta siempre en el modelo, en esta caso despues de haberlo creado desde el controlador store
    protected $fillable = ['title','slug','category_id','posted','content','description','image'];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }
}

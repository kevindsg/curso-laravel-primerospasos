<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //para redireccionar
        //return redirect()->route("post.create"):


        //paginate es la funcion para paginar la lista que no sea toda la lista en una sola pagina, que es el caso si lo mostramos con get 
        $posts = Post::paginate(2);
        //return view('Dashboard.post.index', ["posts"=>$posts]);
        //compact hace exactamente lo mismo que el array de arriba 
        return view('Dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //para pintar el post crear 
    {
        //Primero $señalamos la tabla en este caso es catogories y despues = le decimos que sera igual a su Modelo en este caso es Category, y si fueramos a obtener toda la lista seria :: get(*from categories), pero en este caso solo queremos el id y nombre de los elementos de la tabla 
        //Funcion pluck, con dos campos la key y el valor (id title) se usa para datos mas legibles y sencillos como un listado o algo simple
        $categories=Category::pluck('id','title');
        //dd($categories);
        //Asi vemos un dato especìfico de la tabla categoria como por ejemplo el titulo
        //dd($categories[1]->title);  
        //new post para pasarle una intancia del post
        $post = new Post();
        echo view('dashboard.post.create', compact('categories', 'post')); //compact el la funcion que permite que se pase por el controlador a la vista los elementos de la tabla categories. esta linea de codigo hace la vista html
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)  // para obtener los datos y almacenarlos //ademas cambiamos su parametro a StorePostRequest
    {
        //echo(request('title'));
        //dd(request('title'));
        //dd($request);
        //echo $request->input('slug');
        //dd($request->all());
        //$data = array_merge($request->all(),['image' => '']);
        //dd($data);
        //$validated = $request -> validate(StoreRequest::myRules());
        //Para validar los datos creamos en la terminar un request y eso crea una carpeta
        //Los errores se pueden listar desde el html en este caso esta en la carpeta dashboard/fragment/errors en el view
        Post::create($request->validated());
        return to_route("post.index")->with('status',"Registro creado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) //para pintar 
    {
        return view("dashboard.post.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) 
    {
        $categories=Category::pluck('id','title');
        echo view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        //dd($request->validated());
        $data = $request->validated();
        if (isset($data["image"])) {
            $data["image"] = $filename = time().".".$data["image"]->extension();
            $request-> image-> move(public_path("image/otro"), $filename);
        }

        //dd($request->validated());
        $post->update($data);
        return to_route("post.index")->with('status',"Registro actualizado.");// with es la funcion para hacer el mensaje fash 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route("post.index")->with('status',"Registro eliminado.");
    }
}

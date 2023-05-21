<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function Symfony\Component\String\s;

class PostController extends Controller{

    public function __construct(){
        // Revisa si el usuario está autenticado
        // Aquí vamos a estar omtiendo a los usuarios no registrados
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index( User $user){

        // Aquí ya vamos a mostrar las publicaciones del usuario
        // dd($user->id);
        // $posts = Post::where('user_id', $user->id)
        //            ->orderBy('created_at', 'desc')
        //            ->paginate(10);
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        // dd($posts);

        // Aquí vamos a autentificar el usuario
        // dd(auth()->user());
        // Ruta a donde lo vamos a mandar después del registro
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    // Función para crear las públicaciones
    public function create(){
        // dd('Creando Post...');
        return view('posts.create');
    }

    // Aquí nos permite tener el formulario
    // Aquí se va a estar almacenando den la bd
    public function store(Request $request){
        // dd('Creando Publicación...');

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Aquí estamos insertando el registro en la base de datos
//        Post::create([
//            'titulo' => $request->titulo,
//            'descripcion' => $request->descripcion,
//            'imagen' => $request->imagen,
//            'user_id' => auth()->user()->id
//        ]);

        // OTRA FORMA
//        $post = new Post;
//        $post->titulo = $request->titulo;
//        $post->descripcion = $request->descripcion;
//        $post->imagen = $request->imagen;
//        $post->user_id = auth()->user()->id;
//        $post->save();

        // OTRA FORMA MÁS DE GUARDAR LOS DATOS
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        // Aquí estamos redireccionando al usuario a su muro
        return redirect()->route('posts.index', auth()->user()->username);
    }

    // Aquí es para ver la publicación
    public function show(User $user, Post $post){

        // Redirige a la publicación en grande
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    // Función que elimina la publicación
    public function destroy( Post $post ){
        // dd('Eliminando...', $post->id);

//        if($post->user_id === auth()->user()->id){
//            dd ('si es la misma persona');
//        }else{
//            dd('no te topo');
//        }

        // válidación que viene  del PostPolicy
        $this->authorize('delete', $post);

        // Eliminar el post
        $post->delete();

        // Eliminar la Imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}

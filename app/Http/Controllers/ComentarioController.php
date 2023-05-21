<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //Aquí se van a estar almacenando los comentarios en la bd
    public function store(Request $request, Post $post){

        // validar formulario
        // dd('comentando');
        // dd ($post->id);

        $this->validate($request, [
           'comentario' => 'required|max:255'
        ]);

        if(auth()->user() == null) {
           return redirect()->route('login');
        }
        // almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);
        // imprimir un mensaje
        return back()->with('mensaje', 'Comentario Realizado Correctamente');
    }
}

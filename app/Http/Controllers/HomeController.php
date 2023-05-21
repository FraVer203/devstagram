<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // Función para usuarios no autentificados
    public function __construct(){
        $this->middleware('auth');
    }

    // Función del inicio de ig
    public function __invoke(){
        // dd('home');
        // Obtener a quienes seguimos
        $ids = (auth()->user()->followings->pluck('id')->toArray());
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
        // dd($posts);
        return view('home', [
            'posts' => $posts
        ]);
    }
}

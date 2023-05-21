<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Función que dará los likes
    public function store(Request $request, Post $post){
        // dd($request->user()->id);
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    // Función para borrar like
    public function destroy(Request $request, Post $post){
       // dd('eliminando like');
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}

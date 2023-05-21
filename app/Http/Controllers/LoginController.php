<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        //dd($request->remember);

        // dd('Autenticando...');
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // If que verifica si las credenciales son correctas
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            // Con el return->back hacemos que regrese a la misma vista si hay un error y le imprime el mensaje
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // en caso de que las credenciales sean correctas se le manda a:
        // Una forma para mandarlo al perfil de usuario después de iniciar sesión
        // return redirect()->route('posts.index', auth()->user()->username);
        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoutController extends Controller{

    public function store(){
        // Aquí se va a estar cerrando la sesión
       // dd('Cerrando Sesión...');
        auth()->logout();
        return redirect()->route('login');
    }
}

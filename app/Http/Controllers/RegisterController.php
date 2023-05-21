<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller {

    // AQUÍ VA LA FUNCIÓN PARA LA VISTA DEL REGISTRO
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){

        // dd es como la nueva forma de debbuggear para ver los datos que se le manden a un formulario
        // dd($request);
        // dd($request->get('email'));

        // Validación
        // Modificaremos el $request
        $request->request->add(['username' => Str::slug($request->username)]);


        $this->validate($request, [
            // metodo 1
            // 'name' => ['required', 'min:5']
            // metodo 2
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        // dd('Creando Usuario...');

        // Aquí vinculamos el modelo "Users" con el Controlador
        // Aquí vamos a hacer el insert en la base de datos
        // Hash::make hace que la contraseña no se muestre
        // Str::lower Convierte el username a minusculas
        // Str::slug Convierte el username leíble para la url

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);

        // Aquí agregamos los datos para autentificar
//        auth()->attempt([
//            'email' => $request->email,
//            'password' => $request->password
//        ]);

        // Otra forma de autentificar
        // only('email', 'password') solo va a tomar email y el password del request
        auth()->attempt($request->only('email', 'password'));

        // Redireccionamos una vez los datos sean correctos
        return redirect()->route('posts.index', auth()->user()->username);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    // Autentificador
    public function __construct(){
        $this->middleware('auth');
    }
    // Vista del perfil
    public function index(){
       // dd('Aquí se muestra el formulario...');
        return view('perfil.index');
    }

    // Función para subir foto de perfil
    public function store(Request $request){
        // dd('Guardadno Cambios...');

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20',
                'not_in:instagram,facebook,twitter,editar-perfil,usuario,login,register']
        ]);

        if($request->imagen){
            // dd('Si hay imágen. . . ');
            // Controlador de la imágen

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make( $imagen );
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save( $imagenPath );
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        // Redirecciona al usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}

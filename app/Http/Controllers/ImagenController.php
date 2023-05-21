<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller{

    // Aquí se van a ir cargando las imágenes
    public function store(Request $request) {
        //return "Desde Imágen Controller";
        //$input = $request->all();

        $imagen = $request->file('file');
        // Pasamos los parametros del input (la impagen) al formato json
        //return response()->json($input);

        // Hace que las imagenes se hagan cuadradas como instagram
        // Str::uuid() crea un ID único para cada imágen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $imagenServidor = Image::make( $imagen );
        // Aquí le estamos especificando el tamaño a la imágen
        $imagenServidor->fit(1000, 1000);

        // Aquí es donde se va a almacenar la imagen y el nombre de la misma
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        // Aquí le indicamos que mueva a esa ruta con el nombre
        $imagenServidor->save( $imagenPath );

        // Este es el nombre que se va a ir almacenando en la bd
        return response()->json([ 'imagen' => $nombreImagen ]);
    }
}


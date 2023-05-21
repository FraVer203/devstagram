@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

<!-- con el push hacemos que los estílos se vayan al header -->
@push('styles')
<!-- Hoja de estílos para la imágen -->
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<!-- Fin de la Hoja de estílos para la imágen -->
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <!-- Imagen de la Públicación -->
        <div class="md:w-1/2 px-10">
            <!-- Imagen Aquí -->
            <!-- Este es el formato para hacer la subída de imágenes recomendada -->
            <form action="{{ route('imagenes.store') }}" method="POST"  enctype="multipart/form-data"
                id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded
                flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <!-- Descripción de la publicación -->
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-8">
            <!-- Descripción Aquí -->

            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                {{--                <!-- @csrf protege el código con un value -->--}}
                @csrf
                <!-- Título de la publicación -->
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Título
                    </label>
                    <!-- Aquí mantiene los datos para no tener que volver a escribir otra vez
                     y dejamos en color rojo el imput -->
                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        placeholder="Título de la Publicación"
                        class="border border-gray-300 p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}"
                    />
                    <!-- Aquí va el mensaje de error de required -->
                    @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <!-- Fin del Título de la publicación -->

                <!-- Descripción de la publicación -->
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <!-- Aquí mantiene los datos para no tener que volver a escribir otra vez
                     y dejamos en color rojo el imput -->
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        type="text"
                        placeholder="Descripción de la Publicación"
                        class="border border-gray-300 p-3 w-full rounded-lg
                        @error('descripcion') border-red-500
                        @enderror"
                        value=""
                    >{{ old('descripcion') }}</textarea>
                    <!-- Aquí va el mensaje de error de required -->
                    @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <!-- Fin de la Descripción de la publicación -->

                <!-- Inicio de la válidación de imágen -->
                <div class="mb-5">
                    <!-- Siempre se pone el mismo name al que se tiene en la base de datos -->
                    <input
                        name="imagen"
                        type="hidden"
                        value="{{ old('imagen') }}"
                    />
                    @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <!-- Fin de la válidación de imágen -->

                <!-- Botón de la publicación -->
                <input
                    type="submit"
                    value="Crear Públicación"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                />
                <!-- Fin del Botón de la publicación-->
            </form>
            <!-- Fin de la Descripción -->
        </div>
    </div>
@endsection

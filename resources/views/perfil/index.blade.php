@extends('layouts.app')

@section('titulo')
    Editar Perfil
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Nombre de usuario -->
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <!-- Aquí mantiene los datos para no tener que volver a escribir otra vez
                     y dejamos en color rojo el imput -->
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        class="border border-gray-300 p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />
                    <!-- Aquí va el mensaje de error de required -->
                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <!-- Fin de nombre de Usuario -->

                <!-- Imagen -->
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Foto
                    </label>
                    <!-- Aquí mantiene los datos para no tener que volver a escribir otra vez
                     y dejamos en color rojo el imput -->
                    <input
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border border-gray-300 p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .png, .jpeg"
                    />
                </div>
                <!-- Fin Imagen -->

                <!-- Botón de subir -->
                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                />
                <!-- Fin de Botón de subir -->
            </form>
        </div>
    </div>
@endsection

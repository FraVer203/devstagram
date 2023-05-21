@extends('layouts.app')
@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <!-- p>Imagen Aquí</p -->
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Login de Usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                {{--                <!-- @csrf protege el código con un value -->--}}
                {{--                <!-- Pero para activarla la ruta debe ser post en el web.php -->--}}
                @csrf

                <!-- Aquí estamos creando el mensaje de error del formulario -->
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <!-- Fin del mensaje de error del formulario -->

                <!-- Email del Usuario-->
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Email de Registro"
                        class="border border-gray-300 p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <!-- Fin del Email del Usuario-->

                <!-- Password del Usuario-->
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Tu Password de Registro"
                        class="border border-gray-300 p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <!-- Fin del Password-->

                <!-- Recordar Usuario -->
                <div class="mb-5">
                    <input type="checkbox" name="remember">
                    <label class="text-gray-500 text-sm">Mantener sesión abierta</label>
                </div>
                <!-- Fin del Recordar Usuario -->

                <!-- Botón de envíar datos -->
                <input
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                />
                <!-- Fin del botón de envíar datos -->
            </form>
        </div>
    </div>
@endsection


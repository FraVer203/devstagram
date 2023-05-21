@extends('layouts.app')

@section('titulo')
{{--    Perfil: {{ $user->username }}--}}

@php
    $nombreUsuario = $user->username;
    $nombreUsuarioSinGuion = str_replace('-', ' ', $nombreUsuario);
    $nombreUsuarioFormateado = ucwords($nombreUsuarioSinGuion);
    echo "Perfil: " . $nombreUsuarioFormateado;
@endphp

@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <!-- p>Imagen Aquí</p -->
                <img src="{{
                        $user->imagen ?
                        asset('perfiles') . '/' . $user->imagen :
                        asset('img/usuario.svg')
                        }}"
                     alt="Imagen del Usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
{{--                {{ dd($user) }}--}}

                <!-- Aquí se está imprimiendo el nombre del Usuario -->
                <!-- Nombre de usuario -->
                <div class="flex item-center gap-3">
                    <p class="text-grey-700 text-2xl mb-5">
                        {{--                    {{ $user->username }}--}}
                        @php
                            $nombreUsuario = $user->username;
                            $nombreUsuarioSinGuion = str_replace('-', ' ', $nombreUsuario);
                            $nombreUsuarioFormateado = ucwords($nombreUsuarioSinGuion);
                            echo $nombreUsuarioFormateado;
                        @endphp
                    </p>
                        @auth()
                            @if($user->id === auth()->user()->id)
                                <a class="text-gray-500 hover:text-gray-600 cursor-pointer" href="{{ route('perfil.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            @endif
                        @endauth
                </div>
                <!-- Fin de Nombre de usuario -->

                <!-- Seguidores de usuario -->
                <p class="text-gray-800 text-sm mb-2 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>
                <!-- Fin de Seguidores de usuario -->

                <!-- Siguiendo de usuario -->
                <p class="text-gray-800 text-sm mb-2 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-normal">@choice('Seguido|Seguidos', $user->followers->count())</span>
                </p>
                <!-- Fin de Siguiendo de usuario -->

                <!-- Post de usuario -->
                <p class="text-gray-800 text-sm mb-2 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">@choice('Post|Posts', $user->posts->count())</span>
                </p>
                <!-- Fin de Post de usuario -->

                <!-- Aquí es el botón para seguir/dejar de seguir -->
                @auth()
                     @if($user->id !== auth()->user()->id)
                        @if(!$user->siguiendo( auth()->user() ))
                            <form
                                action="{{ route('users.follow', $user) }}"
                                method="POST">
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1
                        text-xs font-bold cursor-pointer"
                                    value="Seguir"
                                />
                            </form>
                        @else
                            <form
                                action="{{ route('users.unfollow', $user) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input
                                    type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1
                        text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir"
                                />
                            </form>
                        @endif
                     @endif
                @endauth
                <!-- Fin del botón para seguir/dejar de seguir -->

            </div>
        </div>
    </div>

    <!-- Inicio de publicaciones -->
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones
        </h2>

        <!-- Listado -->
        <x-listar-post :posts="$posts" />
        <!-- Fin Listado -->
    </section>
    <!-- Fin de publicaciones -->
@endsection

@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <!-- Aquí se imprime la imágen de la publicación -->
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post - " . {{ $post->titulo }}>
            <!-- Fin de imprime la imágen de la publicación -->

            <!-- Botón de Likes -->
                <div class="p-3 flex items-center gap-4">
                    <!-- Corazón -->
                    @auth()
                        <livewire:like-post :post="$post" />
                    <!-- Fin Corazón -->
                    @endauth

                </div>
            <!-- Fin de Botón de Likes -->

            <div>
                <!-- Aparece el nombre de Usuario -->
                <a href="{{ route('posts.index', $post->user->username) }}">
                    <p class="font-bold">
                        {{ $post->user->username }}
                    </p>
                </a>
                <!-- Fin Aparece el nombre de Usuario -->

                <!-- Tiempo en que se publicó el post-->
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <!-- Fin Tiempo en que se publicó el post-->

                <!-- Descipción -->
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
                <!-- Fin Descipción-->

                <!-- Inicio Eliminar -->
                @auth
                    @if($post->user_id === auth()->user()->id)
                        <form method="POST" action="{{ route('post.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <input
                                type="submit"
                                value="Eliminar Publicación"
                                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                            />
                        </form>
                    @endif
                @endauth
                <!-- Fin Eliminar -->

            </div>
        </div>

        <!-- Comentarios -->
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth()
                <p class="text-xl font-bold text-center mb-4">
                    Agrega un Nuevo Comentario
                </p>
                @if( session('mensaje') )
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje') }}
                    </div>
                @endif
                <!-- Formulario de comentarios -->
                <form action="{{ route('comentarios.store', ['post' => $post]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Agregar un Comentario
                        </label>
                        <!-- Aquí mantiene los datos para no tener que volver a escribir otra vez
                         y dejamos en color rojo el imput -->
                        <textarea
                            id="comentario"
                            name="comentario"
                            type="text"
                            placeholder="Agrega un comentario a la Publicación"
                            class="border border-gray-300 p-3 w-full rounded-lg
                    @error('comentario') border-red-500
                    @enderror"
                            value=""
                        ></textarea>
                        <!-- Aquí va el mensaje de error de required -->
                        @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Botón de la publicación -->
                    <input
                        type="submit"
                        value="Comentar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg"
                    />
                    <!-- Fin del Botón de la publicación-->

                </form>
                <!-- Fin Formulario de comentarios -->
                @endauth

                <!-- Muestra comentarios públicos -->
                    @if($post->comentarios->count())
                    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                        {{--                        {{ dd($post->comentarios) }}--}}
                        @foreach($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                <!-- Fin Muestra comentarios públicos -->

            </div>
        </div>
        <!-- Fin Comentarios -->
    </div>
@endsection

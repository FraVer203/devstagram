<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            @foreach($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post - {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Hacer que se muestre el botón de siguiente -->
        <div class="my-10">
            {{ $posts->links() }}
        </div>
        <!-- Fin de Hacer que se muestre el botón de siguiente -->
    @else
        <p class="text-center">No sigues a nadie, sigue a alguien pa poder ver lo que suba</p>
    @endif
</div>

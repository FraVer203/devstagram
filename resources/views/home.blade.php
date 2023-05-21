@extends('layouts.app') <!-- Esto es una directiva, para trar contenido de otra página a esta -->

<!-- el section cambia el título del yield de app -->
@section('titulo')
    Página Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection

<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Models\Like;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

/* Importamos la clase del Controlador */
/* Si la ruta se llama igual podemos dejarles el mismo nombre, solo cambia si las rutas tiene otro nombre */
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

/* En caso de no estar autentificado esta ruta será la por default
*  Además esta es la ruta del Inicio de Sesión */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

/* Aquí se estará cerrando la sesión del usuario */
Route::post('/logout', [LoutController::class, 'store'])->name('logout');

/* Rutas para el perfil */
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');

/* Edita el Perfil */
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

/* Aquí va el controlador para generar los post */
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');

/* Aquí vamos a estar subiendo las públicaciones */
Route::post('/post', [PostController::class, 'store'])->name('posts.store');

/* En esta ruta vamos a estar eliminando las publicaciones */
Route::delete('/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');

/* Esta es la ruta que nos deja hacer la publicación en grande */
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');

/* Aquí vamos a estar guardando los comentarios de los post */
Route::post('/post/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

/* Este Controlador es el encargado de las imágenes */
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

/* Aquí es donde se están dando likes */
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');

/* Aquí se quitan los likes */
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

/* Aquí es la vista de perfil de usuario */
/* En las llaves agregamos el nombre del modelo que se necesite */
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

/* Esta es la parte para seguir usuarios */
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');

/* En esta ruta se deja de seguir a un usuario */
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
// mostrar todos los posts
Route::get('/',[PostController::class,'index'])->name('post.index');

// mostrar un elemento (un post)
Route::get('posts/{post}',[PostController::class,'show'])->name('post.show');

// mostar elementos por categorias
Route::get('category/{category}',[PostController::class,'category'])->name('post.category');

// mostrar elemento por medio de etiquetas
Route::get('tag/{tag}',[PostController::class,'tag'])->name('post.tag');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

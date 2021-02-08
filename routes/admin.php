<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;

Route::get('',[HomeController::class,'index'])->name('admin.home');

// CRUD de categorias
Route::resource('categories', CategoryController::class)->names('admin.categories');

// CRUD de etiquestas
Route::resource('tags',TagController::class )->names('admin.tags'); 

// CRUD de posts
Route::resource('posts', PostController::class)->names('admin.posts');
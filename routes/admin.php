<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;

Route::get('',[HomeController::class,'index'])->name('admin.home');

// CRUD de categorias
Route::resource('categories', CategoryController::class)->names('admin.categories');

// CRUD de etiquestas
Route::resource('tags',TagController::class )->names('admin.tags'); 
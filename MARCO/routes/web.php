<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Importe a classe UserController

Route::get('/', [UserController::class, 'showLoginForm']);

// Definindo as rotas para UserController

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');

Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::put('/users/update', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

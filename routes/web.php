<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {

    Route::get('/signup', [AuthController::class, 'create'])->name('signup');

    Route::post('/signup', [AuthController::class, 'store'])->name('signup.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');

    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

    Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');

    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
});

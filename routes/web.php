<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');

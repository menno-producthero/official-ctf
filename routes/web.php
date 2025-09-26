<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store']);
Route::patch('/todos/{todo}', [TodoController::class, 'update']);
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

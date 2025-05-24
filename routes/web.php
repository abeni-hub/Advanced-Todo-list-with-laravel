<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/completed', [TodoController::class, 'completed'])->name('todos.completed');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('/todos/{id}', [TodoController::class, 'updateTitle'])->name('todos.updateTitle');
// Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
// Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
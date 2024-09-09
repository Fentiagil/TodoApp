<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TodoController::class, 'indexCategories'])->name('form');
Route::get('/users', [TodoController::class, 'indexUsers'])->name('users');
Route::get('/categories', [TodoController::class, 'getCategories'])->name('categories');

Route::get('/task', [TaskController::class, 'index'])->name('tasks.index');
Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');



Route::post('/submit', [TodoController::class, 'store'])->name('todo.submit');


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TodoController;

Route::get('/task', [TaskController::class, 'index']);
Route::get('/task/{id}', [TaskController::class, 'show']);
Route::put('/task/{id}', [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class, 'destroy']);


Route::get('/categories', [TodoController::class, 'getCategories']);
Route::get('/users', [TodoController::class, 'indexUsers']);
Route::post('/submit', [TodoController::class, 'store']);



<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


Route::post('/login', [AuthController::class, 'auth']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('/users', UserController::class);
});

//Isso aqui substitui as rotas criadas manualmente, mas os nomes
//das funções precisam seguir o padrão: store, destroy, upadate, show...
//Route::apiResource('/users', UserController::class);

//Rotas criadas manualmente
// Route::delete('users/{id}', [UserController::class, 'destroy']);
// Route::patch('/users/{id}', [UserController::class, 'update']);
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class, 'store']);

Route::get('/', function() {
    return response()->json([
        'success' => true
    ]);
});

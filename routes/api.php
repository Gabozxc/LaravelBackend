<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/verifyToken', [AuthController::class, 'verifyToken']);

Route::middleware('auth:sanctum')->post('/task', [TaskController::class, 'store']);

Route::middleware('auth:sanctum')->get('/tasks', [TaskController::class, 'getStore']);

Route::middleware('auth:sanctum')->put('/tasks/{task}', [TaskController::class, 'updateTask']);

Route::middleware('auth:sanctum')->delete('/tasks/{task}', [TaskController::class, 'destroyTask']);

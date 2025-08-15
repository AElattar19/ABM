<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthController;


Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'sign_out']);
    Route::get('all_tasks', [TaskController::class, 'index']);
    Route::post('add_task', [TaskController::class, 'store']);
    Route::put('tasks/{taskId}', [TaskController::class, 'update']);
    Route::delete('tasks/{taskId}', [TaskController::class, 'destroy']);
});
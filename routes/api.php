<?php

use App\Http\Controllers\Api\AttendanceApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/store-fcm-token', [AuthController::class, 'storeFcmToken']);
    Route::get('/dashboard', [DashboardApiController::class, 'index']);

    Route::apiResource('employees', EmployeeApiController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);

    Route::get('/attendance', [AttendanceApiController::class, 'index']);
    Route::post('/attendance/checkin', [AttendanceApiController::class, 'checkIn']);
    Route::post('/attendance/checkout', [AttendanceApiController::class, 'checkOut']);

    Route::apiResource('tasks', TaskApiController::class)->only([
        'index',
        'show',
        'store',
    ]);
    Route::patch('/tasks/{task}/status', [TaskApiController::class, 'updateStatus']);
});

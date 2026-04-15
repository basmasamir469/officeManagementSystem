<?php

use App\Http\Controllers\Api\AttendanceApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
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
});

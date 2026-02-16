<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\LocationMasterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/admin/create-leader', [UserController::class, 'createLeader']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/site-location', [LocationMasterController::class, 'store']);
    Route::post('/admin/set-commission', [CommissionController::class, 'setCommission']);
    Route::get('/admin/commissions', [CommissionController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:leader'])->group(function () {
    Route::post('/create-adviser', [UserController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'role:admin,leader'])->group(function () {
    Route::get('/my-network', [UserController::class, 'myNetwork']);
});

Route::get('/site-location', [LocationMasterController::class, 'index']);

<?php

use App\Http\Controllers\api\AdvisorController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\LocationMasterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // booking
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::patch('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'role:admin,leader'])->group(function () {
    
    // user 
    Route::post('/admin/create-leader', [UserController::class, 'createLeader']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/my-network', [UserController::class, 'myNetwork']);
    // get users by role 
    Route::get('/users-by-role', [UserController::class, 'usersByRole']);

    // location 
    Route::post('/site-location', [LocationMasterController::class, 'store']);
    Route::get('/site-location', [LocationMasterController::class, 'index']);
    Route::get('site-location/{id}', [LocationMasterController::class, 'show']);
    Route::put('site-location/{id}', [LocationMasterController::class, 'update']);
    Route::delete('site-location/{id}', [LocationMasterController::class, 'destroy']);

    // commissions 
    Route::post('/commission', [CommissionController::class, 'setCommission']);
    Route::put('/commission/{id}', [CommissionController::class, 'updateCommission']);
    Route::delete('/commission/{id}', [CommissionController::class, 'deleteCommission']);
    Route::get('/commissions', [CommissionController::class, 'index']);
    Route::get('/commissions/user/{userId}', [CommissionController::class, 'getByUser']);
    Route::get('/my-commissions', [CommissionController::class, 'myCommissions']);
    Route::get('/commission/{id}', [CommissionController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:leader'])->group(function () {
//    resource route for the advisor 
 Route::apiResource('create-advisor', AdvisorController::class);

});

Route::middleware('auth:sanctum')->get('/test-auth', function () {
    return response()->json(auth()->user());
});
 
<?php

// use App\Http\Controllers\api\AdvisorController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\LocationMasterController;
use App\Http\Controllers\Api\ReferralController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CommissionPaymentController;
use App\Http\Controllers\Api\BookingPaymentController;
use App\Http\Controllers\Api\ReferralSettingController;
use App\Http\Controllers\BookingPaymentController as ControllersBookingPaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// reset
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-reset-token', [AuthController::class, 'verifyResetToken']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // individual user reset password
    Route::post('/change-password', [AuthController::class,'changePassword']);
    Route::post('/referrals', [ReferralController::class, 'store']);
    Route::get('/refered', [ReferralController::class, 'index']);
    Route::get('/referrals', [ReferralController::class, 'myReferrals']);
    Route::get('/referrals/{id}', [ReferralController::class, 'show']);


    Route::get('/customers', [BookingController::class, 'customers']);

    Route::get('/projects/{userId}', [BookingController::class, 'projectsByCustomer']);

    Route::get('/plots/{userId}/{project}', [BookingController::class, 'plots']);
    // booking
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::patch('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']); // soft delete
    Route::post('booking/{id}/restore', [BookingController::class,'restore']); // restore
Route::delete('booking/{id}/force-delete', [BookingController::class,'forceDelete']); // permemet delete
    Route::get('/mybookings', [BookingController::class, 'mybookings']);
    Route::get('/booking-summary/{id}', [BookingPaymentController::class, 'getBookingSummary']);//to fetch paid, total, balance amount
    Route::get('/dashboard', [BookingController::class, 'dashboard']);
    Route::get('/admdashboard', [BookingController::class, 'admdashboard']);
    Route::get('/adviserPerformance', [BookingController::class, 'adviserPerformance']);
    Route::get('/leader-summary', [BookingController::class, 'leaderSummary']);
    Route::get('leader-details/{id}', [BookingController::class, 'leaderDetails']);
    Route::get('adviser-details/{id}', [BookingController::class, 'adviserDetails']);


    Route::get('recent-payments', [BookingController::class, 'recentPayments']);
    Route::get('commission-split', [BookingController::class, 'commissionSplit']);
    Route::get('sales-trend', [BookingController::class, 'salesTrend']);
    Route::get('dashboard-alerts', [BookingController::class, 'dashboardAlerts']);
});

Route::middleware(['auth:sanctum', 'role:admin,leader,adviser,customer'])->group(function () {

    // user
    Route::post('/admin/create-leader', [UserController::class, 'createLeader']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/my-network', [UserController::class, 'myNetwork']);
    Route::get('/users-by-role', [UserController::class, 'usersByRole']);
    Route::get('/by-role', [UserController::class, 'getUsersByRole']);

    // location
    Route::post('/site-location', [LocationMasterController::class, 'store']);
    Route::get('/site-location', [LocationMasterController::class, 'index']);
    Route::get('/site-location/{id}', [LocationMasterController::class, 'show']);
    Route::put('/site-location/{id}', [LocationMasterController::class, 'update']);
    Route::delete('/site-location/{id}', [LocationMasterController::class, 'destroy']);

    // profile 
    Route::get('/profile', [UserController::class, 'profile']);

    Route::prefix('commission')->group(function () {

        Route::post('/payment', [CommissionPaymentController::class, 'store']);

        Route::get('/payments', [CommissionPaymentController::class, 'payments']);

        Route::get('/payments/created-by/{userId}', [CommissionPaymentController::class, 'paymentsCreatedBy']);

        Route::get('/summary/{userId}', [CommissionPaymentController::class, 'summary']);

        Route::get('/ledger/{userId}', [CommissionPaymentController::class, 'ledger']);

        Route::get('/my-commission', [CommissionPaymentController::class, 'myCommission']);

        Route::get('/leader/advisers-commission', [CommissionPaymentController::class, 'advisersCommission']);

        Route::get('/team-commission', [CommissionPaymentController::class, 'teamCommission']);

        Route::get('/leader-adviser-details', [CommissionPaymentController::class, 'leaderAdviserDetails']);

        Route::get('/booking-summary/{booking_id}', [CommissionPaymentController::class, 'leaderAdviserDetails']);
        
    });

    Route::post('/commission', [CommissionController::class, 'setCommission']);
    Route::put('/commission/{id}', [CommissionController::class, 'updateCommission']);
    Route::delete('/commission/{id}', [CommissionController::class, 'deleteCommission']);

    Route::get('/commissions', [CommissionController::class, 'index']);
    Route::get('/commissions/user/{userId}', [CommissionController::class, 'getByUser']);
    Route::get('/my-commissions', [CommissionController::class, 'myCommissions']);

    Route::get('/commission/{id}', [CommissionController::class, 'show']);
    Route::get('leader/{id}/bookings', [CommissionController::class, 'leaderBookings']);

    Route::post('/book-payments', [BookingPaymentController::class, 'store']);// Store payment

    Route::get('/book-payments/{booking_id}', [BookingPaymentController::class, 'getByBooking']);// Get payments by booking

    Route::get('/all-book-payments', [BookingPaymentController::class, 'index']);// Get all payments (admin)
    
    Route::get('/my-book-payments', [BookingPaymentController::class, 'myPayments']);// get users payments

        // referance
    Route::post('/referral-setting', [ReferralSettingController::class, 'store']);
    Route::get('/wallet', [ReferralController::class, 'wallet']);
    Route::get('/ledger', [ReferralController::class, 'ledger']);
});

Route::middleware('auth:sanctum')->get('/test-auth', function () {
    return response()->json(auth()->user());
});

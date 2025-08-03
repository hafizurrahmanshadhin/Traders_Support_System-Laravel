<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Pro\UserController;
use App\Http\Controllers\Api\UserAuthController;

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

Route::controller(UserAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

    // Resend Otp
    Route::post('resend-otp', [UserAuthController::class, 'resendOtp']);

    // Forget Password
    Route::post('forget-password', 'forgetPassword');
    Route::post('verify-otp-password', 'varifyOtpWithOutAuth');
    Route::post('reset-password', 'resetPassword');
});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::get('me', [UserAuthController::class, 'me']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);


    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::post('change-additional-info', [UserController::class, 'changeAdditionalInfo']);
    Route::post('change-bio-current-job-info', [UserController::class, 'changeBioCurrentJobInfo']);
    Route::post('change-key-skill-info', [UserController::class, 'changeKeySkillJobInfo']);


    // Get Notifications
    Route::get('/my-notifications', [UserController::class, 'getMyNotifications']);
    Route::get('/my-payments', [UserController::class, 'getMyPeyments']);
});



// Get All Occupoation
Route::get('/occupations', [HomeController::class, 'getOcupation']);

// Pro Subscriptions
Route::get('/pro-subscriptions', [HomeController::class, 'getProSubscriptions']);
Route::get('/tread-subscriptions', [HomeController::class, 'getTreadSubscriptions']);


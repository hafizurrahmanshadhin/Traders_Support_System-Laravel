<?php

use App\Http\Controllers\Api\Pro\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes For Pro
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

//  Get All Questions
// Route::controller(UserController::class)->group(function () {
    Route::get('/pro-questions', [UserController::class,'getAllQuestions']);
    Route::get('/pro-user-info', function () {
        return "fsa";
    });
// });

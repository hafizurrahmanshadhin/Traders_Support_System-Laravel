<?php

use App\Http\Controllers\Api\Pro\ExperenceController;
use App\Http\Controllers\Api\Pro\TicketsController;
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
Route::controller(UserController::class)->group(function () {
    Route::get('/pro-user-info', 'getDeshboardProUserInfo');
    Route::get('/pro-my-images', 'getMyImages');

    // Update User Information
    Route::post('/pro-update-user-info', 'updateUserInfo');

    // Questions & Answers
    Route::get('/pro-questions', 'getAllQuestions');
    Route::post('/pro-answers', 'storeUserAnswers');

    // User Images Store
    Route::post('/pro-images', 'storeUserImages');
    Route::post('/pro-images-delete', 'deleteUserImage');
});

// Experence Route
Route::controller(ExperenceController::class)->group(function () {
    Route::get('/my-experence', 'index');
    Route::post('/my-experence', 'store');
    Route::post('/my-experence/edit/{id}', 'update');
    Route::delete('/my-experence/delete/{id}', 'destroy');
});

Route::controller(TicketsController::class)->group(function () {

    Route::post('/ticket-store', 'store');
    Route::post('/pro-ticket-reply', 'reply');
    Route::get('/tickets/{ticket_id}/details', 'getTicketDetails');
    Route::get('/tickets/pending-list', 'getPendingTicketList');
    Route::get('/tickets/resolved-list', 'getResolvedTicketList');

});

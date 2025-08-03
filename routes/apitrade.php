<?php

use App\Http\Controllers\Api\Tread\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes For Tread
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

 //  Get All Questions
Route::controller(UserController::class)->prefix('trade')->group(function () {
    
    // My Profile Data
    Route::get('/my-profile', 'myProfile');
    Route::post('/update-profile', 'updateMyProfile');

    // Questions & Answers
    Route::get('/questions', 'getAllQuestions');
    Route::post('/answers', 'storeUserAnswers');


    // User Profile 
    Route::get('/pro-profile-list', 'proProfilesList');
    Route::get('/pro-profile/{user}', 'proProfile');

});

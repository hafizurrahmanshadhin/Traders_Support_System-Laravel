<?php

use App\Http\Controllers\Backend\Reply\ReplyController;
use App\Http\Controllers\Frontend\Pro\ProBoostController;
use App\Http\Controllers\Frontend\Pro\ProSubscriptionController;
use App\Http\Controllers\Frontend\Pro\ReplyController as ProReplyController;
use App\Http\Controllers\Frontend\Pro\TicketController;
use App\Http\Controllers\Frontend\Trade\TradeSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/demo-home', function () {
    return view('frontend.home');
});

Route::middleware(['auth', 'is_trade'])->group(function () {
    Route::get('/trade-frontend-subscription', [TradeSubscriptionController::class, 'index'])->name('trade.frontend.subscription');

    Route::get('/help', function () {
        return view('frontend.layouts.trade.joinning');
    })->name('help');
});

Route::middleware(['auth', 'is_pro'])->group(function () {

    Route::get('/pro-frontend-subscription', [ProSubscriptionController::class, 'index'])->name('pro.frontend.subscription');
    // Route::get('/pro-', [ProBoostController::class, 'index'])->name('pro.boost.index');

    //! Ticket Part Start
    Route::get('/pro-help', [TicketController::class, 'index'])->name('pro-help');
    Route::post('/pro-help', [TicketController::class, 'store'])->name('pro-help.store');
    Route::post('/pro-reply', [ProReplyController::class, 'store'])->name('pro-reply.store');

    //! Route for TicketController Backend
    Route::controller(ReplyController::class)->group(function () {
        Route::post('/reply/store', 'store')->name('admin.reply.store');
    });
});

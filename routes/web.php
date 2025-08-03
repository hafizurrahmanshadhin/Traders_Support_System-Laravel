<?php

use App\Events\SendNotification;
use App\Http\Controllers\Auth\JoinController;
use App\Http\Controllers\Auth\RoleSelectionController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\VerifyOtpController;
use App\Http\Controllers\Frontend\DynamicPageController;
use App\Http\Controllers\Frontend\FAQController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Pro\ProDashboardController;
use App\Http\Controllers\Frontend\Pro\ProProfileController;
use App\Http\Controllers\Frontend\QuestionnaireController;
use App\Http\Controllers\Frontend\SettingController;
use App\Http\Controllers\Frontend\Trade\TradeDashboardController;
use App\Http\Controllers\Frontend\Trade\TradeProfileController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

//! This route is for the home page
Route::get("/", [HomeController::class, "index"])->name("home");

Auth::routes();

//! This route is for the join page before the user can register
Route::get('/join', [JoinController::class, 'index'])->name('join');

//! Route for entering the email to receive OTP
Route::get('/request-otp', [VerifyOtpController::class, 'showRequestOtpForm'])->name('request.otp');
Route::post('/request-otp', [VerifyOtpController::class, 'sendOtpToEmail'])->name('send.otp');

//! Existing routes for verifying the OTP
Route::get('/verify-otp', [VerifyOtpController::class, 'showVerifyOtpForm'])->name('verify-email');
Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp'])->name('verify.otp');
Route::get('/resend-otp', [VerifyOtpController::class, 'resendOtp'])->name('resend.otp');

//! This 4 route is for logging in with Google
Route::get('/login/google', [SocialLoginController::class, 'googleRedirect'])->name('login.google');
Route::get('/login/google/callback', [SocialLoginController::class, 'googleCallback']);
Route::get('/select-role', [RoleSelectionController::class, 'showRoleSelection'])->name('selectRole');
Route::post('/complete-registration', [RoleSelectionController::class, 'completeRegistration'])->name('completeRegistration');

Route::middleware(['auth', 'is_pro'])->group(function () {
    Route::get('/pro-dashboard', [ProDashboardController::class, 'index'])->name('pro.dashboard')->middleware('verify.email');

    //! stripe payment for pro
    Route::post('/stripe/payment', [StripeController::class, 'payment'])->name('stripe.payment');
    Route::post('/boost/payment', [StripeController::class, 'boost_payment'])->name('boost.stripe.payment');
    // Route::get('/subscription/success', [StripeController::class, 'paymentSuccess'])->name('pro.frontend.subscription.success');

    //! handle payment success for pro
    Route::get('/stripe/payment/success', [StripeController::class, 'handlePaymentSuccess'])->name('stripe.payment.success');
    Route::get('/stripe/boost/payment/success', [StripeController::class, 'handleBoostPaymentSuccess'])->name('stripe.boost.payment.success');
});

Route::middleware(['auth', 'is_trade'])->group(function () {
    Route::get('/trade-dashboard', [TradeDashboardController::class, 'index'])->name('trade.dashboard')->middleware('verify.email');
    Route::get('/trade-profile/{user}', [TradeProfileController::class, 'index'])->middleware('view.limit')->name('trade.profile');

    //! stripe payment for trade
    Route::post('/trade/stripe/payment', [StripeController::class, 'trade_payment'])->name('trade.stripe.payment');

    //! handle payment success for trade
    Route::get('/trade/stripe/payment/success', [StripeController::class, 'handlePaymentSuccess'])->name('trade.stripe.payment.success');
});

//! This route is for the FAQ page
Route::get('/faqs', [FAQController::class, 'index'])->name('faq')->middleware('auth');

//! This route is for the settings page for pro and trde
Route::get('/settings', [SettingController::class, 'index'])->name('settings')->middleware('auth');

Route::get('/pusher', function () {
    return view('pusher');
});

Route::get('/sendpusher', function () {
    event(new SendNotification('hello world', 'my-channel', 'my-event'));
});

//! This route is for questions page
Route::get('/questionnaires', [QuestionnaireController::class, 'index'])->name('questionnaires')->middleware('auth');
Route::post('/questionnaires', [QuestionnaireController::class, 'store'])->name('questionnaires.store')->middleware('auth');
Route::get('/trade-questionnaires', [QuestionnaireController::class, 'tradeQuestion'])->name('trade.questionnaires')->middleware('auth');

Route::get('/pro-profile', [ProProfileController::class, 'index'])->name('pro.profile')->middleware('auth');
Route::post('/update-pro-profile', [ProProfileController::class, 'UpdateProfile'])->name('update.pro.profile')->middleware('auth');
Route::post('/update-experience', [ProProfileController::class, 'updateExperience'])->name('update.experience')->middleware('auth');

//! Transaction PDF download
Route::get('/transactions/{id}/download', [TransactionController::class, 'downloadReceipt'])->name('transactions.download');

//! This route is for showing not subscription page in message sidebar
Route::get('/not-subscribed', function () {
    return view('frontend.layouts.message');
})->name('not-subscribed');

//! This Route is for DynamicPageController
Route::get('/page/{page_slug}', [DynamicPageController::class, 'index'])->name('custom.page');

Route::post('/store-payment-method', [SettingController::class, 'storePaymentMethod'])->name('store.payment.method')->middleware('auth');


<?php

use App\Http\Controllers\AdminBoostTransactionController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\Backend\Boost\BoostController;
use App\Http\Controllers\Backend\ChooseBusinessController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\FindingThePerfectMatcheController;
use App\Http\Controllers\Backend\HelpBusinessController;
use App\Http\Controllers\Backend\QuestionnaireController;
use App\Http\Controllers\Backend\Reply\ReplyController;
use App\Http\Controllers\Backend\Settings\DynamicPageController;
use App\Http\Controllers\Backend\Settings\MailSettingController;
use App\Http\Controllers\Backend\Settings\ProfileController;
use App\Http\Controllers\Backend\Settings\SocialMediaController;
use App\Http\Controllers\Backend\Settings\StripeSettingController;
use App\Http\Controllers\Backend\Settings\SystemSettingController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\Ticket\TicketController;
use App\Http\Controllers\Backend\TradesmanSpecificController;
use App\Http\Controllers\Backend\transaction\AdminTransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'is_admin'])->group(function () {
    //! Route for DashboardController
    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');

    //! Route for ProfileController
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.setting');
    Route::post('/update-profile', [ProfileController::class, 'UpdateProfile'])->name('update.profile');

    //! Route for SystemSettingController
    Route::get('/system-setting', [SystemSettingController::class, 'index'])->name('system.index');
    Route::post('/system-setting', [SystemSettingController::class, 'update'])->name('system.update');

    //! Route for MailSettingController
    Route::get('/mail-setting', [MailSettingController::class, 'index'])->name('mail.setting');
    Route::post('/mail-setting', [MailSettingController::class, 'update'])->name('mail.update');

    //! Route for SocialMediaController
    Route::get('/social-media', [SocialMediaController::class, 'index'])->name('social.index');
    Route::post('/social-media', [SocialMediaController::class, 'update'])->name('social.update');
    Route::delete('/social-media/{id}', [SocialMediaController::class, 'destroy'])->name('social.delete');

    //! Route for DynamicpageController
    Route::controller(DynamicPageController::class)->group(function () {
        Route::get('/dynamic-page', 'index')->name('dynamic_page.index');
        Route::get('/dynamic-page/create', 'create')->name('dynamic_page.create');
        Route::post('/dynamic-page/store', 'store')->name('dynamic_page.store');
        Route::get('/dynamic-page/edit/{id}', 'edit')->name('dynamic_page.edit');
        Route::post('/dynamic-page/update/{id}', 'update')->name('dynamic_page.update');
        Route::get('/dynamic-page/status/{id}', 'status')->name('dynamic_page.status');
        Route::delete('/dynamic-page/destroy/{id}', 'destroy')->name('dynamic_page.destroy');
    });

    //! Route for StripeSettingController
    Route::get('/stripe-setting', [StripeSettingController::class, 'index'])->name('stripe.index');
    Route::post('/stripe-setting', [StripeSettingController::class, 'update'])->name('stripe.update');

    //! Route for FAQController Backend
    Route::controller(FAQController::class)->group(function () {
        Route::get('/faq', 'index')->name('faq.index');
        Route::get('/faq/create', 'create')->name('faq.create');
        Route::post('/faq/store', 'store')->name('faq.store');
        Route::get('/faq/edit/{id}', 'edit')->name('faq.edit');
        Route::put('/faq/update/{id}', 'update')->name('faq.update');
        Route::get('/faq/status/{id}', 'status')->name('faq.status');
        Route::delete('/faq/destroy/{id}', 'destroy')->name('faq.destroy');
    });

    //! Route for QuestionnaireController Backend
    Route::controller(QuestionnaireController::class)->group(function () {
        Route::get('/questions', 'index')->name('questions.index');
        Route::get('/questions/{id}', 'show')->name('question.show');
        Route::post('/questions/store', 'store')->name('questions.store');
        Route::get('/questions/{id}/edit', 'edit')->name('questions.edit');
        Route::put('/questions/{id}', 'update')->name('questions.update');
        Route::get('/questions/status/{id}', 'status')->name('questions.status');
        Route::delete('/questions/destroy/{id}', 'destroy')->name('questions.destroy');
    });

    //! Route for TestimonialController Backend
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/testimonial', 'index')->name('testimonial.index');
        Route::get('/testimonial/create', 'create')->name('testimonial.create');
        Route::post('/testimonial/store', 'store')->name('testimonial.store');
        Route::get('/testimonial/edit/{id}', 'edit')->name('testimonial.edit');
        Route::put('/testimonial/update/{id}', 'update')->name('testimonial.update');
        Route::get('/testimonial/status/{id}', 'status')->name('testimonial.status');
        Route::delete('/testimonial/destroy/{id}', 'destroy')->name('testimonial.destroy');
    });

    //! Route for TradesmanSpecificController
    Route::get('/tradesman-specific', [TradesmanSpecificController::class, 'index'])->name('tradesman.specific.index');
    Route::post('/tradesman-specific', [TradesmanSpecificController::class, 'update'])->name('tradesman.specific.update');

    //! Route for HelpBusinessController Backend
    Route::controller(HelpBusinessController::class)->group(function () {
        Route::get('/help-business', 'index')->name('help.business.index');
        Route::get('/help-business/create', 'create')->name('help.business.create');
        Route::post('/help-business/store', 'store')->name('help.business.store');
        Route::get('/help-business/edit/{id}', 'edit')->name('help.business.edit');
        Route::put('/help-business/update/{id}', 'update')->name('help.business.update');
        Route::get('/help-business/status/{id}', 'status')->name('help.business.status');
        Route::delete('/help-business/destroy/{id}', 'destroy')->name('help.business.destroy');
    });

    //! Route for FindingThePerfectMatcheController Backend
    Route::controller(FindingThePerfectMatcheController::class)->group(function () {
        Route::get('/partner-match', 'index')->name('partner.match.index');
        Route::get('/partner-match/create', 'create')->name('partner.match.create');
        Route::post('/partner-match/store', 'store')->name('partner.match.store');
        Route::get('/partner-match/edit/{id}', 'edit')->name('partner.match.edit');
        Route::put('/partner-match/update/{id}', 'update')->name('partner.match.update');
        Route::get('/partner-match/status/{id}', 'status')->name('partner.match.status');
        Route::delete('/partner-match/destroy/{id}', 'destroy')->name('partner.match.destroy');
    });

    //! Route for ChooseBusinessController Backend
    Route::controller(ChooseBusinessController::class)->group(function () {
        Route::get('/choose-business', 'index')->name('choose.business.index');
        Route::get('/choose-business/create', 'create')->name('choose.business.create');
        Route::post('/choose-business/store', 'store')->name('choose.business.store');
        Route::get('/choose-business/edit/{id}', 'edit')->name('choose.business.edit');
        Route::put('/choose-business/update/{id}', 'update')->name('choose.business.update');
        Route::get('/choose-business/status/{id}', 'status')->name('choose.business.status');
        Route::delete('/choose-business/destroy/{id}', 'destroy')->name('choose.business.destroy');
    });

    //! Route for TicketController Backend
    Route::controller(TicketController::class)->group(function () {
        Route::get('/ticket', 'index')->name('admin.ticket.index');
        Route::get('/ticket/create', 'create')->name('admin.ticket.create');
        Route::post('/ticket/store', 'store')->name('admin.ticket.store');
        Route::get('/ticket/edit/{id}', 'edit')->name('admin.ticket.edit');
        Route::put('/ticket/update/{id}', 'update')->name('admin.ticket.update');
        Route::get('/ticket/status/{id}', 'status')->name('admin.ticket.status');
        Route::delete('/ticket/destroy/{id}', 'destroy')->name('admin.ticket.destroy');
        Route::post('/update-status', 'updateStatus')->name('update.status');
        Route::get('/ticket/show/{id}', 'show')->name('admin.ticket.show');
    });

    //! Route for TicketController Backend
    Route::controller(ReplyController::class)->group(function () {
        Route::post('/reply/store', 'store')->name('admin.reply.store');
    });

    //! Route for Pro ProSubscriptionController Backend
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/admin-subscription', 'index')->name('admin.subscription.index');
        Route::get('/admin-subscription/create', 'create')->name('admin.subscription.create');
        Route::post('/admin-subscription/store', 'store')->name('admin.subscription.store');
        Route::get('/admin-subscription/edit/{id}', 'edit')->name('admin.subscription.edit');
        Route::put('/admin-subscription/update/{id}', 'update')->name('admin.subscription.update');
        Route::get('/admin-subscription/status/{id}', 'status')->name('admin.subscription.status');
        Route::delete('/admin-subscription/destroy/{id}', 'destroy')->name('admin.subscription.destroy');
    });

    //Admin Transaction Part
    Route::get('/admin-transaction', [AdminTransactionController::class, 'index'])
        ->name('admin.transaction');
    Route::get('/admin-transactions/{id}/download', [AdminTransactionController::class, 'downloadReceipt'])->name('admin.transactions.download');

    //Get Boost Transaction Part
    Route::get('/admin-boost-transaction', [AdminBoostTransactionController::class, 'index'])->name('admin.boost.transaction');



    //! Boost Part
    Route::controller(BoostController::class)->group(function () {
        Route::get('/admin-boost', 'index')->name('admin.boost.index');
        Route::get('/admin-boost/create', 'create')->name('admin.boost.create');
        Route::post('/admin-boost/store', 'store')->name('admin.boost.store');
        Route::get('/admin-boost/edit/{id}', 'edit')->name('admin.boost.edit');
        Route::put('/admin-boost/update/{id}', 'update')->name('admin.boost.update');
        Route::delete('/admin-boost/destroy/{id}', 'destroy')->name('admin.boost.destroy');
    });

    //Notification For Admin
    Route::get('/admin/notifications', [AdminNotificationController::class, 'showNotifications'])->name('admin.notifications.index');


});

//! This route is for updating the user's profile
Route::post('/update-profile-picture', [ProfileController::class, 'UpdateProfilePicture'])->name('update.profile.picture');
Route::post('/update-profile-password', [ProfileController::class, 'UpdatePassword'])->name('update.Password');

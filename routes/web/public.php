<?php

use App\Source\Public\App\Controllers\PublicController;
use App\Source\Ride\App\Controllers\RideController;

Route::get('/', [RideController::class, 'search'])->name('home');
Route::get('android', [PublicController::class, 'androidStore'])->name('android.store');
Route::get('iphone', [PublicController::class, 'iphoneStore'])->name('iphone.store');

Route::prefix('ride')->group(function () {
    Route::get('search', [RideController::class, 'search'])->name('ride.search');
});

Route::prefix('contact')->group(function () {
    Route::get('contact', [PublicController::class, 'contact'])->name('contact');
    Route::middleware('throttle:2,30')->post('send-message', [PublicController::class, 'sendMessage'])->name(
        'contact.send-message'
    );
});

Route::get('language/{locale}', [PublicController::class, 'changeLanguage'])->name('change.language');

//Route::get('/auth/redirect/{driver}', [SocialController::class, 'redirect'])->name('social_login.redirect');
//Route::get('/auth/callback/{driver}', [SocialController::class, 'callback'])->name('social_login.callback');

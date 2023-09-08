<?php

use App\Source\Public\App\Controllers\ContactController;
use App\Source\Public\App\Controllers\PublicController;
use App\Source\Ride\App\Controllers\RideController;

Route::get('/', [RideController::class, 'search'])->name('home');
Route::get('android', [PublicController::class, 'androidStore'])->name('android.store');
Route::get('iphone', [PublicController::class, 'iphoneStore'])->name('iphone.store');
Route::get('app', [PublicController::class, 'app'])->name('app.redirect');
Route::get('open-and-redirect/{route}', [PublicController::class, 'openAndRedirect'])->name('open-and-redirect');

Route::prefix('contact')->group(function () {
    Route::get('contact', [ContactController::class, 'contact'])->name('contact');
    Route::middleware('throttle:2,30')->post('send-message', [ContactController::class, 'sendMessage'])->name(
        'contact.send-message'
    );
});

Route::get('localization/{country}', [PublicController::class, 'changeLocalization'])->name('change.localization');
Route::get('end-game', [PublicController::class, 'endGame'])->name('endgame');

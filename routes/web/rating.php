<?php

use App\Source\Rating\App\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::prefix('rating')->group(function () {
    Route::get('/show/{rideId}', [RatingController::class, 'showRideRatings'])->name('rating.show-for-ride');
    Route::get('/show-for-user/{userId}', [RatingController::class, 'showUserRatings'])->name('rating.show-for-user');
    Route::post('/save', [RatingController::class, 'save'])->name('rating.save');
});

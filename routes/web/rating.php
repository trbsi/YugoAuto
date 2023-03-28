<?php

use App\Source\Rating\App\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::prefix('rating')->group(function () {
    Route::get('/show/{rideId}', [RatingController::class, 'show'])->name('rating.show');
    Route::post('/save', [RatingController::class, 'save'])->name('rating.save');
});

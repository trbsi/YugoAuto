<?php

use App\Source\Ride\App\Controllers\RideController;

Route::prefix('ride')->group(function () {
    Route::get('search', [RideController::class, 'search'])->name('ride.search');
});

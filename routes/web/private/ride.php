<?php

use App\Source\Ride\App\Controllers\RideController;
use Illuminate\Support\Facades\Route;

Route::prefix('ride')->group(function () {
    Route::get('create', [RideController::class, 'showCreate'])->name('ride.create');
    Route::post('save', [RideController::class, 'create'])->name('ride.save');
    Route::get('my', [RideController::class, 'myRides'])->name('ride.my-rides');
    Route::post('delete/{id}', [RideController::class, 'delete'])->name('ride.delete');
    Route::get('update/{id}', [RideController::class, 'showUpdate'])->name('ride.show-update');
    Route::post('update', [RideController::class, 'update'])->name('ride.update');
});

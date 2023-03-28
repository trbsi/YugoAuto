<?php

use App\Source\RideRequest\App\Controllers\RideRequestController;
use Illuminate\Support\Facades\Route;

Route::prefix('ride-request')->group(function () {
    Route::get('my-requests/{rideId}', [RideRequestController::class, 'myRequests'])->name(
        'ride-request.my-requests'
    );
    Route::post('pending/{rideId}', [RideRequestController::class, 'sendRequest'])->name(
        'ride-request.request-ride'
    );
    Route::post('cancel', [RideRequestController::class, 'cancelRequest'])->name(
        'ride-request.cancel'
    );
    Route::post('accept-reject', [RideRequestController::class, 'acceptOrReject'])->name(
        'ride-request.accept-reject'
    );
});

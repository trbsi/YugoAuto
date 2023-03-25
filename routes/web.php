<?php

use App\Source\Ride\App\Controllers\RideController;
use App\Source\RideRequest\App\Controllers\RideRequestController;
use App\Source\User\App\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// AUTH
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('ride')->group(function () {
        Route::get('create', [RideController::class, 'showCreate'])->name('ride.create');
        Route::post('save', [RideController::class, 'save'])->name('ride.save');
        Route::get('my', [RideController::class, 'myRides'])->name('ride.my-rides');
        Route::post('delete/{id}', [RideController::class, 'delete'])->name('ride.delete');
    });

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

    Route::prefix('user')->group(function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    });
});

//PUBLIC
Route::prefix('ride')->group(function () {
    Route::get('search', [RideController::class, 'search'])->name('ride.search');
});

Route::get('/', [RideController::class, 'search']);

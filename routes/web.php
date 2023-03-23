<?php

use App\Source\Ride\App\Controllers\RideController;
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
});

//PUBLIC
Route::prefix('ride')->group(function () {
    Route::get('search', [RideController::class, 'search'])->name('ride.search');
});

Route::get('/', [RideController::class, 'search']);

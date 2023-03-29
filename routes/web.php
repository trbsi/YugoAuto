<?php

use App\Source\Public\App\Controllers\PublicController;
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


// AUTH
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    require_once __DIR__ . '/web/ride.php';
    require_once __DIR__ . '/web/ride-request.php';
    require_once __DIR__ . '/web/user.php';
    require_once __DIR__ . '/web/messaging.php';
    require_once __DIR__ . '/web/rating.php';
});

//PUBLIC
Route::get('/', [RideController::class, 'search'])->name('home');

Route::prefix('ride')->group(function () {
    Route::get('search', [RideController::class, 'search'])->name('ride.search');
});

Route::prefix('contact')->group(function () {
    Route::get('contact', [PublicController::class, 'contact'])->name('contact');
    Route::post('send-message', [PublicController::class, 'sendMessage'])->name('contact.send-message');
});

//Route::get('/auth/redirect/{driver}', [SocialController::class, 'redirect'])->name('social_login.redirect');
//Route::get('/auth/callback/{driver}', [SocialController::class, 'callback'])->name('social_login.callback');


<?php

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
    require __DIR__ . '/web/private/auth.php';
    require __DIR__ . '/web/private/ride.php';
    require __DIR__ . '/web/private/ride-request.php';
    require __DIR__ . '/web/private/user.php';
    require __DIR__ . '/web/private/messaging.php';
    require __DIR__ . '/web/private/rating.php';
    require __DIR__ . '/web/private/push-token.php';
    require __DIR__ . '/web/private/report.php';
});

//PUBLIC
require __DIR__ . '/web/public/public.php';
require __DIR__ . '/web/public/auth.php';
require __DIR__ . '/web/public/ride.php';
require __DIR__ . '/web/public/staging.php';

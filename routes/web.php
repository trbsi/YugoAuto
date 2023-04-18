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
    require __DIR__ . '/web/auth.php';
    require __DIR__ . '/web/ride.php';
    require __DIR__ . '/web/ride-request.php';
    require __DIR__ . '/web/user.php';
    require __DIR__ . '/web/messaging.php';
    require __DIR__ . '/web/rating.php';
    require __DIR__ . '/web/push-token.php';
    require __DIR__ . '/web/report.php';
});

//PUBLIC
require __DIR__ . '/web/public.php';

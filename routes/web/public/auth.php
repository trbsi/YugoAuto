<?php

use App\Source\Auth\App\Controllers\VerifyEmailController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\RoutePath;

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

//Route::get('/auth/redirect/{driver}', [SocialController::class, 'redirect'])->name('social_login.redirect');
//Route::get('/auth/callback/{driver}', [SocialController::class, 'callback'])->name('social_login.callback');

Route::post(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'store'])
    ->middleware(
        [
            'guest:' . config('fortify.guard'),
            'throttle:registration-limiter'
        ]
    );

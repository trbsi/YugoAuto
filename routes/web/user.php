<?php

use App\Source\User\App\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
});

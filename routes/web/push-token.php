<?php

use App\Source\PushToken\App\Controllers\PushTokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('push-token')->group(function () {
    Route::post('', [PushTokenController::class, 'create'])->name('push-token.create');
});

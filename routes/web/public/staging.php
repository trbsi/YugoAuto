<?php

use App\Source\Public\App\Controllers\StagingController;

Route::prefix('staging')->group(function () {
    Route::get('setcookie', [StagingController::class, 'setCookie'])->name('staging.setcookie');
});

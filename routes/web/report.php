<?php

use App\Source\Report\App\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('report')->group(function () {
    Route::post('', [ReportController::class, 'report'])->name('report.user');
});

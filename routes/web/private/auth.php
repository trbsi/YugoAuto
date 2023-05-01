<?php

use App\Source\Auth\App\Controllers\VerifyPhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::prefix('phone-number')->group(function () {
    Route::get('/verify', [VerifyPhoneNumberController::class, 'showForm'])->name('phone-verification.show');
    Route::post('/verify/{type}', [VerifyPhoneNumberController::class, 'verifyPhoneNumber'])->name(
        'phone-verification.verify-phone'
    );
    Route::post('/can-verify', [VerifyPhoneNumberController::class, 'canVerify'])->name(
        'phone-verification.can-verify'
    );
    Route::post('/log-error', [VerifyPhoneNumberController::class, 'logVerificationError'])->name(
        'phone-verification.log-error'
    );
});


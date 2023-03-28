<?php

use App\Source\Messaging\App\Controllers\ConversationController;
use App\Source\Messaging\App\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('messaging')->group(function () {
    Route::prefix('conversation')->group(function () {
        Route::get('/list', [ConversationController::class, 'list'])->name('messaging.conversation.list');
        Route::get('/create/{userId}', [ConversationController::class, 'createForm'])->name(
            'messaging.conversation.create-form'
        );
        Route::post('/create-conversation', [ConversationController::class, 'create'])->name(
            'messaging.conversation.create'
        );
    });

    Route::prefix('message')->group(function () {
        Route::get('/single/{id}', [MessageController::class, 'list'])->name('messaging.message.single');
        Route::post('/send', [MessageController::class, 'send'])->name('messaging.message.send');
    });
});

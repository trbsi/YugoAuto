<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the conversations table
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('recipient_id')->constrained('users');
            $table->tinyInteger('sender_read')->default(1);
            $table->tinyInteger('recipient_read')->default(1);
            $table->unique(['sender_id', 'recipient_id']);
            $table->unique(['recipient_id', 'sender_id']);
            $table->timestamps();
        });

        // Create the messages table
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations');
            $table->foreignId('sender_id')->constrained('users');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
    }
};

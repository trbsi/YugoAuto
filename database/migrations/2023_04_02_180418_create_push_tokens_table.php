<?php

use App\Models\PushToken;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('push_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('platform', [PushToken::PLATFORM_IOS, PushToken::PLATFORM_ANDROID]);
            $table->string('device_id', 32);
            $table->string('token', 200);
            $table->enum('token_type', PushToken::getTokenTypes())
                ->default(PushToken::TOKEN_TYPE_FIREBASE);
            $table->timestamp('last_push_sent_at')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'token_type']);
            $table->unique(['user_id', 'platform', 'device_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('push_tokens');
    }
};

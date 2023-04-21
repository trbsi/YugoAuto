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
        Schema::table('push_tokens', function (Blueprint $table) {
            $table->string('device_id', 128)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('push_tokens', function (Blueprint $table) {
            $table->string('device_id', 32)->change();
        });
    }
};

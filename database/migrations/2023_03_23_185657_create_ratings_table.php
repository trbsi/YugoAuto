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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')->constrained('rides');
            $table->foreignId('driver_id')->constrained('users');
            $table->tinyInteger('driver_rating')->default(0)->comment('Given by passenger');
            $table->string('driver_comment', 500)->nullable()->comment('Given by passenger');

            $table->foreignId('passenger_id')->constrained('users');
            $table->tinyInteger('passenger_rating')->default(0)->comment('Given by driver');
            $table->string('passenger_comment', 500)->nullable()->comment('Given by driver');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};

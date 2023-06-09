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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users');
            $table->foreignId('from_place_id')->constrained('places');
            $table->foreignId('to_place_id')->constrained('places');
            $table->datetime('time');
            $table->integer('price');
            $table->string('currency')->default('EUR');
            $table->integer('number_of_seats');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['from_place_id', 'to_place_id', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};

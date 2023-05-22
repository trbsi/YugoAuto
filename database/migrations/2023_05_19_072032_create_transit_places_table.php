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
        Schema::create('transit_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')
                ->nullable()
                ->constrained('rides')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('to_place_id')
                ->nullable()
                ->constrained('places')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_places');
    }
};

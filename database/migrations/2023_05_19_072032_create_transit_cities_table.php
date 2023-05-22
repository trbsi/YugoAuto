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
        Schema::create('transit_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                ->nullable()
                ->constrained('places')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('ride_id')
                ->nullable()
                ->constrained('rides')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_cities');
    }
};

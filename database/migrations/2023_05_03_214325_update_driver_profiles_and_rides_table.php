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
        Schema::table('driver_profiles', function (Blueprint $table) {
            $table->text('additional_cars')->after('car_plate')->nullable();
        });

        Schema::table('rides', function (Blueprint $table) {
            $table->string('car', 50)
                ->after('is_accepting_package')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driver_profiles', function (Blueprint $table) {
            $table->dropColumn('additional_cars');
        });

        Schema::table('rides', function (Blueprint $table) {
            $table->dropColumn('car');
        });
    }
};

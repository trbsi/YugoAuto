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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->integer('total_rides_count')
                ->default(0)
                ->after('pending_requests_count');
            
            $table->integer('last_minute_cancelled_rides_count')
                ->default(0)
                ->after('total_rides_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'total_rides_count',
                    'last_minute_cancelled_rides_count'
                ]
            );
        });
    }
};

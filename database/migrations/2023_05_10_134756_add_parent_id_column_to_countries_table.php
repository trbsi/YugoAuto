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
        Schema::table('countries', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->after('locale')
                ->nullable()
                ->constrained('countries')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->string('locale', 10)->change();
            $table->string('name', 30)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->string('locale', 2)->change();
            $table->string('name', 100)->change();
        });
    }
};

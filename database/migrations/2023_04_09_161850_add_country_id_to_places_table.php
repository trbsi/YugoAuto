<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $country = $this->addCountry();

        Schema::table('places', function (Blueprint $table) use ($country) {
            $table->foreignId('country_id')
                ->after('name')
                ->default($country->getId())
                ->constrained('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });
    }

    private function addCountry(): Country
    {
        $model = new Country();
        $model
            ->setName('Croatia')
            ->save();

        return $model;
    }
};

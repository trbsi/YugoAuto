<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = file_get_contents(__DIR__ . '/data/places.json');
        $data = json_decode($data, true);

        foreach ($data as $place) {
            Place::factory()
                ->state([
                    'name' => $place['city']
                ])->create();
        }
    }
}

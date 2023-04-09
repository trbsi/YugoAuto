<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Place;
use Illuminate\Database\QueryException;
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
            try {
                $country = Country::query()
                    ->firstOrCreate(
                        [
                            'name' => $place['country']
                        ]
                    );

                Place::factory()
                    ->state([
                        'name' => $place['city'],
                        'country_id' => $country->getId()
                    ])->create();
            } catch (QueryException $exception) {
                //unique key exception
            }
        }
    }
}

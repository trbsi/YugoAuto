<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Place;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/data/'));

        /** @var SplFileInfo $file */
        foreach ($rii as $file) {
            if ($file->isDir()) {
                continue;
            }

            $data = file_get_contents($file->getPathname());
            $data = json_decode($data, true);

            foreach ($data as $place) {
                try {
                    $country = Country::query()
                        ->updateOrCreate(
                            [
                                'name' => $place['country']
                            ],
                            [
                                'code' => $place['iso2']
                            ]
                        );

                    if (isset($place['population']) && $place['population'] < 10000) {
                        continue;
                    }

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
}

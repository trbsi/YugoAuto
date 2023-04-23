<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryData = json_decode(file_get_contents(__DIR__ . '/data/country_data.json'), true);

        foreach ($countryData as $countryName => $data) {
            Country::query()
                ->updateOrCreate(
                    [
                        'name' => $countryName
                    ],
                    [
                        'code' => $data['iso2'],
                        'currency' => $data['currency'],
                        'locale' => $data['locale'],
                    ]
                );
        }
    }
}

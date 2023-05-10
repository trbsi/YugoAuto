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
            $parentCountry = null;
            if (isset($data['parent'])) {
                $parentCountry = Country::where('name', $data['parent'])->first();
            }

            Country::query()
                ->updateOrCreate(
                    [
                        'name' => $countryName
                    ],
                    [
                        'code' => $data['iso2'],
                        'currency' => $data['currency'],
                        'locale' => $data['locale'],
                        'parent_id' => $parentCountry ? $parentCountry->getId() : null
                    ]
                );
        }
    }
}

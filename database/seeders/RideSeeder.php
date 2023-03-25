<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //For main user
        for ($i = 0; $i < 100; $i++) {
            $time = ($i === 0) ? Carbon::now()->addDay() : Carbon::now()->subDay();

            Ride::factory()->state(
                [
                    'driver_id' => User::first()->getId(),
                    'from_place_id' => Place::where('name', 'Zagreb')->first()->getId(),
                    'to_place_id' => Place::where('name', 'Split')->first()->getId(),
                    'time' => $time
                ]
            )->create();
        }

        //for second user
        for ($i = 0; $i < 5; $i++) {
            $time = ($i === 0) ? Carbon::now()->addDay() : Carbon::now()->subDay();

            Ride::factory()->state(
                [
                    'driver_id' => User::where('id', 2)->first()->getId(),
                    'from_place_id' => Place::where('name', 'Đakovo')->first()->getId(),
                    'to_place_id' => Place::where('name', 'Osijek')->first()->getId(),
                    'time' => $time
                ]
            )->create();
        }
    }
}

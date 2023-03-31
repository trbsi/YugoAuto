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
        foreach (User::get() as $user) {
            for ($i = 0; $i < 10; $i++) {
                $time = ($i === 0) ? Carbon::now()->addDays(rand(1, 10)) : Carbon::now()->subDays(rand(1, 10));

                Ride::factory()->state(
                    [
                        'driver_id' => $user->getId(),
                        'from_place_id' => Place::where('name', 'Zagreb')->first()->getId(),
                        'to_place_id' => Place::where('name', 'Split')->first()->getId(),
                        'time' => $time->addMinutes(rand(1, 10))
                    ]
                )->create();
            }
        }
    }
}

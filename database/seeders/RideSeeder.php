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
        for ($i = 0; $i < 100; $i++) {
            Ride::factory()->state(
                [
                    'user_id' => User::first()->getId(),
                    'from_place_id' => Place::where('name', 'Zagreb')->first()->getId(),
                    'to_place_id' => Place::where('name', 'Split')->first()->getId(),
                    'time' => Carbon::now()
                ]
            )->create();
        }
    }
}

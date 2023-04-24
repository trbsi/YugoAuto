<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Ride;
use App\Models\User;
use App\Models\UserProfile;
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
                $now = Carbon::now()->setTimezone('Europe/Zagreb');
                $time = ($i === 0) ? $now->addDays(rand(1, 10)) : $now->subDays(rand(1, 10));

                Ride::factory()->state(
                    [
                        'driver_id' => $user->getId(),
                        'from_place_id' => Place::where('name', 'Zagreb')->first()->getId(),
                        'to_place_id' => Place::where('name', 'Split')->first()->getId(),
                        'time' => $time->addMinutes(rand(1, 10)),
                        'time_utc' => $now->utc(),
                    ]
                )->create();

                $userProfile = UserProfile::where('user_id', $user->getId())->first();
                $userProfile
                    ->increaseTotalRidesCount()
                    ->save();
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class RideRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Ride $ride */
        foreach (Ride::get() as $ride) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                RideRequest::factory()->state(
                    [
                        'user_id' => User::inRandomOrder()->where('id', '>', 1)->first()->getId(),
                        'ride_id' => $ride->getId(),
                    ]
                )->create();
            }
        }
    }
}

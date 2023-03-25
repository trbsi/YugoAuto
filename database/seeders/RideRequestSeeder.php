<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class RideRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainUser = User::first();
        /** @var Ride $ride */
        foreach (Ride::get() as $ride) {
            if ($ride->getDriverId() === $mainUser->getId()) {
                for ($i = 0; $i < rand(1, 5); $i++) {
                    try {
                        RideRequest::factory()->state(
                            [
                                'passenger_id' => User::inRandomOrder()->where('id', '>', 1)->first()->getId(),
                                'ride_id' => $ride->getId(),
                            ]
                        )->create();
                    } catch (QueryException $exception) {
                        //duplicate entry
                    }
                }
            } else {
                RideRequest::factory()->state(
                    [
                        'passenger_id' => $mainUser->getId(),
                        'ride_id' => $ride->getId(),
                    ]
                )->create();
            }
        }
    }
}

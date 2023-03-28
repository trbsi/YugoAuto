<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\User;
use App\Source\RideRequest\Enum\RideRequestEnum;
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
            //request ride for the main user
            if ($ride->getDriverId() === $mainUser->getId()) {
                for ($i = 0; $i < rand(1, 5); $i++) {
                    try {
                        $passenger = User::inRandomOrder()->where('id', '>', 1)->first();
                        $rideRequest = RideRequest::factory()->state(
                            [
                                'passenger_id' => $passenger->getId(),
                                'ride_id' => $ride->getId(),
                            ]
                        )->create();

                        if ($rideRequest->getStatus() === RideRequestEnum::ACCEPTED->value) {
                            Rating::factory()
                                ->state(
                                    [
                                        'ride_id' => $ride->getId(),
                                        'driver_id' => $ride->getDriverId(),
                                        'passenger_id' => $passenger->getId(),
                                    ]
                                )->create();
                        }
                    } catch (QueryException $exception) {
                        //duplicate entry
                    }
                }
            } //act as main user requested a ride
            else {
                $rideRequest = RideRequest::factory()->state(
                    [
                        'passenger_id' => $mainUser->getId(),
                        'ride_id' => $ride->getId(),
                    ]
                )->create();

                if ($rideRequest->getStatus() === RideRequestEnum::ACCEPTED->value) {
                    Rating::factory()
                        ->state(
                            [
                                'ride_id' => $ride->getId(),
                                'driver_id' => $ride->getDriverId(),
                                'passenger_id' => $mainUser->getId(),
                            ]
                        )->create();
                }
            }
        }
    }
}

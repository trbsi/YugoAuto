<?php

namespace Database\Factories;

use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RideRequest>
 */
class RideRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(RideRequestEnum::values())
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ride>
 */
class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(1, 100),
            'number_of_seats' => $this->faker->numberBetween(1, 3),
            'currency' => 'EUR',
            'is_accepting_package' => $this->faker->boolean()
        ];
    }
}

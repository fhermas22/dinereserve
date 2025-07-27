<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Table ' . $this->faker->unique()->numberBetween(1, 50),
            'capacity' => $this->faker->numberBetween(2, 8),
            'location' => $this->faker->randomElement(['Terrasse', 'Salon', 'Bar', 'Jardin']),
            'description' => $this->faker->sentence(),
            'is_available' => $this->faker->boolean(80),
        ];
    }
}

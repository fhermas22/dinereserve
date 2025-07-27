<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'table_id' => Table::factory(),
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'reservation_time' => $this->faker->time('H:i'),
            'party_size' => $this->faker->numberBetween(1, 8),
            'special_requests' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->safeEmail(),
            'customer_phone' => $this->faker->optional()->phoneNumber(),
        ];
    }
}

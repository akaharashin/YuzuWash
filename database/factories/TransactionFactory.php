<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'order_id' => $faker->numberBetween(1, 12),
            'user_id' => 1,
            'uniqcode' => 'INV-'. Str::random(8),
            'cash' => $faker->randomElement([75000, 125000, 275000,100000, 250000, 300000]),
            'change' => $faker->randomElement([25000, 75000]),
            'created_at' => $faker->dateTimeBetween('2024-01-01', 'now')
        ];
    }
}

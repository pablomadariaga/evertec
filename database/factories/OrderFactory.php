<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reference' => fake()->words(1, true),
            'request_id' => fake()->numberBetween(20000, 150000),
            'process_url' => fake()->url(),
            'order_state_id' => 1,
            'customer_id' => 1,
            'total' => fake()->numberBetween(20000, 150000)
        ];
    }
}

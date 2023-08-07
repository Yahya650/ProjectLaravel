<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nameComputer' => fake()->name(),
            'originComputer' => fake()->country(),
            'priceComputer' => fake()->numberBetween(199,1999),
            'imageComputer' => 'ComputersImages/p1vqjTX1LKEYFDLH8j58dINcWfUHwS9SWDIdEKdj.jpg',
            'user_id' => 1,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "subject" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "status" => fake()->randomElement(['Open', 'In Progress', 'Closed']),

            "category_id" => Category::factory(),
            "created_by_id" => User::factory(),
            "assigned_to_id" => User::factory()->admin(),
        ];
    }
}


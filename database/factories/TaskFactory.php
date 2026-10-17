<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 month', '+1 month');
        $end = (clone $start)->modify('+'.fake()->numberBetween(1, 10).' days');

        return [
            'user_id' => User::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['done', 'doing', 'not started']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'startTime' => $start->format('Y-m-d'),
            'endTime' => $end->format('Y-m-d'),
        ];
    }
}

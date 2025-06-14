<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDateTime = $this->faker->dateTimeBetween('now', '+2 months');
        $endDateTime = (clone $startDateTime)->modify('+' . $this->faker->numberBetween(1, 4) . ' hours');

        return [
            'description' => $this->faker->sentence(3),
            'location' => $this->faker->address(),
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'repeat_pattern' => $this->faker->randomElement(['none', 'daily', 'weekly', 'monthly', 'yearly']),
            'status_id' => $this->faker->numberBetween(1, 3), // Assuming you have statuses 1-3
            'user_id' => $this->faker->numberBetween(1, 5), // Assuming you have users 1-5
            'task_id' => $this->faker->numberBetween(1, 5), // Assuming you have users 1-5
        ];
    }
}

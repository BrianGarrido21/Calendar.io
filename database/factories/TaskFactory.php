<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dueDate = $this->faker->dateTimeBetween('now', '+1 month');
        
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'due_date' => $dueDate,
            'event_id' => 1,
            'status_id' => Status::inRandomOrder()->first()->id ?? Status::factory(),
        ];
    }

    /**
     * Indicate that the task is overdue.
     */
    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Indicate that the task is due soon (within 3 days).
     */
    public function dueSoon(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => $this->faker->dateTimeBetween('now', '+3 days'),
        ]);
    }

    /**
     * Indicate that the task is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_id' => Status::where('name', 'Completed')->first()->id,
        ]);
    }
}

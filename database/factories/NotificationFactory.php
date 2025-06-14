<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reminderTime = $this->faker->dateTimeBetween('now', '+1 week');
        
        return [
            'reminder_time' => $reminderTime,
            'message' => $this->faker->sentence(10),
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
        ];
    }

    /**
     * Indicate that the notification is for an upcoming event.
     */
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'reminder_time' => $this->faker->dateTimeBetween('now', '+1 day'),
            'message' => 'Reminder: You have an upcoming event tomorrow!',
        ]);
    }

    /**
     * Indicate that the notification is for a task due soon.
     */
    public function taskDue(): static
    {
        return $this->state(fn (array $attributes) => [
            'reminder_time' => $this->faker->dateTimeBetween('now', '+3 days'),
            'message' => 'Reminder: You have a task due soon!',
        ]);
    }

    /**
     * Indicate that the notification is for an event change.
     */
    public function eventChange(): static
    {
        return $this->state(fn (array $attributes) => [
            'reminder_time' => now(),
            'message' => 'Notice: An event you are attending has been modified.',
        ]);
    }
}

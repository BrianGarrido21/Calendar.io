<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Notification::factory()->count(5)->create();

        Notification::factory()->count(3)->upcoming()->create();

        Notification::factory()->count(2)->taskDue()->create();

        Notification::factory()->count(2)->eventChange()->create();
    }
}

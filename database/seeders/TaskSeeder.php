<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Task::factory()->count(5)->create();

        Task::factory()->count(3)->overdue()->create();

        Task::factory()->count(2)->dueSoon()->create();

        Task::factory()->count(4)->completed()->create();
    }
}

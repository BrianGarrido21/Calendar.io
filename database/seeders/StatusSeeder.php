<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Pending',
                'color' => '#FFA500', // Orange
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Confirmed',
                'color' => '#4CAF50', // Green
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cancelled',
                'color' => '#F44336', // Red
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Completed',
                'color' => '#2196F3', // Blue
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Postponed',
                'color' => '#9C27B0', // Purple
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('statuses')->insert($statuses);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            EventSeeder::class,
            TaskSeeder::class,
            NotificationSeeder::class,
            EventTagSeeder::class,
            CollaborationSeeder::class,
            AttachmentSeeder::class,
        ]);
    }
}

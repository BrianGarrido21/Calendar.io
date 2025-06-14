<?php

namespace Database\Seeders;

use App\Models\Collaboration;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class CollaborationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $events = Event::all();
        $users = User::all();
        $permissionLevels = [
            Collaboration::PERMISSION_READ,
            Collaboration::PERMISSION_WRITE,
            Collaboration::PERMISSION_ADMIN
        ];

        foreach ($events as $event) {
            $randomUsers = $users->random(rand(2, 4));
            
            foreach ($randomUsers as $user) {
                if ($event->user_id === $user->id) {
                    continue;
                }

                $permissionLevel = $permissionLevels[array_rand($permissionLevels)];

                Collaboration::create([
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    'permission_level' => $permissionLevel
                ]);
            }
        }
    }
} 
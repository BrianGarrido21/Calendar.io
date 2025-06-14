<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $events = Event::all();
        $tags = Tag::all();

        foreach ($events as $event) {
            $randomTags = $tags->random(rand(1, 3));
            
            foreach ($randomTags as $tag) {
                DB::table('event_tag')->insert([
                    'event_id' => $event->id,
                    'tag_id' => $tag->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
} 
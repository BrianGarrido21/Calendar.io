<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $attachments = [
            [
                'file_path' => 'attachments/meeting_notes.pdf',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'attachments/presentation.pptx',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'attachments/agenda.docx',
                'event_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'attachments/meeting_photo.jpg',
                'event_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('attachments')->insert($attachments);
    }
}

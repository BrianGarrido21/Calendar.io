<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Urgente',
                'color' => '#FF0000', // Rojo
            ],
            [
                'name' => 'Importante',
                'color' => '#FFA500', // Naranja
            ],
            [
                'name' => 'Normal',
                'color' => '#008000', // Verde
            ],
            [
                'name' => 'Baja Prioridad',
                'color' => '#0000FF', // Azul
            ],
            [
                'name' => 'Personal',
                'color' => '#800080', // Púrpura
            ],
            [
                'name' => 'Trabajo',
                'color' => '#808080', // Gris
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}

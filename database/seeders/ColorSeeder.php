<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color' => 'green-950' ],
            ['color' => 'green-800' ],
            ['color' => 'green-600' ],
            ['color' => 'green-400' ],
            ['color' => 'yellow-900' ],
            ['color' => 'yellow-700' ],
            ['color' => 'yellow-600' ],
            ['color' => 'yellow-400' ],
            ['color' => 'gray-800' ],
            ['color' => 'gray-600' ],
            ['color' => 'gray-500' ],
            ['color' => 'gray-400' ],
            ['color' => 'red-950' ],
            ['color' => 'red-800' ],
            ['color' => 'red-600' ],
            ['color' => 'red-500' ],
            ['color' => 'blue-950' ],
            ['color' => 'blue-800' ],
            ['color' => 'blue-700' ],
            ['color' => 'blue-600' ],
        ];

        // Crear cada color individualmente
        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}

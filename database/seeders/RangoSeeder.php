<?php

namespace Database\Seeders;

use App\Models\Rango;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RangoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rango::create([
            'nivel' => 'basico',
        ]);
    }
}

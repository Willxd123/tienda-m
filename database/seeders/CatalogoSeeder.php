<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Catalogo::create([
            'nombre' => 'Catalo 2024',
            'catalogo' => 'https://laravel-f.s3.amazonaws.com/catalogos/JXxuuqizRfVTJ5vt1atGghx2J3MjikIhy3t0jxq1.pdf',
        ]);

    }
}

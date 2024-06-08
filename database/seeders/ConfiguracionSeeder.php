<?php

namespace Database\Seeders;


use App\Models\Configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracion::create([
            'logotipo' => 'https://laravel-f.s3.amazonaws.com/configuracions/GENrS6K2qLy9iw41X1U88HJPwiqJq3H30Bdr8nha.png',
        ]);
    }

}

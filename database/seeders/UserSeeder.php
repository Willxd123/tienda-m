<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Promotor',
            'email' => 'prom@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('promotor');

    }
}

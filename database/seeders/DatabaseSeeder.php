<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Rango;
use App\Models\User;

use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //$role = Role::create(['name' => 'admin']);
        // User::factory(10)->create();
        $this->call([FamiliaSeeder::class,]);
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ConfiguracionSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(CatalogoSeeder::class);
        $this->call(ConfiguracionColorSeeder::class);
        /*User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('admin');*/

    }
}

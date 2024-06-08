<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ConfiguracionColor;

class ConfiguracionColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     */
    public function run()
    {
        ConfiguracionColor::create([
            'configuracion_id' => 1,
            'color_id' => 17,
        ]);
    }
}

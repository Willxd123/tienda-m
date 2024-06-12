<?php

namespace Database\Seeders;

use App\Models\Rango;
use Illuminate\Database\Seeder;

class RangoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rangos = [
            [
                'nivel' => 'Comerciante Novato',
                'descuento' => '0.0',
                'compras_minimas' => '0.0',
            ],
            [
                'nivel' => 'Comerciante Avanzado',
                'descuento' => '5.0',
                'compras_minimas' => '100.0',
            ],
            [
                'nivel' => 'Comerciante Experto',
                'descuento' => '10.0',
                'compras_minimas' => '500.0',
            ],
            [
                'nivel' => 'Comerciante Maestro',
                'descuento' => '15.0',
                'compras_minimas' => '1000.0',
            ],
            [
                'nivel' => 'Comerciante Gran Maestro',
                'descuento' => '20.0',
                'compras_minimas' => '5000.0',
            ],
            [
                'nivel' => 'Comerciante Épico',
                'descuento' => '25.0',
                'compras_minimas' => '10000.0',
            ],
            [
                'nivel' => 'Comerciante Legendario',
                'descuento' => '30.0',
                'compras_minimas' => '20000.0',
            ],
            [
                'nivel' => 'Comerciante Mítico',
                'descuento' => '35.0',
                'compras_minimas' => '50000.0',
            ],
        ];

        foreach ($rangos as $rango) {
            Rango::create($rango);
        }
    }
}

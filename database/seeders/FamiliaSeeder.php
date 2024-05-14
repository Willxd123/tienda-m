<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Familia;
use App\Models\Subcategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $familias = [
            'Tecnología' => [
                'Televisores' => [ 
                    'Accesorios para TV',
                    'OLED',
                    'Otros',
                ],
                'Celulares' => [ 
                    'Accesorios',                  
                    'Celulares y Smartphones',                  
                    'Smartwatch',
                ],
                'Computación' => [ 
                    'Laptops',
                    'Monitores',
                    'Mouse y teclados',
                    'Proyectores',
                ],
                'Audio' => [             
                    'Audífonos',  
                    'Parlantes',
                ],
            ],
            'Electrohogar' => [
                'Refrigeración' => [ 
                    'Frigobar',
                    'Refrigeradoras',
                ],
                'Cocina' => [ 
                    'Cocinas',
                    'Microondas',
                    'Otros',
                ],
                'Electrodomestico' => [ 
                    'Cafeteras',
                    'Licuadoras',
                    'Otros',
                ]
            ],
            'Muebles' => [
                'Comedor' => [
                    'Mesas',
                    'Otros',
                    'Sillas',
                ],
                'Dormitorio' => [
                    'Cómodas',
                    'Otros',
                    'Veladores',
                ],
                'Oficina' => [
                    'Escritorios',
                    'Otros',
                ],
                'Sala' => [
                    'Otros',
                    'Sofás',
                ],
            ],
            
        ];

        foreach ($familias as $familia => $categorias) {
            $familia = Familia::create([
                'nombre' => $familia,
            ]);

            foreach ($categorias as $categoria => $subcategorias) {
                $categoria = Categoria::create([
                    'nombre' => $categoria,
                    'familia_id' => $familia->id,
                ]);
                foreach ($subcategorias as $subcategoria) {
                    Subcategoria::create([
                        'nombre' => $subcategoria,
                        'categoria_id' => $categoria->id,
                    ]);
                }
            }
        }
    }
}

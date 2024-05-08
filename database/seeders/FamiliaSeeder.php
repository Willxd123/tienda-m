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
                    'LED',
                    'OLED',
                    'Otros',
                    'Proyectores',
                    'Insumos para TV',
                    'Televisores LGS'
                ],
                'Celulares' => [
                    'Accesorios',
                    'Audifonos',
                    'Baterías externas',
                    'Carcasas y láminas',
                    'Celulares y Smartphones',
                    'Reacondicionados',
                    'Smartwatch',
                    'Tarjeta de memoria',
                    'Telefonía inalámbricos',
                ],
                'Computación' => [
                    'Accesorios',
                    'Almacenamiento',
                    'Computadores de escritorio',
                    'Impresoras y Scanners',
                    'Laptops',
                    'Monitores',
                    'Otros',
                    'Software',
                    'Tablets',
                    'Todo computación',
                    'Camara web',
                    'Mouse y teclados',
                    'Audio y parlantes',
                    'Router y redes',
                ],
                'Videojuegos' => [
                    'Accesorios',
                    'Consolas',
                    'Nintendo',
                    'Otros',
                    'Playstation',
                    'Juegos',
                    'Mandos',
                    'Xbox'
                ],
                'Gaming' => [
                    'Juegos',
                    'Laptops gamer',
                    'Otros',
                    'PC gamer',
                    'Sillas gamer',
                    'Micrófonos gamer',
                    'Mouse gamer',
                    'Combos gamer',
                    'Teclados gamer',
                    'Audífonos gamer',
                ],
                'Audio' => [
                    'Accesorios',
                    'Audífonos',
                    'Equipos de sonido',
                    'Instrumentos musicales',
                    'Parlantes',
                    'Soundbar y Home Theater',
                    'Autoradios',
                    'Equipos de DJ',
                ],
                'Smart Home y domótica' => [
                    'Cocina smart',
                    'Iluminación inteligente',
                    'Seguridad inteligente',
                    'Camaras de seguridad',
                    'Enchufes inteligentes',
                    'Parlantes inteligentes',
                ],
                'Fotografía y video' => [
                    'Camararas acuáticas',
                    'Camaras compactas',
                    'Camaras de video',
                    'Drones',
                    'Lentes y accesorios',
                ],
                'Insumos para impresión' => [
                    'tintas',
                    'toners',
                ],
            ],
            'Electrohogar' => [
                'Refrigeración' => [
                    'Congeladores',
                    'Enfriadores de agua',
                    'Frigobar',
                    'Refrigeradoras',
                    'Vineras',
                ],
                'Cocina' => [
                    'Cocinas',
                    'Hornos',
                    'Microondas',
                    'Otros',
                    'Planchas',
                    'Refractarios',
                    'Sartenes',
                    'Vajillas',
                ],
                'Lavado' => [
                    'Centro de lavado',
                    'Lavadoras',
                    'Lavasecas',
                    'Otros',
                    'Secadoras',
                ],
                'Climatización' => [
                    'Aires acondicionados',
                    'Calefacción',
                    'Climatizadores',
                    'Otros',
                    'Ventiladores',
                ],
                'Limpieza' => [
                    'Aspiradoras',
                    'Otros',
                    'Planchas a vapor',
                    'Robot aspiradoras',
                ],
                'Electrodomestico' => [
                    'Batidoras',
                    'Cafeteras',
                    'Extractores',
                    'Licuadoras',
                    'Otros',
                    'Ollas arroceras',
                    'Sanducheras',
                    'Tostadoras',
                ]
            ],
            'Mejoramiento del Hogar' => [
                'Automotriz' => [
                    'Accesorios',
                    'Audio',
                    'Cargadores',
                    'Otros',
                    'Parlantes',
                    'Reproductores',
                ],
                'Ferretería' => [
                    'Cerrajería',
                    'Electricidad',
                    'Gasfitería',
                    'Iluminación',
                    'Jardinería',
                    'Otros',
                    'Seguridad',
                ],
                'Herramientas eléctricas' => [
                    'Atornilladores',
                    'Caladoras',
                    'Cepillos',
                    'Compresores',
                    'Cortadoras',
                    'Esmeriles',
                    'Lijadoras',
                    'Otros',
                    'Pistolas de calor',
                    'Pulidoras',
                    'Sierras',
                    'Taladros',
                ],
                'Herramientas manuales' => [
                    'Alicates',
                    'Cinceles',
                    'Cortadores',
                    'Destornilladores',
                    'Llaves',
                    'Martillos',
                    'Otros',
                    'Pinzas',
                    'Sierras',
                    'Taladros',
                ],
                'Pinturas' => [
                    'Brochas',
                    'Otros',
                    'Pinturas',
                    'Rodillos',
                ],
                'Medición y trazado' => [
                    'Cintas métricas',
                    'Escuadras',
                    'Flexómetros',
                    'Niveles',
                    'Otros',
                    'Plomadas',
                    'Reglas',
                ],
            ],
            'Hogar' => [
                'Baño' => [
                    'Accesorios',
                    'Alfombras',
                    'Cortinas',
                    'Otros',
                    'Toallas',
                ],
                'Menaje de Cocina' => [
                    'Accesorios',
                    'Cubiertos',
                    'Otros',
                    'Ollas',
                    'Sartenes',
                    'Vajillas',
                ],
                'Decohogar' => [
                    'Flores y plantas',
                    'Iluminación',
                    'Otros',
                    'Relojes',
                    'Textiles',
                ],
                'Grill' => [
                    'Cilindros',
                    'Cajas chinas',
                    'Utensilios y accesorios',
                    'Parrillas'
                ],
                'Menaje de comedor' => [
                    'Vasos, copas y jarras',
                    'Tazas y platos',
                    'Juegos de té y café',
                ],
                'Organización' => [
                    'Cajas',
                    'Cestos',
                    'Otros',
                    'Percheros',
                    'Repisas',
                ],
            ],
            'Dormitorio' => [
                'Colchones' => [
                    'Colchones',
                    'Otros',
                ],
                'Ropa de cama' => [
                    'Almohadas',
                    'Cobertores',
                    'Otros',
                    'Sábanas',
                ],
                'Muebles' => [
                    'Bases',
                    'Cabeceras',
                    'Cómodas',
                    'Otros',
                    'Veladores',
                ],
            ],
            'Muebles' => [
                'Cocina' => [
                    'Accesorios',
                    'Alacenas',
                    'Cocinas',
                    'Comedores',
                    'Despensas',
                    'Mesas',
                    'Otros',
                    'Sillas',
                ],
                'Comedor' => [
                    'Accesorios',
                    'Alacenas',
                    'Comedores',
                    'Mesas',
                    'Otros',
                    'Sillas',
                ],
                'Dormitorio' => [
                    'Accesorios',
                    'Bases',
                    'Cabeceras',
                    'Cómodas',
                    'Otros',
                    'Veladores',
                ],
                'Oficina' => [
                    'Accesorios',
                    'Archivadores',
                    'Escritorios',
                    'Otros',
                    'Sillas',
                ],
                'Sala' => [
                    'Accesorios',
                    'Alacenas',
                    'Mesas',
                    'Otros',
                    'Sillas',
                    'Sofás',
                ],
                'Terraza y jardín' => [
                    'Accesorios',
                    'Alacenas',
                    'Mesas',
                    'Otros',
                    'Sillas',
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

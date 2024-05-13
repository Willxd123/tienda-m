<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductoApiController extends Controller
{

    public function show($id){
        $producto =Producto::find($id);
        return response()->json($producto,200);
    }
    
    public function todosLosProductos()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function productosPorCategoria($id)
    {
        $categoria = Categoria::find($id);
        $subcategorias = Subcategoria::where('categoria_id', $categoria->id)->get();
        $productos = [];
        foreach ($subcategorias as $subcategoria) {
            $products = $subcategoria->productos;
            foreach ($products as $prod) {
                $productos[] = [
                    'id' => $prod->id,
                    'nombre' => $prod->nombre,
                    'stock' => $prod->stock,
                    'descripcion' => $prod->descripcion,
                    'precio' => $prod->precio,
                    'imagen' => $prod->imagen,
                    'subcategoria_id' => $prod->subcategoria_id,
                ];
            };
        }
        return response()->json($productos, 200);
    }

    public function productosPorSubCategoria($id){
        $subcategoria = Subcategoria::find($id);
        $products = $subcategoria->productos;
        $productos = [];
        foreach($products as $prod){
            $productos[] = [
                'id' => $prod->id,
                'nombre' => $prod->nombre,
                'stock' => $prod->stock,
                'descripcion' => $prod->descripcion,
                'precio' => $prod->precio,
                'imagen' => $prod->imagen,
                'subcategoria_id' => $prod->subcategoria_id,
            ];
        }
        return response()->json($productos, 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class ProductoApiController extends Controller
{

    public function show($id)
    {
        $producto = Producto::find($id);
        return response()->json($producto, 200);
    }

    public function todosLosProductos()
    {
        $productos = Producto::where('stock', '>', 0)->get();

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
                    'puntos' => $prod->puntos,
                    'imagen' => $prod->imagen,
                    'subcategoria_id' => $prod->subcategoria_id,
                ];
            };
        }
        return response()->json($productos, 200);
    }

    public function productosPorSubCategoria($id)
    {
        $subcategoria = Subcategoria::find($id);
        $products = $subcategoria->productos;
        $productos = [];
        foreach ($products as $prod) {
            $productos[] = [
                'id' => $prod->id,
                'nombre' => $prod->nombre,
                'stock' => $prod->stock,
                'descripcion' => $prod->descripcion,
                'precio' => $prod->precio,
                'puntos' => $prod->puntos,
                'imagen' => $prod->imagen,
                'subcategoria_id' => $prod->subcategoria_id,
            ];
        }
        return response()->json($productos, 200);
    }

    public function pdfFactura(Request $request, $id)
    {
        $productos = $request->json()->all();
        $user = User::find($id);
        $promotor = $user->promotor;
        $fecha = Carbon::now()->format('d-m-Y');
        $fecha_actual = Carbon::now();
        $fecha_limite = $fecha_actual->addMonths(3)->format('d-m-Y');
        $hora = Carbon::now()->format('H:i:s');
        $pdf = Pdf::loadView('pdf.factura_movil', [
            'productos' => $productos,
            'user' => $user,
            'promotor' => $promotor,
            'fecha' => $fecha,
            'hora' => $hora,
            'fecha_limite' => $fecha_limite
        ]);
        $pdf_archivo = $pdf->output();
        $filename = Str::random(20) . '.pdf';
        $aws_ruta = 'https://tienda-m.s3.amazonaws.com/';
        Storage::disk('s3')->put($filename, $pdf_archivo, 'public');
        $url = $aws_ruta . $filename;
        return response()->json($url, 200);
    }

    public function pdfFacturaUrl(Request $request, $id, $prods)
    {
        $productos = json_decode(urldecode($prods), true);
        $user = User::find($id);
        $promotor = $user->promotor;
        $fecha = Carbon::now()->format('d-m-Y');
        $fecha_actual = Carbon::now();
        $fecha_limite = $fecha_actual->addMonths(3)->format('d-m-Y');
        $hora = Carbon::now()->format('H:i:s');
        $pdf = Pdf::loadView('pdf.factura_movil', [
            'productos' => $productos,
            'user' => $user,
            'promotor' => $promotor,
            'fecha' => $fecha,
            'hora' => $hora,
            'fecha_limite' => $fecha_limite
        ]);
        return $pdf->download('factura-' . Carbon::now() . '.pdf');
    }
}

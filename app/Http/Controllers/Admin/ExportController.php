<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NotaComprasExport;
use App\Exports\NotaVentasExport;
use App\Http\Controllers\Controller;
use App\Models\NotaCompra;
use App\Models\NotaVenta;
use App\Models\Promotor;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function create()
    {
        return view('admin.reporte.create');
    }
    
    //reportes para compra de productos
    public function store(Request $request)
    {
        $camposSeleccionados = $request->input('campos', []);

        if (empty($camposSeleccionados)) {
            return redirect()->back()->with('error', 'Debes seleccionar al menos un campo.');
        }

        $nota_compras = null;
        $proveedor = new Collection();
        if (in_array('proveedor_id', $camposSeleccionados)) {
            $nota = NotaCompra::select($camposSeleccionados)->get();
            $camposSeleccionados = array_diff($camposSeleccionados, ['proveedor_id']);
            $nota_compras = NotaCompra::select($camposSeleccionados)->get();
            foreach ($nota as $nota_compra) {
                $prov = Proveedor::find($nota_compra->proveedor_id);
                $proveedor->push($prov);
            }
        } else {
            $nota_compras = NotaCompra::select($camposSeleccionados)->get();
        }
        $formato = $request->input('formato');
        if ($formato == 'pdf') {

            $pdf = Pdf::loadView('pdf.export_compras', [
                'nota_compras' => $nota_compras,
                'proveedores' => $proveedor,
                'campos' => $camposSeleccionados
            ]);
            return $pdf->download('reporte-' . Carbon::now() . '.pdf');

        } else if ($formato == 'excel') {
            
            return Excel::download(new NotaComprasExport($nota_compras, $proveedor, $camposSeleccionados), 'notaCompra.xlsx');
        
        } else {
            
            $html = View::make('pdf.export_compras',[
                'nota_compras' => $nota_compras,
                'proveedores' => $proveedor,
                'campos' => $camposSeleccionados,
            ])->render();

            $nombreArchivo = 'reporte-' . Carbon::now() . '.html';

            return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename={$nombreArchivo}");

        }
    }

    //reportes para venta de productos
    public function store2(Request $request)
    {
        $camposSeleccionados = $request->input('campos', []);

        if (empty($camposSeleccionados)) {
            return redirect()->back()->with('error', 'Debes seleccionar al menos un campo.');
        }

        $nota_ventas = null;
        $promotor = new Collection();
        if (in_array('promotor_id', $camposSeleccionados)) {
            $nota = NotaVenta::select($camposSeleccionados)->get();
            $camposSeleccionados = array_diff($camposSeleccionados, ['promotor_id']);
            $nota_ventas = NotaVenta::select($camposSeleccionados)->get();
            foreach ($nota as $nota_venta) {
                $prom = Promotor::find($nota_venta->promotor_id);
                $promotor->push($prom);
            }
        } else {
            $nota_ventas = NotaVenta::select($camposSeleccionados)->get();
        }
        $formato = $request->input('formato');
        if ($formato == 'pdf') {

            $pdf = Pdf::loadView('pdf.export_ventas', [
                'nota_compras' => $nota_ventas,
                'promotores' => $promotor,
                'campos' => $camposSeleccionados
            ]);
            return $pdf->download('reporte-' . Carbon::now() . '.pdf');

        } else if ($formato == 'excel') {
            
            return Excel::download(new NotaVentasExport($nota_ventas, $promotor, $camposSeleccionados), 'reporte.xlsx');
        
        } else {
            
            $html = View::make('pdf.export_ventas',[
                'nota_compras' => $nota_ventas,
                'promotores' => $promotor,
                'campos' => $camposSeleccionados,
            ])->render();

            $nombreArchivo = 'reporte-' . Carbon::now() . '.html';

            return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename={$nombreArchivo}");

        }
    }
}

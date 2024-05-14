<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NotaComprasExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function create()
    {
        return view('admin.reporte.create');
    }

    public function store(Request $request)
    {
        $proveedor = "";
        $monto_total = "";
        $fecha = "";
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        if($request->has('proveedor')){
            $proveedor = 'proveedor_id';
        }

        if($request->has('monto_total')){
            $monto_total = 'monto_total';
        }

        if($request->has('fecha')){
            $fecha = 'fecha';
        }


        return Excel::download(new NotaComprasExport($proveedor, $fecha,$monto_total, $fecha_ini, $fecha_fin), 'notaCompra.xlsx');
    
    }
}

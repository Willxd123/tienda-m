<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NotaComprasExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function create(){
        return view('admin.reporte.create');
    }

    public function store(){
        return Excel::download(new NotaComprasExport(), 'notaCompra.xlsx');
    }
}

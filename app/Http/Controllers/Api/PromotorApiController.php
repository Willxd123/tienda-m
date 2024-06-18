<?php

namespace App\Http\Controllers\Api;

use App\Exports\AsistenciaExport;
use App\Http\Controllers\Controller;
use App\Models\Promotor;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PromotorApiController extends Controller
{
    public function actualizarPuntos($id, Request $request){
        $user = User::find($id);
        $promotor = $user->promotor;
        $puntos = $promotor->puntos + $request->puntos;
        $promotor->update([
            'puntos' => $puntos 
        ]);

        return response()->json([
            'puntos' => $puntos
        ], 200);
    }

    public function promotor($id){
        $user = User::find($id);
        $prom = $user->promotor;
        $promotor = [];
        $promotor['id'] = $prom->id;
        $promotor['puntos'] = $prom->puntos;
        return response()->json($promotor, 200);
    }

    public function examen(Request $request){
        $data = $request->json()->all();

        $pdf = Pdf::loadView('pdf.asistencias',[
            'data' => $data
        ]);
        $pdf_archivo = $pdf->output();
        $filename = 'factura-'.Carbon::now() . '.pdf';
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        Storage::disk('s3')->put($filename, $pdf_archivo, 'public');
        $url = $aws_ruta.$filename;
        return response()->json($url,200);
    }

    public function examenexcel(Request $request){
        $data = $request->json()->all();

        $filename = 'asistencias-'.Carbon::now().'.xlsx';

        $filePath = storage_path('app/public/'.$filename);

        Excel::store(new AsistenciaExport($data), $filename, 'public');

        $excelContent = file_get_contents($filePath);

        Storage::disk('s3')->put($filename, $excelContent, 'public');

        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        $url = $aws_ruta.$filename;

        unlink($filePath);

        return response()->json($url, 200);
    }

}

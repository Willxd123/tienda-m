<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View as ViewView;

class NotaVentasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $nota_compras;
    protected $promotores;
    protected $campos;

    public function __construct($nota_compras, $promotores, $campos)
    {
        $this->nota_compras = $nota_compras;
        $this->promotores = $promotores;
        $this->campos = $campos;
    }

    public function view(): ViewView
    {
        // dd($this->campos);
        return view('pdf.export_ventas',[
            'nota_compras' => $this->nota_compras,
            'promotores' => $this->promotores,
            'campos' => $this->campos
        ]);
    }
}

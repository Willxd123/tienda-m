<?php

namespace App\Exports;

use App\Models\NotaCompra;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View;
use Illuminate\Contracts\View\View as ViewView;

class NotaComprasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $nota_compras;
    protected $proveedores;
    protected $campos;

    public function __construct($nota_compras, $proveedores, $campos)
    {
        $this->nota_compras = $nota_compras;
        $this->proveedores = $proveedores;
        $this->campos = $campos;
    }

    public function view(): ViewView
    {
        //dd($this->campos);
        return view('pdf.export_compras',[
            'nota_compras' => $this->nota_compras,
            'proveedores' => $this->proveedores,
            'campos' => $this->campos
        ]);
    }
}

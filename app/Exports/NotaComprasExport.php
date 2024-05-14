<?php

namespace App\Exports;

use App\Models\NotaCompra;
use Maatwebsite\Excel\Concerns\FromCollection;

class NotaComprasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;
    protected $proveedor;
    protected $fecha;
    protected $monto_total;
    protected $fecha_ini;
    protected $fecha_fin;

    public function __construct($proveedor, $fecha, $monto_total, $fecha_ini, $fecha_fin)
    {
        $this->proveedor = $proveedor;
        $this->fecha = $fecha;
        $this->monto_total = $monto_total;
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

    }

    public function collection()
    {
        if($this->proveedor != "" && $this->fecha == "" && $this->monto_total == "" ){
            $nota_compras = NotaCompra::select('id',$this->proveedor)->get();
            return $nota_compras;
        }

        if($this->fecha != "" && $this->proveedor == "" && $this->monto_total == ""){
            $nota_compras = NotaCompra::select('id',$this->fecha)->get();
            return $nota_compras;
        }

        if($this->monto_total != "" && $this->proveedor == "" && $this->fecha == ""){
            $nota_compras = NotaCompra::select('id',$this->monto_total)->get();
            return $nota_compras;
        }

        if($this->monto_total != "" && $this->proveedor != "" & $this->fecha == ""){
            $nota_compras = NotaCompra::select('id',$this->proveedor, $this->monto_total)->get();
            return $nota_compras;
        }

        if($this->monto_total != "" && $this->fecha != "" && $this->proveedor == ""){
            $nota_compras = NotaCompra::select('id',$this->fecha, $this->monto_total)->get();
            return $nota_compras;
        }

        if($this->proveedor != "" && $this->fecha != "" && $this->monto_total == ""){
            $nota_compras = NotaCompra::select('id',$this->fecha, $this->proveedor)->get();
            return $nota_compras;
        }

        if($this->proveedor != "" && $this->fecha != "" && $this->monto_total !=""){
            $nota_compras = NotaCompra::select('id',$this->fecha, $this->proveedor, $this->monto_total)->get();
            return $nota_compras;
        }

        return NotaCompra::all();
    }
}

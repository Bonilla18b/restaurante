<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDeCompra extends Model
{
    use HasFactory;

    protected $table = 'ordenes_de_compras';
    protected $fillable = ['proveedor_id', 'nOrden', 'estado', 'registradoPor'];

    // Una OrdenDeCompra pertenece a un Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    // Una OrdenDeCompra tiene muchos DetallesCompra
    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'orden_de_compra_id');
    }

    // Una OrdenDeCompra puede tener una CuentaPorPagar
    public function cuentaPorPagar()
    {
        return $this->hasOne(CuentaPorPagar::class, 'orden_de_compra_id');
    }
}
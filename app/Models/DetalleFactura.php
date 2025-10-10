<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detalle_facturas';
    protected $fillable = ['factura_id', 'cantidad', 'precioUnitario', 'subtotal', 'descuento', 'registradoPor'];

    // Un DetalleFactura pertenece a una Factura
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
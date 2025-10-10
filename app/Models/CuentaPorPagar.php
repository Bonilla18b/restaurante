<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaPorPagar extends Model
{
    use HasFactory;

    protected $table = 'cuentas_por_pagar';
    protected $fillable = ['metodo_de_pago_id', 'orden_de_compra_id', 'montoPagado', 'montoPendiente', 'montoTotal', 'fechaVencimiento', 'estado', 'descripcion'];

    // Una CuentaPorPagar pertenece a un MetodoDePago
    public function metodoDePago()
    {
        return $this->belongsTo(MetodoDePago::class, 'metodo_de_pago_id');
    }

    // Una CuentaPorPagar pertenece a una OrdenDeCompra
    public function ordenDeCompra()
    {
        return $this->belongsTo(OrdenDeCompra::class, 'orden_de_compra_id');
    }
}
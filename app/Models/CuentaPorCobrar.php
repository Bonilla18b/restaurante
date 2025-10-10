<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaPorCobrar extends Model
{
    use HasFactory;

    protected $table = 'cuentas_por_cobrar';
    protected $fillable = ['metodo_de_pago_id', 'factura_id', 'montoPagado', 'montoPendiente', 'montoTotal', 'fechaVencimiento', 'estado', 'descripcion'];

    // Una CuentaPorCobrar pertenece a un MetodoDePago
    public function metodoDePago()
    {
        return $this->belongsTo(MetodoDePago::class, 'metodo_de_pago_id');
    }

    // Una CuentaPorCobrar pertenece a una Factura
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
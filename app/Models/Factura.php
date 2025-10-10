<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'nFactura', 'estado', 'descuentoTotal', 'total', 'pago', 'metodoDePago', 'registradoPor'];

    // Una Factura pertenece a un Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Una Factura tiene muchos DetallesFactura
    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    // Una Factura puede tener una CuentaPorCobrar
    public function cuentaPorCobrar()
    {
        return $this->hasOne(CuentaPorCobrar::class, 'factura_id');
    }
}
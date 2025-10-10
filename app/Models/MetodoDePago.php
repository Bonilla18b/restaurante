<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoDePago extends Model
{
    use HasFactory;

    protected $table = 'metodos_de_pagos';
    protected $fillable = ['nombre'];

    // Un MetodoDePago puede usarse en muchas CuentasPorPagar
    public function cuentasPorPagar()
    {
        return $this->hasMany(CuentaPorPagar::class, 'metodo_de_pago_id');
    }

    // Un MetodoDePago puede usarse en muchas CuentasPorCobrar
    public function cuentasPorCobrar()
    {
        return $this->hasMany(CuentaPorCobrar::class, 'metodo_de_pago_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    
    protected $fillable = ['empleado_id', 'tipoContrato', 'fechaInicio', 'fechaFin', 'estadoContrato', 'salario'];

    // Un Contrato pertenece a un Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
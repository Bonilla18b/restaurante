<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    
    protected $fillable = ['persona_id', 'cargo', 'salario', 'turno', 'estado', 'contratacion', 'registradoPor'];

    // Un Empleado es una Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    // Un Empleado puede tener una cuenta de Usuario
    public function usuarioSistema()
    {
        return $this->hasOne(UsuarioSistema::class, 'empleado_id');
    }

    // Un Empleado puede tener un contrato
    public function contratos()
    {
        return $this->hasOne(Contrato::class, 'empleado_id');
    }
}
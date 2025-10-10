<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'apellido', 'documento', 'telefono', 'email'];

    // Una Persona puede ser un Cliente
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'persona_id');
    }

    // Una Persona puede ser un Empleado
    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'persona_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioSistema extends Model
{
    use HasFactory;
    
    protected $table = 'usuarios_sistema';
    protected $fillable = ['empleado_id', 'username', 'password', 'registradoPor'];
    protected $hidden = ['password']; // Ocultar el password en arrays/JSON

    // Un UsuarioSistema pertenece a un Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
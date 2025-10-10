<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $fillable = ['persona_id', 'direccion', 'registradoPor'];

    // Un Cliente es una Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    
    // Un Cliente puede tener muchas Facturas
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }
}
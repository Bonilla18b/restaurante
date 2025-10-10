<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'disponibilidad', 'registradoPor'];

    // Un Menu puede aparecer en muchos DetallesPedido
    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class, 'producto_id');
    }
}
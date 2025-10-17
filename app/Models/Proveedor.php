<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = ['nombreCelular', 'email', 'documento', 'registradoPor'];

    // Un Proveedor tiene muchos Productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }

    // Un Proveedor tiene muchas OrdenesDeCompra
    public function ordenesDeCompra()
    {
        return $this->hasMany(OrdenDeCompra::class, 'proveedor_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalles_compras';
    protected $fillable = ['orden_de_compra_id', 'producto_id', 'cantidad', 'precio', 'total'];

    // Un DetalleCompra pertenece a una OrdenDeCompra
    public function ordenDeCompra()
    {
        return $this->belongsTo(OrdenDeCompra::class, 'orden_de_compra_id');
    }

    // Un DetalleCompra se relaciona con un Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
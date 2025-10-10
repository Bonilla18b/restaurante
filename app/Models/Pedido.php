<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'fechaPedido', 'estado', 'subtotal', 'mesa', 'registradoPor'];

    // Un Pedido tiene muchos DetallesPedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }
    
    // Asumiendo que producto_id en pedidos es redundante o un error en el diagrama (se usaría detallesPedido), 
    // pero si lo mantienes, debe ser un belongsTo a Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'producto_id');
    }
}
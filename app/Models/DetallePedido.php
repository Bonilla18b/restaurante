<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'subtotal', 'registradoPor'];

    // Un DetallePedido pertenece a un Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    // Un DetallePedido se relaciona con un item del Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'producto_id');
    }
}
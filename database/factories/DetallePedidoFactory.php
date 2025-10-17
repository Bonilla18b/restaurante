<?php

namespace Database\Factories;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetallePedidoFactory extends Factory
{
    public function definition(): array
    {
        $cantidad = $this->faker->numberBetween(1, 5);
        $precio = $this->faker->randomFloat(2, 5, 50);
        $subtotal = $cantidad * $precio;

        return [
            // **Asumiendo que ya existen Pedidos y Menus**
            'pedido_id' => Pedido::factory(),
            'producto_id' => Menu::factory(),
            'cantidad' => $cantidad,
            'subtotal' => $subtotal,
            'registradoPor' => $this->faker->name(),
        ];
    }
}
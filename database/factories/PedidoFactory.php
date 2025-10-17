<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10, 200);

        return [
            // **Usando Menu como placeholder, aunque el detalle lleva el peso**
            'producto_id' => Menu::factory(), 
            'fechaPedido' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'estado' => $this->faker->randomElement(['Pendiente', 'En Cocina', 'Entregado', 'Cancelado']),
            'subtotal' => $subtotal,
            'mesa' => $this->faker->numberBetween(1, 20),
            'registradoPor' => $this->faker->name(),
        ];
    }
}
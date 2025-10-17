<?php

namespace Database\Factories;

use App\Models\DetalleCompra;
use App\Models\OrdenDeCompra;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleCompraFactory extends Factory
{
    public function definition(): array
    {
        $cantidad = $this->faker->numberBetween(1, 50);
        $precio = $this->faker->randomFloat(2, 5, 100);
        $total = $cantidad * $precio;

        return [
            // **Asumiendo que ya existen OrdenesDeCompra y Productos**
            'orden_de_compra_id' => OrdenDeCompra::factory(),
            'producto_id' => Producto::factory(),
            'cantidad' => $cantidad,
            'precio' => $precio,
            'total' => $total,
        ];
    }
}
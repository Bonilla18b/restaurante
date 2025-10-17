<?php

namespace Database\Factories;

use App\Models\DetalleFactura;
use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleFacturaFactory extends Factory
{
    public function definition(): array
    {
        $cantidad = $this->faker->numberBetween(1, 5);
        $precioUnitario = $this->faker->randomFloat(2, 5, 50);
        $subtotal = $cantidad * $precioUnitario;
        $descuento = $this->faker->randomFloat(2, 0, $subtotal * 0.05);

        return [
            // **Asumiendo que ya existen Facturas**
            'factura_id' => Factura::factory(),
            'cantidad' => $cantidad,
            'precioUnitario' => $precioUnitario,
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'registradoPor' => $this->faker->name(),
        ];
    }
}
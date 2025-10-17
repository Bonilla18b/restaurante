<?php

namespace Database\Factories;


use App\Models\OrdenDeCompra;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenDeCompraFactory extends Factory
{
    public function definition(): array
    {
        return [
            // **Asumiendo que ya existen Proveedores (id 1 a 5)**
            'proveedor_id' => Proveedor::factory(),
            'nOrden' => 'OC-' . $this->faker->unique()->randomNumber(6),
            'estado' => $this->faker->randomElement(['Pendiente', 'Recibida', 'Cancelada']),
            'registradoPor' => $this->faker->name(),
        ];
    }
}
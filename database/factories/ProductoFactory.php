<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            // **Asumiendo que ya existen Proveedores (id 1 a 5)**
            'proveedor_id' => Proveedor::factory(),
            'nombre' => $this->faker->word() . ' ' . $this->faker->randomElement(['Fresco', 'Congelado', 'Importado', 'Nacional']),
            'unidadMedida' => $this->faker->randomElement(['Kg', 'Unidad', 'Litro', 'Caja']),
            'stock' => $this->faker->numberBetween(10, 500),
            'stockMinimo' => $this->faker->numberBetween(5, 50),
            'registradoPor' => $this->faker->name(),
        ];
    }
}
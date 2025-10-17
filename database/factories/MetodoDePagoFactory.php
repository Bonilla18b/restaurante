<?php

namespace Database\Factories;

use App\Models\MetodoDePago;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetodoDePagoFactory extends Factory
{
    public function definition(): array
    {
        return [
        'nombre' => $this->faker->randomElement(['Efectivo', 'Transferencia', 'Tarjeta Crédito', 'Tarjeta Débito', 'Crédito Proveedor']),
    ];
    }
}
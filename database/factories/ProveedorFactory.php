<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombreCelular' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'documento' => $this->faker->unique()->randomNumber(9),
            'registradoPor' => $this->faker->name(),
        ];
    }
}
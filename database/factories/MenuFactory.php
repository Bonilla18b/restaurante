<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word() . ' ' . $this->faker->randomElement(['Especial', 'Gourmet', 'Del Día', 'Clásico']),
            'descripcion' => $this->faker->paragraph(1),
            'precio' => $this->faker->randomFloat(2, 5, 50),
            'disponibilidad' => $this->faker->boolean(90), // 90% disponible
            'registradoPor' => $this->faker->name(),
        ];
    }
}
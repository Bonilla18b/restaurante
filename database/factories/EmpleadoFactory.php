<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    public function definition(): array
    {
        $salario = $this->faker->numberBetween(1000, 5000) * 100;

        return [
            
            'persona_id' => Persona::factory(), 
            'cargo' => $this->faker->randomElement(['Gerente', 'Cajero', 'Cocinero', 'Mesero']),
            'salario' => $salario,
            'turno' => $this->faker->randomElement(['Mañana', 'Tarde', 'Noche']),
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo', 'Suspendido']),
            'contratacion' => $this->faker->date(),
            'registradoPor' => $this->faker->name(),
        ];
    }
}